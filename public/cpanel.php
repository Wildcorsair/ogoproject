<?php
	$this->user->isUserAuthorized();
	if (!empty($this->user->data->fid)) {
		$isAllow = $this->user->checkUserPermission("cpanel_access", $this->user->data->fid);
		if (!$isAllow) {
			header("Location: /");
			exit();
		}
	} else {
		header("Location: /");
		exit();		
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link type="image/x-icon" rel="shortcut icon" href="/favicon.ico">
		<link rel="stylesheet" type="text/css" href="http://ogo.project.ua/public/css/cpanel.css">
		<link rel="stylesheet" type="text/css" href="http://UI-Controls/css/controls.css">
		<script type="text/javascript" src="http://ogo.project.ua/public/js/jquery-1.11.0.min.js"></script>
		<script type="text/javascript" src="http://ogo.project.ua/public/js/cpanel.js"></script>
		<script type="text/javascript" src="http://UI-Controls/js/function.js"></script>
		<title>
			ОГО! Лысянка - Панель управления
		</title>
	</head>
	<body>
		<div id="wrapper">
			<div id="header">
				<div id="logo"></div>
				<div id="user-panel-block">
					<?php
						echo $this->user->data->fname." | ";
					?>
					<a href="/">Выход</a>
				</div>
			</div>
			<div id="main-menu">
				<ul>
					<li><a href="/cpanel/news">Новости</a></li>
					<li><a href="/cpanel/materials">Материалы</a></li>
					<?php
						$isAllow = $this->user->checkUserPermission("user_list_view", $this->user->data->fid);
						if ($isAllow) { ?>
							<li><a id='usr' href="/cpanel/users">Пользователи</a></li>
					<?php	
						}
					?>
				</ul>
			</div>
			<div id="content">
				<div id="side-bar">
					Side-bar
				</div>
				<div id="workspace">
					<?php
						$this->render($this->tamplate, true);
					?>
				</div>
			</div>
		</div>
	</body>
</html>