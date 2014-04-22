<div id="content-block">
	<?php
		$dataSet = $this->model->getNewsList($this->currentPage);
		if (!empty($dataSet)) {
			foreach ($dataSet as $record) { ?>
				<div class="content-item-block">
					<div class="date-block">
						<?php 
							$convDate = array();
							$convDate = $this->model->dateConvert($record->fcreate_date);
						?>
						<p class="day"><?php echo $convDate[2]; ?></p>
						<p class="month"><?php echo $convDate[1]; ?></p>
						<p class="year"><?php echo $convDate[0]; ?></p>
					</div>
					<div class="text-block">
						<h3><?php echo $record->ftitle; ?></h3>
						<p class="posted">Разместил: <?php echo $record->fname." | Комментариев: ".$record->fcomments_count; ?></p>
						<?php echo $record->fsummary_text; ?>&nbsp;
						<a href="/news/show/<?php echo $record->fid; ?>">Читать далее...</a>
					</div>
				</div>
				<?php
			}
		} ?>
	<div id="page-counter-wrapper">
		<ul>
			<?php
				echo $this->model->pageNavigation($this->currentPage);
			?>
		</ul>
	</div>
</div>