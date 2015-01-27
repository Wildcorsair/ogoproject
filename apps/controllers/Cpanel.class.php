<?php

class Cpanel extends BController {
	public $currentPage = 1;
	public $mainTamplate = "cpanel.php";

	public function index() {
		//	Используем "true" вторым параметром функции
		//	для того чтобы не грузился главный шаблон сайта
		$this->render("index");
	}

	public function news($page) {
		if (is_numeric($page)) {
			$this->currentPage = $page;
		}
		$this->render("news");
	}

	public function materials($page) {
		if (is_numeric($page)) {
			$this->currentPage = $page;
		}
		$this->render("materials");
	}

	public function users($page) {
		if (is_numeric($page)) {
			$this->currentPage = $page;
		}
		$this->render("users");
	}

	public function usersEdit() {
		if (isset($_GET['id'])) {
			$this->render('usersEdit');
		}
	}

	public function userSave() {
		if (isset($_POST['usrDataSave'])) {
			$this->model->userSaveAction();
			header('Location: /cpanel');
		} else if (isset($_POST['usrDataCancel'])) {
			header('Location: /cpanel/users');
		}
	}
}

?>