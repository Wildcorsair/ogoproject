<?php 

	class News extends BController {
		public $currentPage;
		public $newsId;

		public function index($param, $errorNo) {
			if (is_numeric($param)) {
				$this->currentPage = $param;
			} else {
				$this->currentPage = 1;
			}
			$this->render("index");
		}

		public function show($param, $errorNo) {
			if (is_numeric($param)) {
				$this->newsId = $param;
			}
			if (is_numeric($errorNo)) {
				$this->errorNo = $errorNo;
			}
			$this->render("show");
		}
	}
?>
