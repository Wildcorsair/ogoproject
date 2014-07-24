<?php

class Contacts extends BController {

	public function index() {
		$this->render("index");
	}

	public function feedback() {
		$this->model->feedbackMessage();
	}
}


?>