<?php

class User {
	
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
	
	public function userCheck($userId) {
		$dataSet = $this->model->userCheckPermissions($userId);
		return $dataSet;
	}
}

?>