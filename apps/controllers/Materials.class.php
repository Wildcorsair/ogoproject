<?php

	class Materials extends BController {
		
		public function index($param) {
			$this->render("index");
		}

		public function read($param) {
			$this->render("read");
		}

	}

?>
