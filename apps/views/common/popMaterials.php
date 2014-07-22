<div class="block-content">
	<ul>
		<?php
			$dataSet = $this->model->getPopLinks(2);
			if (!empty($dataSet)) {
				foreach ($dataSet as $record) {
					$title = htmlspecialchars($record->ftitle);
					$id = intval($record->fid);
					echo "<li><a href='/materials/show/{$id}'>{$title}</a></li>";
				}
			}
		?>
	</ul>
</div>