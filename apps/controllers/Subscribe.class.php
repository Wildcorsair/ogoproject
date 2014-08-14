<?php

class Subscribe extends BController {
	public $errorId;

	public function go() {
		$this->model->addNewSubscriber();
	}

	public function complite() {
		$this->render("complite");
	}

	public function error($id) {
		$this->errorId = strip_tags(trim($id));
		$this->render("error");
	}
}

?>