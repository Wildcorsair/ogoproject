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
				margin-top: 5px;
				margin-left: 30px;
				background: url('../public/images/cpanel-logo.png') no-repeat;
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
				height: 26px;
				padding: 10px;
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
		</style>
	</head>
	<body>
		<div id="wrapper">
			<div id="header">
				<div id="logo"></div>
			</div>
			<div id="main-menu">
				<ul>
					<li><a href="/cpanel/news">Новости</a></li>
					<li><a href="/cpanel/materials">Материалы</a></li>
					<li><a href="#">Пользователи</a></li>
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