<?php

class Subscribe extends BController {
	public function go() {
		$this->model->addNewSubscriber();
	}
}

?>