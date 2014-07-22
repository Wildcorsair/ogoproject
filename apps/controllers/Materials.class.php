<?php

	class Materials extends BController {
		public $currentPage;
		public $articleId;

		public function index($param) {
			if (is_numeric($param)) {
				$this->currentPage = $param;
			} else {
				$this->currentPage = 1;
			}
			$this->render("index");
		}

		public function show($param) {
			if (is_numeric($param)) {
				$this->articleId = $param;
			}
			$this->render("show");
		}

	}

?>
