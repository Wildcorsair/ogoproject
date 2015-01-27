<div class="data-block">
	<?php
        $isAllow = $this->user->checkUserPermission("materials_list_view", $this->user->data->fid);
        if ($isAllow) {
            $dataSet = $this->model->materialsList($this->currentPage);
            $fields = array("fid" => "Ид.",
                            "fcategory" => "Категория",
                            "ftitle" => "Заголовок",
                            "fcreate_date" => "Дата создания");
            $this->model->dataGrid($dataSet, $fields, 'cpanel/materials', 'Материалы', 6);
        } else {
            echo "No access!";
        }
    ?>
</div>