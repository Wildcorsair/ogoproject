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
		$id = strip_tags(trim($_POST['newsId']));
		if ($userObject->isAuthorized) {
			$isAllow = $userObject->checkUserPermission("leave_comments", $userObject->data->fid);
				if ($isAllow) {
					$commentText = strip_tags(trim($_POST['commentText']));
					if (!empty($commentText)) {
						$this->fnews_id = $_POST['newsId'];
						$this->fauthor_id = $userObject->data->fid;
						$this->ftext = $commentText;
						$this->insert();
						header("Location: /".$category."/show/".$id);
						exit();
					} else {
						header("Location: /".$category."/show/".$id."/16#move");
						exit();
					}
				}
		} else {
			header("Location: /".$category."/show/".$id."/14");
			exit;
		}

	}

	public function edit($commentId, $userObject) {
		$category = strip_tags(trim($_POST['category']));
		$id = strip_tags(trim($_POST['newsId']));
		if ($userObject->isAuthorized) {
			$isAllow = $userObject->checkUserPermission("edit_comments", $userObject->data->fid);
				if ($isAllow) {
					$editComment = strip_tags(trim($_POST['editComment']));
					if (!empty($editComment)) {
						$this->ftext = $editComment;
						$this->updateById($commentId);
						header("Location: /".$category."/show/".$id."#move");
						exit();
					} else {
						header("Location: /".$category."/show/".$id."/16#move");
						exit();
					}
				} else {
					header("Location: /".$category."/show/".$id."/19#move");
					exit();
				}
		} else {
			header("Location: /".$category."/show/".$id."/14");
			exit();
		}
	}
	
	public function delete($commentId, $userObject) {
		$category = strip_tags(trim($_POST['category']));
		$id = strip_tags(trim($_POST['newsId']));
		if ($userObject->isAuthorized) {
			$isAllow = $userObject->checkUserPermission("delete_comments", $userObject->data->fid);
				if ($isAllow) {
					$result = $this->deleteByParams("`fid` = :i AND `fauthor_id` = :i",
													array($commentId, $userObject->data->fid));
						header("Location: /".$category."/show/".$id."#move");
						exit();
				} else {
					header("Location: /".$category."/show/".$id."/20#move");
					exit();
				}
		} else {
			header("Location: /".$category."/show/".$id."/14");
			exit();
		}
	}
}

?>