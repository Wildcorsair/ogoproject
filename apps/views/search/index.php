<div id="content-block">
		<?php
			$dataSet = $this->model->findAll();
			if (!empty($dataSet)) { ?>
				<div id="search-result-caption">
					Результаты поиска
					<div id="search-results">
		<?php 
						echo "<span>Вы искали: </span>".$_POST['searchField']."<br>";
						echo "<span>Найдено совпадений: </span>".count($dataSet);
		?>
					</div>
				</div>
		<?php
				foreach ($dataSet as $record) { ?>
					<div class="content-item-block">
						<div class="">
							<h4><?php echo htmlspecialchars($record->ftitle); ?></h4>
							<div class="article-preview-text"><?php echo htmlspecialchars($record->fsummary_text); ?>&nbsp;
							<?php 
								if ($record->fcategory == 1) { ?>
									<a href="/news/show/<?php echo $record->fid; ?>">Читать&nbsp;далее...</a></div>
							<?php } else { ?>
									<a href="/materials/show/<?php echo $record->fid; ?>">Читать&nbsp;далее...</a></div>
							<?php }?>
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