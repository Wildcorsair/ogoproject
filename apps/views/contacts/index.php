<div id="content-block">
	<div id="content-registration-block">
		<h3>Контакты</h3>
		<table id="contacts">
			<tbody>
				<tr class="caption">
					<td>EMAIL:</td>
				</tr>
				<tr>
					<td>wildcorsar@rambler.ru</td>
				</tr>
				<tr class="caption">
					<td>SKYPE:</td>
				</tr>
				<tr>
					<td>wildcorsair</td>
				</tr>
			</tbody>
		</table>
		<?php
			if (!empty($this->infoMsg)) {
				$this->model->checkInfoMsg($this->infoMsg);
			}
		?>
		<div id="feedback-form">
			<!--Dialog Window
			<div class="black-frame">	
				<div class="dialog">
					<div class='dialog-title'>Предупреждение!</div>
						<div class='dialog-text'>
							Пустое имя пользователя!
						</div>
						<div class='dialog-buttons'>
							<button class='last' onclick='hideDialog(); return false;'>Ок</button>
						</div>
				</div>
			</div>-->
			<h4>Пишите нам:</h4>
			<form id="feedback" action="/contacts/feedback" method="POST">
				<table>
					<tbody>
						<tr>
							<td>
								<div class="reg-input-wrapper">
									<input type="text" name="feedbackUser" maxlength="20" class="text-field" 
									value="<?php echo (isset($_COOKIE['uName']) ? $_COOKIE['uName'] : 'Ваше имя'); ?>">
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="reg-email-input-wrapper">
									<input type="text" name="feedbackEmail" class="email-text-field" 
									value="<?php echo (isset($_COOKIE['uEmail']) ? $_COOKIE['uEmail'] : 'Email адрес'); ?>">
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="feedback-textarea-wrapper">
									<textarea name="feedback-textarea"><?php echo (isset($_COOKIE['uMessage']) ? $_COOKIE['uMessage'] : 'Ваше сообщение'); ?></textarea>
								</div>
							</td>
						</tr>
						<tr>
							<td><input type="submit" name="postFeedback" value="Отправить"></td>
						</tr>
					</tbody>
				</table>
			</form>
			<?php
				isset($_COOKIE["uName"]) ? setcookie("uName", "") : "";
				isset($_COOKIE["uEmail"]) ? setcookie("uEmail", "") : "";
				isset($_COOKIE["uMessage"]) ? setcookie("uMessage", "") : "";
			?>
		</div>
	</div>
</div>