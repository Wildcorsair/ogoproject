<?php

class SubscribeModel extends BDatabase {
	public $tableName = "ogo_subscribers";
	public $primaryKey = "fid";

	public function addNewSubscriber() {
		if (isset($_POST['subscribe-btn'])) {
			$uName = strip_tags(trim($_POST['userName']));
			$uEmail = strip_tags(trim($_POST['subscribeEmail']));
			if (empty($uName) || $uName === "Ваше имя") {
				header("Location: /error/message/5");
				exit();
			}

			if (empty($uEmail) || $uEmail === "Email адрес") {
				header("Location: /error/message/4");
				exit();
			}

			if (!$this->emailValidate($uEmail)) {
				header("Location: /error/message/9");
				exit();
			}
			
			$this->fsubscriberName = $uName;
			$this->fsubscriberEmail = $uEmail;
			$this->insert();
		}
	}
}

?>