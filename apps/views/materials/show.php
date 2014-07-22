<div id="content-block">
	<?php
		$dataSet = $this->model->getFullArticle($this->articleId);
		if (!is_null($dataSet) && $dataSet[0]->fid != null) { ?>
			<div class="content-item-block">
			
			<?php	
				foreach ($dataSet as $record) {
					echo "<input type='hidden' name='newsId' value='{$record->fid}'>";
					echo "<h3>".htmlspecialchars($record->ftitle)."</h3>";
					echo "<div class='article-info'>Разместил(а): ".htmlspecialchars($record->fname)." | ".
						date("d.m.Y", strtotime($record->fcreate_date))."</div>";
					echo "<div class='article-title-image'></div>";
					echo "<p>".$record->fnews_text."</p>";
				}
			?>
				<table>
					<tbody>
						<tr>
							<td><span class="views-count-ico"></span></td>
							<td class="counter">
								<?php echo $record->fview_count + 1;
									$this->model->setViewCount($this->articleId, $record->fview_count); 
								?>
							</td>
							<td><span class="comments-count-ico"></span></td>
							<td class="counter"><?php echo $record->fcomments_count; ?></td>
						</tr>
					</tbody>
				</table>
			</div>


			<div id="comments-block">
				<p>Комментарии:</p>
				<?php
					$dataSet = $this->model->commentsObject->getComments($this->articleId);
					if(!empty($dataSet)) {
						foreach ($dataSet as $comment) { ?>
		
				<div class="comment-item-block">
					<div class="comment-author"><?php echo htmlspecialchars($comment->fname); ?></div>
					<div class="comment-datetime">
						<?php echo date("d.m.Y | H:i:s", strtotime($comment->fcreate_date)); ?>
					</div>
						<?php
							if (isset($this->user->fid) && $comment->fauthor_id == $this->user->fid) { ?>
								<div class="edit-panel">
									<ul>
										<li><button class="edit-btn" value='<?php echo $comment->fid; ?>'></button></li>
										<li><button  class="delete-btn" value="<?php echo $comment->fid; ?>"></button></li>
									</ul>
								</div>
						<?php
							}
						?>
					<div class="clear"></div>
					<div class="comment-text"><?php echo htmlspecialchars($comment->ftext); ?></div>	
				</div>
				<?php
						}
					} else {?>
						<div class="comment-item-block">
							<?php echo "Пока комментариев нет"; ?>
						</div>
				<?php
					}
						if (!empty($this->user->fid)  && !empty($this->user->fname)) { ?>
							<p>Оставить комментарий:</p>
							<form action="/comments/leave/materials" method="POST">
								<input type="hidden" name="newsId" value="<?php echo $record->fid; ?>">
								<input type="hidden" name="category" value="materials">
								<div class="textarea-wrapper">
									<textarea name="commentText"></textarea>
								</div>
								<input type="submit" value="Комментировать" name="commentButton">
							</form>
<?php
						} ?>
			</div>
<?php
		} else { ?>
			<div class="content-item-block no-bottom-border">
					<?php header("Location: /error/message/17"); exit;//echo "Ошибка: Нет такой статьи!"; ?>
			</div>
<?php 	} ?>
</div>