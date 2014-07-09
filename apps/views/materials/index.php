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
						<td><?php echo $record->fcreate_date; ?></td>
						<td><span class="">Разместил: </span></td>
						<td>Администратор</td>
					</tr>	
				</tbody>
			</table>
		</div>
		<div class="article-preview-image"></div>
		<div class="article-preview-text">
			На официальном форуме игры Operation Flashpoint: Dragon Rising
			опубликовали системные требования требуемые для запуска игры
			на ПК. Если к видеокарте игра не требовательна, то процессор
			потребуется не слабый.
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
				//Навигация!
			?>
			<li><a href='#' class='curr-page'>1</a></li>
			<li><a href='#'>2</a></li>
			<li><a href='#'>3</a></li>
			<li><a href='#'>4</a></li>
		</ul>
	</div>
</div>