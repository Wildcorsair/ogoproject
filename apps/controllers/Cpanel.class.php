<?php

class Cpanel extends BController {
	public $mainTamplate = "cpanel.php";
	
	/*public function render($tamplateName = "index", $nested = false, $common = false) {
		$this->tamplate = $tamplateName;
		if ($nested) {
			if ($common) {
				$fullPath = ROOT."/apps/views/common".
						"/".$tamplateName.".php";
			} else {
				$fullPath = ROOT."/apps/views/".
						strtolower($this->controllerClassName).
						"/".$tamplateName.".php";
			}
		} else {
			$fullPath = ROOT."/apps/views/cpanel/cpanel.php";
		}
		include_once($fullPath);
	}*/

	public function index() {
		//	Используем "true" вторым параметром функции
		//	для того чтобы не грузился главный шаблон сайта
		$this->render("index");
	}

	public function news() {
		$this->render("news");
	}

	public function materials() {
		$this->render("materials");
	}

	public function users() {
		$this->render("users");
	}
}

?>