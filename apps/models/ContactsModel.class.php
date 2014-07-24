<?php

class ContactsModel extends BDatabase {
	public $tableName = "ogo_feedback";
	public $primaryKey = "fid";

	public function feedbackMessage() {
		if (isset($_POST['postFeedback'])) {
			$uName = strip_tags(trim($_POST['feedbackUser']));
			$uEmail = strip_tags(trim($_POST['feedbackEmail']));
			$uMessage = strip_tags(trim($_POST['feedback-textarea']));
			if (!empty($uName) && !empty($uEmail) && !empty($uMessage)) {
				$this->ffrom = $uName;
				$this->femail = $uEmail;
				$this->fmessage = $uMessage;
				$this->insert();
				header("Location: /");
				exit();
			}
		}
	}
}

?>