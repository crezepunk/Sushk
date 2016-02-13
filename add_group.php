<?php
error_reporting(E_ERROR);
session_start();
include("/admin/serverforadmin/connectMysql.php");
include("/admin/serverforadmin/function.php");
mysql_query("SET NAMES 'utf8'");
?>

<!doctype html>
<html>
<head>
<link href="css/customstyle.css" rel="stylesheet">
<link href="css/reset.css" rel="stylesheet">
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<title>Система контроля успеваемости</title>
	<link rel="stylesheet" href="css/styles.css" type="text/css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,300" type="text/css">
	<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
	<script type="text/javascript" src="/js/jquery.js"></script>
	<script type="text/javascript" src="/js/jquery.leanModal.min.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<!--[if lt IE 9]><script type="text/javascript" src="/js/jquery.js"></script>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>

<body>
	<div id="wrapper">
		<div id="header">
			<h1>Мастер-rласс по программированию</h1>
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
					<li><a href="list_group.php" class="menu_holder"><div>Учебная часть</div></a>
						
					
					</li>
					<li><a href="anketa.php"><div>Анкета</div></a></li>
					<li><?php if (empty($_SESSION['login'])): ?> <a href="admin/index.php"><div>Войти</div></a></li>
					<li><?php elseif (isset($_SESSION['login'])): ?> <p>Здравствуйте, <?=$_SESSION['login']?><br>
					<a href="admin_panel.php"  >Панель</a>
					<a href="clear.php"  >Выйти</a>
					
					<?php endif; ?></li>
			
				</ul>
			</nav>
		</div>
			
	 <div id="content">
	 <h1>Создание новой группы</h1>

		<form id="add_group" name="addgroup" method="post" action="">
			<table>
			<tr>
						
						<tr><td>
							<p>Название группы<br/>
							<input type="text" style="width:300px" name="name"/></p>
						</td></tr>	
				<tr>
					<td><p>Выберите ступень<br/>
						<select name="grouptypes_id" size="1">
									<?php
									//через селект вытаскиваем тип по айди
										$grouptypes_id = mysql_query("SELECT * FROM grouptypes ");
										while ($result = mysql_fetch_array($grouptypes_id)) {
											echo "<option select value =".$result["id"].">".$result['type']."";	
										}
									?>
							</select>
					</td>
					
				</tr>
				
				<tr>
					<td><p>Выберите преподавателя<br/>
						<select name="teacher_id" size="1">
									<?php
									//через селект вытаскиваем тип по айди
										$teacher_id = mysql_query("SELECT * FROM teachers ");
										while ($res = mysql_fetch_array($teacher_id)) {
											echo "<option select value =".$res["id"].">".$res['fio']."";	
										}
									?>
							</select>
					</td>
					</tr>
				
							
			
<tr><td>

				<input class="button_green" type="submit" style="width:200px;margin-left:15%" name="addgroup" value="Создать" />
							<?php
							//оставил adduser просто из-за того что прост всё не ложилось
							if (isset($_POST["addgroup"])){
					
								$name = $_POST['name'];
								$teacher_id = $_POST['teacher_id'];
								$grouptypes_id = $_POST['grouptypes_id'];
								$now=date("Y-m-d H:i:s");
								//echo $now;
								$sql = mysql_query("INSERT INTO `groups` (`name`, `teacher_id` , `startdate` ,	`grouptype_id`) VALUES ('$name', '$teacher_id', '$now', '$grouptypes_id') ");
								echo mysql_error();
									echo "<div id = \"parent_div\">
										  <div id = \"div\">
											<p>Вы успешно добавили новую группу</p>
											<a href=\"add_group.php\">Я очень рад этому</a>
											<p>..</p>
											
										  </div>
										</div>";
							}
						
						
								
							
						?>
							<input class="button_red" type="submit" style="width:200px;margin-left:15%"  onClick="location.href='list_group.php" value="Отменить"/>		
</td></tr>					

		</tr>
		</form>
		<input class="button_green" style="width:100px" type="button" value="Назад" onclick="history.back()">
			</table>
	</div>
	
	
		
	<div id="footer">Copyright © 1999 – 2015 Институт математики и компьютерных наук.<br> Дальневосточный Федеральный Университет
		</div>
	</div>
</body>
</html>