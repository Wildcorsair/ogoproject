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
		<title>
			ОГО! Лысянка - Панель управления
		</title>
		<style>
			html, body, div, ul, li {
				margin: 0;
				padding: 0;
			}
			
			body {
				min-width: 1000px;
				background-color: #2e5e79;				
			}
			
			#wrapper {
				width: 96%;
				min-width: 1000px;
				margin: 0 auto;
				padding: 0;
				font-family: Arial, Tahoma, Verdana, sans-serif;
				font-size: 14px;
				background-color: #2e5e79;
			}

			#header {
				padding: 30px 0;
				width: 100%;
				height: 40px;
				min-width: 1000px;
				font-size: 2em;
				color: #fff;
				font-family: Impact;
				background: url('../public/images/cpanel-header-bkg.jpg') repeat-x;
			}
			
			#logo {
				width: 253px;
				height: 27px;
				float: left;
				margin-top: 5px;
				margin-left: 30px;
				background: url('../public/images/cpanel-logo.png') no-repeat;
			}

			#user-panel-block {
				color: #d8f9fd;
				width: 250px;
				height: 27px;
				float: right;
				font-size: 0.55em;
				margin-right: 30px;
				margin-top: 5px;
				text-align: right;
				font-family: Impact, Arial, sans-serif;
			}
			
			#user-panel-block>a {
				color: #fff;
				text-decoration: none;
			}

			#user-panel-block>a:hover {
				color: #4169ac;
			}

			#content {
				min-width: 1000px;
				width: 100%;
				margin-top: 15px;
				font-size: 1em;
				/*background-color: #416986;*/
			}

			#main-menu {
				min-width: 998px;
				width: 100%;
				height: 48px;
				font-size: 1em;
				margin: 0 auto;
				padding: 1px 0;
				background-color: #416986;
				background: url("../public/images/cpanel-menu-bkg.png") repeat-x;
			}

			#main-menu li {
				list-style-type: none;
				display: inline;
				height: 48px;
			}

			#main-menu li a {
				color: #fff;
				display: block;
				float: left;
				height: 22px;
				padding: 12px;
				margin: 1px 1px 0 1px;
				text-align: center;
				text-decoration: none;
				outline: none;
				font-size: 1.15em;
				font-family: Verdana, Tahoma, Arial, sans-serif;
			}
			
			#main-menu li a:hover {
				background-color: #204764;
			}

			#side-bar {
				width: 198px;
				background-color: #ededed;
				border: 1px solid #aaa;
				float: left;
			}
			
			#workspace {
				min-width: 783px;
				font-size: 1em;
				margin-left: 215px;
				background-color: #ededed;
				border: 1px solid #aaa;
			}
			.data-block {
				padding: 10px;
			}

			.grid-frame {
				height: 260px;
				margin: 5px;
				border: 1px solid #8dd8e1;
				overflow: hidden;
			}

			.grid-header {
				height: 23px;
				padding: 3px;
				color: #616161;
				background-color: #edfdff; /*#d8f9fd;*/
				border-bottom: 1px solid #8dd8e1;
				font-size: 18px;
				font-family: Arial, Tahoma, Verdana, sans-serif;
			}

			.grid-workspace {
				overflow: auto;
				height: 200px; /*.grid-frame (height - 60px)*/
			}

			.grid-footer {
				height: 23px;
				padding: 3px;
				color: #616161;
				border-top: 1px solid #8dd8e1;		
			}

			table {
				color: #444649;
				/*border-top: 1px solid #cdcdcd;
				border-left: 1px solid #cdcdcd;*/
			}

			thead {
				text-align: center;
				font-size: 16px;
				color: #616161;
				background-color: #edfdff;
			}

			tr {
				cursor: default;
			}

			tbody>tr:hover {
				background-color: #d7d7d7;
			}

			td {
				border-bottom: 1px solid #a4a4a4;
				border-right: 1px solid #a4a4a4;
			}
		</style>
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
							<li><a href="/cpanel/users">Пользователи</a></li>
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