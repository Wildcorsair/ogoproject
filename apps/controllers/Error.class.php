<?php

class Error extends BController {

	public $messageId;

	public function index() {
		header("Location: /");
	}

	public function message($id) {
		$this->messageId = $id;
		$this->render("index");
	}
}

?>