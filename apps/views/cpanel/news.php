<div class="data-block">
	<?php
		$isAllow = $this->user->checkUserPermission("news_list_view", $this->user->data->fid);
		if ($isAllow) {
			$dataSet = $this->model->newsList($this->currentPage);
			$fields = array("fid" => "Ид.",
							"fcategory" => "Категория",
							"ftitle" => "Заголовок",
							"fcreate_date" => "Дата создания");
			$this->model->dataGrid($dataSet, $fields, "cpanel/news", 6);
		} else {
			echo "No access!";
		}
	?>
</div>