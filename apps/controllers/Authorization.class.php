<?php

class Authorization extends BController {

	public function index() {
		header("Location: /");
		exit;
	}

	public function login() {
		$this->model->login();
	}

	public function logout() {
		$this->model->logout();
	}
}

?>