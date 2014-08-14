<?php

class SubscribeModel extends BDatabase {
	public $tableName = "ogo_subscribers";
	public $primaryKey = "fid";

	public function addNewSubscriber() {
		if (isset($_POST['subscribe-btn'])) {
			$uName = strip_tags(trim($_POST['userName']));
			$uEmail = strip_tags(trim($_POST['subscribeEmail']));
			if (empty($uName) || $uName === "Ваше имя") {
				header("Location: /subscribe/error/5");
				exit();
			}

			if (empty($uEmail) || $uEmail === "Email адрес") {
				header("Location: /subscribe/error/4");
				exit();
			}

			if (!$this->emailValidate($uEmail)) {
				header("Location: /subscribe/error/9");
				exit();
			}
			
			$fields = "fsubscriberEmail";
			$cond = array("`fsubscriberEmail` = :s", array($uEmail));
			$limit = array(0, 1);
			$dataSet = $this->select($fields, $cond, $limit);
			if (!empty($dataSet)) {
				header("Location: /subscribe/error/18");
				exit();
			} else {
				$this->fsubscriberName = $uName;
				$this->fsubscriberEmail = $uEmail;
				$this->insert();
				header("Location: /subscribe/complite");
				exit();
			}
		}
	}
}

?>