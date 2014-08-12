<div class="data-block">
	<?php
		$isAllow = $this->user->checkUserPermission("user_list_view", $this->user->data->fid);
		if ($isAllow) {
			$dataSet = $this->model->usersList();
			$fields = array("fid" => "Ид.",
							"fname" => "Имя пользователя",
							"flogin" => "Логин",
							"fgroup_name" => "Группа пользователя",
							"fuserMail" => "Почта");
			$this->user->model->dataGrid($dataSet, $fields);
		} else {
			echo "No access!";
		}
	?>
</div>