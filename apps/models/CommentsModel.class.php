<?php

class CommentsModel extends BDatabase {
	
	public $tableName = "ogo_comments";
	public $primaryKey = "fid";

	public function getComments($newsId) {
		$data = null;
		$q = "SELECT `ogo_comments`.`fid`,
					`ogo_comments`.`fauthor_id`,
					`ogo_comments`.`ftext`,
					`ogo_comments`.`fcreate_date`,
					`ogo_users`.`fname`
				FROM `ogo_comments` 
				LEFT JOIN `ogo_users` ON `ogo_comments`.`fauthor_id`=`ogo_users`.`fid`
				WHERE `fnews_id` = :i
				ORDER BY `ogo_comments`.`fcreate_date` DESC
				LIMIT 0, 100";
		$c = array($newsId);
		$data = $this->selectBySql($q, $c);
		return $data;
	}

	public function leave() {
		$user = $this->isAuthorized();
		if (isset($user->fid) && !is_null($user->fid)) {
			$commentText = strip_tags(trim($_POST['commentText']));
			if (!empty($commentText)) {
				$this->fnews_id = $_POST['newsId'];
				$this->fauthor_id = $user->fid;
				$this->ftext = $commentText;
				$this->insert();
				header("Location: /news/show/".$_POST['newsId']);
				exit;
			} else {
				header("Location: /error/message/16");
				exit;
			}
		} else {
			header("Location: /error/message/14");
			exit;
		}

	}

	public function edit($commentId) {
		$user = $this->isAuthorized();
		if (isset($user->fid) && !is_null($user->fid)) {
			$editComment = strip_tags(trim($_POST['editComment']));
			if (!empty($editComment)) {
				$this->ftext = $editComment;
				$this->updateById($commentId);
				header("Location: /news/show/".$_POST['newsId']);
				exit;
			} else {
				header("Location: /error/message/16");
				exit;
			}
		} else {
			header("Location: /error/message/14");
			exit;
		}
	}
	
	public function delete($commentId) {
		$user = $this->isAuthorized();
		if (!empty($user->fid)) {
			$result = $this->deleteByParams("`fid` = :i AND `fauthor_id` = :i", array($commentId, $user->fid));
			header("Location: /".$_COOKIE['currRoute']);
			exit;
		} else {
			header("Location: /error/message/14");
			exit;
		}
	}
}

?>