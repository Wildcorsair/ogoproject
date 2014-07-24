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
		<div id="feedback-form">
			<!--<div id="warning-window">
				Сообщение!
			<div>-->
			<h4>Пишите нам:</h4>
			<form id="feedback" action="/contacts/feedback" method="POST">
				<table>
					<tbody>
						<tr>
							<td>
								<div class="reg-input-wrapper">
									<input type="text" name="feedbackUser" maxlength="20" class="text-field" value="Ваше имя">
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="reg-email-input-wrapper">
									<input type="text" name="feedbackEmail" class="email-text-field" value="Email адрес">
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="feedback-textarea-wrapper"><textarea name="feedback-textarea">Ваше сообщение</textarea></div>
							</td>
						</tr>
						<tr>
							<td><input type="submit" name="postFeedback" value="Отправить"></td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
	</div>
</div>