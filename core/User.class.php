<?php

class User {
	public $model;
	public $data;

	public function __construct () {
		/*
		 * Определяем имя класса, для того чтобы подключать
		 * "Виды" и "Модели" соответсвенно контроллеру
		*/ 
		$this->controllerClassName = get_class($this);
		$modelClassName = $this->controllerClassName."Model";
		include(ROOT."/apps/models/".$modelClassName.".class.php");
		$this->model = new $modelClassName();
	}
	
	public function checkUserPermission($permission, $userId) {
		$isAllow = $this->model->userCheckPermissions($permission, $userId);
		return $isAllow;
	}

	public function isUserAuthorized() {
		$this->data = $this->model->getAuthorizedUserData();
	}
}

?>