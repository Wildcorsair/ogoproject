<?php

class Comments extends BController {

	public function leave() {
		$this->model->leave();
	}

	public function edit($commentId) {
		$this->model->edit($commentId);
	}

	public function delete($commentId) {
		$this->model->delete($commentId);
	}
}
?>