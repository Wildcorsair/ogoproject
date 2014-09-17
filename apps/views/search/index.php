<div id="content-block">
	<?php
		$dataSet = $this->model->findAll($this->currentPage);
		if (!empty($dataSet)) { ?>
			<div id="search-result-caption">
				Результаты поиска
				<div id="search-results">
	<?php 
					echo "<span>Вы искали: </span><span class='italic'>".$this->model->findPhraze."</span><br>";
					echo "<span>Найдено совпадений: </span><span class='italic'>".$this->model->recordsCount()."</span>";
	?>
				</div>
			</div>
	<?php
			foreach ($dataSet as $record) { ?>
				<div class="content-item-block">
						<h3><?php echo htmlspecialchars($record->ftitle); ?></h3>
						<div class="material-category">Категория: <?php 
											if ($record->fcategory == 1) {
												echo "Новости";
											} else {
												echo "Материалы";
											}
										?>
						</div>
						<div class="article-preview-text"><?php echo htmlspecialchars($record->fsummary_text); ?>&nbsp;
						<?php 
							if ($record->fcategory == 1) { ?>
								<a href="/news/show/<?php echo $record->fid; ?>">Читать&nbsp;далее...</a>
					<?php 	} else { ?>
								<a href="/materials/show/<?php echo $record->fid; ?>">Читать&nbsp;далее...</a>
					<?php 	} ?>
						</div>
				</div>
	<?php	
			}
	?>
	<div id="page-counter-wrapper">
		<ul>
			<?php
				$searchString = $this->model->makeSearchString();
				echo $this->model->pageNavigation($this->currentPage, $this->model->category, 5, $searchString);
			?>
		</ul>
	</div>
	<?php
		} else { ?>
			<div class="content-item-block no-bottom-border">
				<?php $this->showErrorMessage(21); ?>
			</div>
	<?php
		} 
	?>
</div>