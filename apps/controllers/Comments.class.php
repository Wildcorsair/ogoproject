<?php

class Comments extends BController {

	public function leave($category) {
		$this->model->leave($category, $this->user);
	}

	public function edit($commentId) {
		$this->model->edit($commentId, $this->user);
	}

	public function delete($commentId) {
		$this->model->delete($commentId, $this->user);
	}
}
?>