<?php

class Search extends BController {
	public $currentPage;

	public function index($param) {
		if (is_numeric($param)) {
			$this->currentPage = $param;
		} else {
			$this->currentPage = 1;
		}
		$this->render("index");
	}

}

?>