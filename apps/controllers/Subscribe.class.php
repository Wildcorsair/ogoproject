<?php

class Subscribe extends BController {
	public function go() {
		$this->model->addNewSubscriber();
	}

	public function complite() {
		$this->render("complite");
	}
}

?>