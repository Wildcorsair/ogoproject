<?php

class Authorization extends BController {

	public function index($param) {
		/*header("Location: /");
		exit;*/
		$this->messageId = $param;
		$this->render('index');
	}

	public function login() {
		$this->model->login();
	}

	public function logout() {
		$this->model->logout();
	}
}

?>