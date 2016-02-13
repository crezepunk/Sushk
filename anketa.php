<?php
error_reporting(E_ERROR);
session_start();
include("/server/connectMysql.php");
include("/server/function.php");
mysql_query("SET NAMES 'utf8'");
?>
<!doctype html>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<title>Система контроля успеваемости</title>
	<link rel="stylesheet" href="css/styles.css" type="text/css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,300" type="text/css">
	<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
	<script type="text/javascript" src="/js/jquery.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<!--[if lt IE 9]><script type="text/javascript" src="/js/jquery.js"></script>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>

<body>
	<div id="wrapper">
		<div id="header">
			<h1>Мастер-класс по программированию</h1>
		</div>
			 <div id="menu">
			<nav role="navigation">
				<ul>
					<li><a href="index.php"><div>Главная</div></a></li>
					<li><a><div>Информация</div></a>
						<div>
							<ul>
								<li><a href="info.php">О мастер-классах</a></li>
								<li><a href="prep_list.php">Список преподавателей</a></li>
							</ul>
						</div>
					</li>
					<li><a href="list_group.php" ><div>Учебная часть</div></a>
						
					
					</li>
					<li class="menu_holder"><a href="anketa.php"><div>Анкета</div></a></li>
					<li><?php if (empty($_SESSION['login'])): ?> <a href="admin/index.php"><div>Войти</div></a></li>
					<li><?php elseif (isset($_SESSION['login'])): ?> <p>Здравствуйте, <?=$_SESSION['login']?><br>
					<a href="admin_panel.php"  >Панель</a>
					<a href="clear.php"  >Выйти</a>
					
					<?php endif; ?></li>
					
				</ul>
			</nav>
		</div>
			
	 <div id="content">
	 <h1 >Подача заявки на обучение</h1>
		<div id="anketa">
			
				<form class="form-horizontal" method="post" action="">
					<input type="text" name="lastName" class="placeholder" placeholder="Фамилия"/><br/>
					<input type="text" name="name" class="placeholder" placeholder="Имя"/><br/>
					<input type="text" name="middleName" class="placeholder" placeholder="Отчество"/><br/>
					
					<select placeholder="Школа" name="schoolsId" size="1">
									<?php
									//через селект вытаскиваем тип по айди
										$schools_id = mysql_query("SELECT * FROM schools ");
										while ($result = mysql_fetch_array($schools_id)) {
											echo "<option select value =".$result["id"].">".$result['name']."";	
										}
									?>
					</select><br/>
					<input type="text" name="grade" class="placeholder" placeholder="Класс"/><br/>
					<input type="text" name="email" class="placeholder" placeholder="Электронная почта"/><br/>
					<input type="text" name="phone" class="placeholder" placeholder="Телефон"/><br/>
					<input class="button_green" name="action" type="submit" style="width:200px" value="Подать заявку"/>
					<input type="hidden" name="action" value="reg" />
				</form>
				<?php
				if ( isset( $_POST['action'] ) ){
					addCard();
				}
				?>
		</div>
	</div>
	
		
	<div id="footer">Copyright © 1999 – 2015 Институт математики и компьютерных наук.<br> Дальневосточный Федеральный Университет
		</div>
	</div>
</body>
</html>