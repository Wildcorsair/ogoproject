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

	public function leave($category, $userObject) {
		//!is_null($userObject->data->fid) && is_numeric($userObject->data->fid)
		if ($userObject->isUserAuthorized()) {
			$isAllow = $userObject->checkUserPermission("leave_comments", $userObject->data->fid);
				if ($isAllow) {
					$commentText = strip_tags(trim($_POST['commentText']));
					if (!empty($commentText)) {
						$this->fnews_id = $_POST['newsId'];
						$this->fauthor_id = $userObject->data->fid;
						$this->ftext = $commentText;
						$this->insert();
						header("Location: /".$category."/show/".$_POST['newsId']);
						exit();
					} else {
						header("Location: /".$category."/show/".$_POST['newsId']."/16");
						exit();
					}
				}
		} else {
			header("Location: /".$category."/show/".$_POST['newsId']."/14");
			//header("Location: /error/message/14");
			exit;
		}

	}

	public function edit($commentId, $userObject) {
		$userObject->isUserAuthorized();
		if (!is_null($userObject->data->fid) && is_numeric($userObject->data->fid)) {
			$isAllow = $userObject->checkUserPermission("edit_comments", $userObject->data->fid);
				if ($isAllow) {
					$editComment = strip_tags(trim($_POST['editComment']));
					if (!empty($editComment)) {
						$this->ftext = $editComment;
						$this->updateById($commentId);
						$category = strip_tags(trim($_POST['category']));
						header("Location: /".$category."/show/".$_POST['newsId']);
						exit();
					} else {
						header("Location: /".$category."/show/".$_POST['newsId']."/2");
						//header("Location: /error/message/16");
						exit();
					}
				} else {
					header("Location: /error/message/19");
					exit();
				}
		} else {
			header("Location: /error/message/14");
			exit();
		}
	}
	
	public function delete($commentId, $userObject) {
		$userObject->isUserAuthorized();
		if (!is_null($userObject->data->fid) && is_numeric($userObject->data->fid)) {
			$isAllow = $userObject->checkUserPermission("delete_comments", $userObject->data->fid);
				if ($isAllow) {
					$result = $this->deleteByParams("`fid` = :i AND `fauthor_id` = :i",
													array($commentId, $userObject->data->fid));
					if (isset($_POST['newsId']) && is_numeric($_POST['newsId'])) {
						$category = strip_tags(trim($_POST['category']));
						header("Location: /".$category."/show/".$_POST['newsId']);
						exit;
					} else {
						header("Location: /error/message/15");
						exit;
					}
				} else {
					header("Location: /error/message/20");
					exit();
				}
		} else {
			header("Location: /error/message/14");
			exit;
		}
	}
}

?>