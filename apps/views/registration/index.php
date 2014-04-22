<div id="content-block">
		<div id="content-registration-block">
			<h3>Регистрация</h3>
			<form action="/registration/go" method="POST">
				<?php
					//Проверка ошибок при регистрации
					$this->model->checkRegError($this->errorCode);
				?>
				<div>
					<table id="registration-form">
						<tbody>
							<tr>
								<td>Логин:</td>
								<td>
									<div class="reg-input-wrapper">
										<input type="text" name="login" maxlength="20" class="text-field"
										value="<?php echo (isset($_COOKIE['login']) ? $_COOKIE['login'] : ''); ?>">
									</div>
								</td>
								<td class="hint">
									максимум 16 символов
								</td>
							</tr>
							<tr>
								<td>Пароль:</td>
								<td>
									<div class="reg-input-wrapper">
										<input type="password" name="pass" maxlength="16" class="text-field" 
										value="<?php echo (isset($_COOKIE['pass']) ? $_COOKIE['pass'] : ''); ?>">
									</div>
								</td>
								<td class="hint">
									от 8 до 16 символов
								</td>
							</tr>
							<tr>
								<td>Подтверждение пароля:</td>
								<td>
									<div class="reg-input-wrapper">
										<input type="password" name="passConfirm" maxlength="16" class="text-field" 
										value="<?php echo (isset($_COOKIE['passConfirm']) ? $_COOKIE['passConfirm'] : ''); ?>">
									</div>
								</td>
								<td class="hint">
									введенные пароли должны совпадать
								</td>
							</tr>
							<tr>
								<td>Ваше имя:</td>
								<td>
									<div class="reg-input-wrapper">
										<input type="text" name="name" class="text-field" 
										value="<?php echo (isset($_COOKIE['name']) ? $_COOKIE['name'] : ''); ?>">
									</div>
								</td>
								<td class="hint">
									укажите Ваше имя которое будет отображаться в сообщениях и по которому к Вам будут обращаться
								</td>
							</tr>
							<tr>
								<td>EMail-адрес:</td>
								<td>
									<div class="reg-email-input-wrapper">
										<input type="text" name="userMail" class="email-text-field" 
										value="<?php echo (isset($_COOKIE['userMail']) ? $_COOKIE['userMail'] : ''); ?>">
									</div>
								</td>
								<td class="hint">
									введите действующий адрес, иначе не сможете подтвердить регистрацию
								</td>
							</tr>
							<tr>
								<td>Пол:</td>
								<td>
									<input type="radio" <?php echo (isset($_COOKIE['sex']) && $_COOKIE['sex'] == 0) ? 'checked' : ''; ?> 
									name="sex" value="0">&nbsp;Мужской<br />
									<input type="radio" <?php echo (isset($_COOKIE['sex']) && $_COOKIE['sex'] == 1) ? 'checked' : ''; ?>
									name="sex" value="1">&nbsp;Женский
								</td>
								<td class="hint">
								</td>
							</tr>
							<tr>
								<td>Город:</td>
								<td>
									<div class="reg-input-wrapper">
										<input type="text" name="city" maxlength="50" class="text-field"
										value="<?php echo (isset($_COOKIE['city']) ? $_COOKIE['city'] : ''); ?>">
									</div>
								</td>
								<td class="hint">
								</td>
							</tr>
							<tr>
								<td colspan="3"><input type="submit" name="regUser" value="Регистрация"></td>
							</tr>
						</tbody>
					</table>
				</div>
			</form>
		</div>
</div>
