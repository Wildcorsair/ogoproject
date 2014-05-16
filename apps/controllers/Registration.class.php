<?php

class Registration extends BController {
		
		public $errorCode;

		public function index($param) {
			$this->errorCode = $param;
			$this->render("index");
		}
		
		public function go() {
			$this->model->regUser();
		}
		
		public function confirm() {
			$this->render("confirm");
		}
		
		public function activation($param) {
			$this->model->activation($param);
		}

		public function complite() {
			$this->render("complite");
		}
	
		public function error() {
			$this->render("error");
		}
}

?>
