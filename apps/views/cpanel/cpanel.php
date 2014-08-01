<html>
	<head>
		<title>
			ОГО! Лысянка - Панель управления
		</title>
		<style>
			#wrapper {
				width: 1000px;
				margin: 0 auto;
				padding: 0;
				font-family: Arial, Tahoma, Verdana, sans-serif;
				font-size: 14px;
				background-color: #D7D0A5;
				/*	#243241
					#57758C
					#B5DCF4
					#D7D0A5
					#0E0F0F
				*/
			}

			#header {
				padding: 10px;
				width: 978px;
				font-size: 2em;
				color: #fff;
				background-color: #243241;
				border: 1px solid #aaa;
			}
			
			#content {
				/*width: 968px;
				font-size: 1em;
				margin: 15px;
				background-color: #ededed;
				border: 1px solid #aaa;*/
			}

			#main-menu {
				width: 968px;
				font-size: 1em;
				margin: 15px;
				background-color: #ededed;
				border: 1px solid #aaa;	
			}

			#main-menu ul {
			}

			#main-menu li {
				list-style-type: none;
				display: inline;
			}

			#main-menu li a {
				color: #243241;
				padding: 3px;
				text-decoration: none;
			}

			#workspace {
				width: 968px;
				font-size: 1em;
				margin: 15px;
				background-color: #ededed;
				border: 1px solid #aaa;
			}
		</style>
	</head>
	<body>
		<div id="wrapper">
			<div id="header">
				Панель управления
			</div>
			<div id="content">
				<div id="main-menu">
					<ul>
						<li><a href="/cpanel/news">Новости</a></li>
						<li><a href="/cpanel/materials">Материалы</a></li>
						<li><a href="#">Пользователи</a></li>
					</ul>
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