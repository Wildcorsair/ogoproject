<div id="content-block">
	<?php
		$dataSet = $this->model->getArticlesList($this->currentPage);
		if (!empty($dataSet)) {
			foreach ($dataSet as $record) {
	?>
	<div class="content-item-block">
		<h3><?php echo $record->ftitle; ?></h3>
		<div class="material-info">
			<table>
				<tbody>
					<tr>
						<td><div class="article-date-ico"></div></td>
						<td>
							<?php 
								$convDate = array();
								$convDate = $this->model->dateConvert($record->fcreate_date);
								echo $convDate[2]."&nbsp".$convDate[1]."&nbsp".$convDate[0];
							?>
						</td>
						<td><span class="">Разместил(а): </span></td>
						<td><?php echo htmlspecialchars($record->fname); ?></td>
					</tr>	
				</tbody>
			</table>
		</div>
		<div class="article-preview-image"></div>
		<div class="article-preview-text">
			<?php echo htmlspecialchars($record->fsummary_text); ?>
			<a href="/materials/show/<?php echo $record->fid; ?>">Читать далее...</a>
		</div>	
	</div>
	<?php
			}
		}
	?>
	<div id="page-counter-wrapper">
		<ul>
			<?php
				echo $this->model->pageNavigation($this->currentPage, $this->model->category);
			?>
		</ul>
	</div>
</div>