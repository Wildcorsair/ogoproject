<div class="data-block">
	<?php
		$isAllow = $this->user->checkUserPermission("user_list_view", $this->user->data->fid);
		if ($isAllow) {
			$dataSet = $this->model->usersList($this->currentPage);
			$fields = array("fid" => "Ид.",
							"fname" => "Имя пользователя",
							"flogin" => "Логин",
							"fgroup_name" => "Группа пользователя",
							"fuserMail" => "Почта");
			$this->model->dataGrid($dataSet, $fields, "cpanel/users", 7);
		} else {
			echo "No access!";
		}
	?>
</div>