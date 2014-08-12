<?php

class Comments extends BController {

	public function __construct() {
		/*
		*	Наследуем конструктор базового контроллера
		*	так как в нем создается объект "user"
		*	и сразу проверяем авторизацию пользователя
		*	для того чтобы не повторять это действие в
		*	каждой функции модели
		*/
		parent::__construct();
		$this->user->isUserAuthorized();
	}
	
	public function leave($category) {
		$res = $this->model->leave($category, $this->user);
	}

	public function edit($commentId) {
		$this->model->edit($commentId, $this->user);
	}

	public function delete($commentId) {
		$this->model->delete($commentId, $this->user);
	}
}
?>