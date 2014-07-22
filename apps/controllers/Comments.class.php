<?php

class Comments extends BController {

	public function leave($category) {
		$this->model->leave($category);
	}

	public function edit($commentId) {
		$this->model->edit($commentId);
	}

	public function delete($commentId) {
		$this->model->delete($commentId);
	}
}
?>