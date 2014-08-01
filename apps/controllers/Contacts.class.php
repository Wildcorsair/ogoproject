<?php

class Contacts extends BController {
	public $infoMsg;


	public function index() {
		$this->render("index");
	}

	public function feedback() {
		$this->model->feedbackMessage();
	}

	public function information($msgId) {
		$this->infoMsg = $msgId;
		$this->render("index");
	}

	public function received() {
		$this->render("received");
	}
}


?>