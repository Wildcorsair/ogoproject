<?php

	class Materials extends BController {
		public $currentPage;
		public $newsId;

		public function index($param) {
			if (is_numeric($param)) {
				$this->currentPage = $param;
			} else {
				$this->currentPage = 1;
			}
			$this->render("index");
		}

		public function read($param) {
			$this->render("read");
		}

	}

?>
