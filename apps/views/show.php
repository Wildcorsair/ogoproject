<div id="content-block">
	<div class="content-item-block">
		<?php
			$dataSet = $this->model->getFullNews($this->newsId);
			if (!empty($dataSet) && !is_null($dataSet)) {
				foreach ($dataSet as $record) {
					echo "<h3>{$record->ftitle}</h3>";
					echo "<div class='article-info'>Автор: {$record->fname} | ".
							date("d.m.Y", strtotime($record->fcreate_date))."</div>";
					echo "<p>{$record->fnews_text}</p>";
		?>
		<table>
			<tbody>
				<tr>
					<td><span class="views-count-ico"></span></td>
					<td class="counter">
						<?php echo $record->fview_count + 1;
							$this->model->setViewCount($this->newsId, $record->fview_count); 
						?>
					</td>
					<td><span class="comments-count-ico"></span></td>
					<td class="counter"><?php echo $record->fcomments_count; ?></td>
				</tr>
			</tbody>
		</table>
	</div>
	<?php
				}
			} else {?>
				<div class="content-item-block">
					<?php echo "Ошибка: Нет такой статьи!"; ?>
				</div>
	<?php	}
	?>
	<div id="comments-block">
		<p>Комментарии:</p>
		<?php
			$dataSet = $this->model->commentsObject->getComments($this->newsId);
			if(!empty($dataSet)) {
				foreach ($dataSet as $comment) { ?>

		<div class="comment-item-block">
			<div class="comment-author"><?php echo $comment->fname; ?></div>
			<div class="comment-datetime">
				<?php echo date("d.m.Y | H:i:s", strtotime($comment->fcreate_date)); ?>
			</div>
				<?php
					if (isset($this->user->fid) && $comment->fauthor_id == $this->user->fid) { ?>
						<div class="edit-panel">
							<ul>
								<li><button class="edit-btn" value='<?php echo $comment->fid; ?>'></button></li>
								<!--<li><a href="/comments/edit/<?php echo $comment->fid; ?>" class="edit-btn"></a></li>-->
								<li><button  class="delete-btn" value="<?php echo $comment->fid; ?>"></button></li>
								<!--<li><a href="/comments/delete/<?php echo $comment->fid; ?>" class="delete-btn"></a></li>-->
							</ul>
						</div>
				<?php
					}
				?>
			<div class="clear"></div>
			<div class="comment-text"><?php echo $comment->ftext; ?></div>	
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
				<form action="/comments/leave" method="POST">
					<input type="hidden" name="newsId" value="<?php echo $record->fid; ?>">
					<div class="textarea-wrapper">
						<textarea name="commentText"></textarea>
					</div>
					<input type="submit" value="Комментировать" name="commentButton">
				</form>
		<?php
			}
		?>
		<div class="clear"></div>
	</div>
</div>
