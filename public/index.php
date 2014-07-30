<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link type="image/x-icon" rel="shortcut icon" href="/favicon.ico">
	<link rel="stylesheet" type="text/css" href="http://ogo.project.ua/public/css/styles.css">
	<script type="text/javascript" src="http://ogo.project.ua/public/js/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="http://ogo.project.ua/public/js/function.js"></script>
	<!--[if lte IE 9]>
  		<link rel="stylesheet" type="text/css" href="http://ogo.project.ua/public/css/ie.css" />
	<![endif]-->
	<title>ОГО!Лисянка</title>
</head>
<body>
	<div id="page-wrapper">
		<!--<div id="header-wrapper">-->
			<div id="top-line">
				<div id="top-block-center">
					<div id="login-form-block">
						<?php 
							$this->user = $this->model->isAuthorized();
							if (!empty($this->user->fid)  && !empty($this->user->fname)) { ?>
								<form action="/authorization/logout" method="POST">
									<div id="user-block">
										Добро пожаловать,&nbsp;<span class="user-name"><?php echo $this->user->fname; ?></span>
									</div>
									<input type="submit" name="logoutButton" value="Выйти">
								</form>
						<?php	
							} else { ?>
								<form action="/authorization/login" method="POST">
									<div class="input-wrapper">
										<input type="text" name="userEmail" value="Email адрес">
									</div>
									<div class="input-wrapper">
										<input type="password" name="userPassword" value="Пароль">
									</div>
									<input type="submit" name="loginButton" value="Войти">
									<span id="registration-href">
										<a href="/registration">Регистрация</a>
									</span>
								</form>
						<?php
							}
						?>
					</div>
				</div>
			</div>
			<div id="logo-line">
				<div id="logo-wrapper">
					<div id="logo-block"></div>
					<h6 class="logo-text-bold">ОГО!</h6>
					<h6 class="logo-text-regular">Лысянка</h6>
				</div>
			</div>
			<div id="menu-line">
				<div id="menu-block">
					<ul>
						<li><a href="/news">НОВОСТИ</a></li>
						<li><a href="/materials">МАТЕРИАЛЫ</a></li>
						<li><a href="/contacts">КОНТАКТЫ</a></li>
						<li><a href="#">ФОРУМ</a></li>
					</ul>
				</div>
			</div>
		<!--</div>-->
		<div id="content-wrapper">
			
			<!--Тут блок контента-->
			<?php
				$this->render($this->tamplate, true);
			?>
			<div class="right-block">
				<!--<div class="search-conteiner">-->
					<form action="search.php" method="POST">
						<div class="search-input-wrapper">
							<input type="text" value="Поиск по сайту" name="searchField">
							<input type="submit" value="" name="search-button">
						</div>
					</form>
				<!--</div>-->
			</div>
			<div class="right-block">
				<div class="block-title">
					Популярные новости
				</div>
				<?php
					$this->render("popNews", true, true);
				?>
				<!--<div class="block-content">
					<ul>
						<li><a href="/materials/read">Продажа акционных модемов</a></li>
						<li><a href="#">Новые тарифные планы</a></li>
						<li><a href="#">Переход на протокол DHCP</a></li>
					</ul>
				</div>-->
			</div>
			<div class="right-block">
				<div class="block-title">
					Популярные материалы
				</div>
				<?php
					$this->render("popMaterials", true, true);
				?>
				<!--<div class="block-content">
					<ul>
						<li><a href="#">Настройка модема ZTE H108L под протокол DHCP</a></li>
						<li><a href="#">Потребительский рекламный макет: бюджет на размещение или сущность и концепция маркетинговой программы</a></li>
						<li><a href="#">Почему редко соответствует рыночным ожиданиям стимулирование комьюнити?</a></li>
					</ul>
				</div>-->
			</div>
			<div class="right-block">
				<div class="block-title">
					Популярные темы
				</div>
				<div class="block-content">
					<ul>
						<li><a href="#">Революция в сетевых технологиях: сколько нужно времени?</a></li>
						<li><a href="#">Почему инет иногда так тупит и не помогает перезагрузка модема</a></li>
						<li><a href="#">Сколько стоит модем с Wi-Fi роутером?</a></li>
					</ul>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div id="empty-block"></div>
	</div>
	<div id="footer-wrapper">
		<div id="footer-block">
			<div id="footer-menu">
				<ul>
					<li><a href="/news">Новости</a></li>
					<li><a href="/materials">Материалы</a></li>
					<li><a href="/contacts">Контакты</a></li>
					<li class="last-element"><a href="#">Форум</a></li>
				</ul>
			</div>
			<div id="footer-subscribe"><span>Оставайтесь с нами:</span>
				<form id="subscribe" action="/subscribe/go" method="POST">
					<div class="input-wrapper">
						<input type="text" value="Ваше имя" name="userName">
					</div>
					<div class="input-wrapper clear-margin-right">
						<input type="text" value="Email адрес" name="subscribeEmail">
					</div>
					<input type="submit" name="subscribe-btn" value="Подписаться">
				</form>
				<div class="clear"></div>
				<div id="email-info-block">
					Пишите нам: <span>support@gmail.com</span>
				</div>
			</div>
		</div>
	</div>
	<div id="copyright-block">
		Copyright &copy; 2014 Golden Eagle Team. All rights reserved.
	</div>
</body>
</html>
