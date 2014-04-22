<div class="block-content">
	<ul>
		<?php
			$dataSet = $this->model->getPopNews();
			if (!empty($dataSet)) {
				foreach ($dataSet as $record) {
					echo "<li><a href='/news/show/{$record->fid}'>{$record->ftitle}</a></li>";
				}
			}
		?>
	</ul>
</div>