<?php

class ContactsModel extends BDatabase {
	public $tableName = "ogo_feedback";
	public $primaryKey = "fid";

	public function feedbackMessage() {
		if (isset($_POST['postFeedback'])) {
			$uName = strip_tags(trim($_POST['feedbackUser']));
			$uEmail = strip_tags(trim($_POST['feedbackEmail']));
			$uMessage = strip_tags(trim($_POST['feedback-textarea']));
			setcookie("uName", $uName);
			setcookie("uEmail", $uEmail);
			setcookie("uMessage", $uMessage);

			if (!empty($uName) && !empty($uEmail) && !empty($uMessage)) {
				if ($uName != "Ваше имя" && $uEmail != "Email адрес" && $uMessage != "Ваше сообщение") {
					if (!$this->emailValidate($uEmail)) {
						header("Location: /contacts/information/2");
						exit();	
					}
					$this->ffrom = $uName;
					$this->femail = $uEmail;
					$this->fmessage = $uMessage;
					$this->insert();
					isset($_COOKIE["uName"]) ? setcookie("uName", "") : "";
					isset($_COOKIE["uEmail"]) ? setcookie("uEmail", "") : "";
					isset($_COOKIE["uMessage"]) ? setcookie("uMessage", "") : "";
					header("Location: /contacts/received");
					exit();
				}
			}
			header("Location: /contacts/information/1");
			exit();	
		}
	}

	public function checkInfoMsg($msgId) {
		$msgList = array(
					1=>"Ошибка: Не заполнены поля формы!",
					2=>"Ошибка: Не правильный email адрес!",
					99=>"Извините, не известная ошибка"
					);
		$msgId = intval($msgId);
		if (is_numeric($msgId) && $msgId > 0 && $msgId <= count($msgList)) {
			echo "<div id='show-error-msg'>";
			echo $msgList[$msgId];
			echo "</div>";
		} else {
			echo "<div id='show-error-msg'>";
			echo $msgList[99];
			echo "</div>";
		}
	}
}

?>