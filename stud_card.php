<?php
error_reporting(E_ERROR);
session_start();
include("/server/connectMysql.php");
include("/server/function.php");
mysql_query("SET NAMES 'utf8'");
$stud_id = $_GET["id"];
	//echo $stud_id;
$sql = "SELECT students.fio, students.grade, students.email, students.phone, schools.name as nameschool , students_groups.group_id as group_id, groups.name as namegroup FROM students
						JOIN students_groups ON (students_groups.student_id = students.id)
						JOIN groups ON (groups.id = students_groups.group_id)
						JOIN schools ON (schools.id = students.school_id)";
						
						if ($stud_id){
				$sql .= " WHERE students.id= $stud_id";
			}
	$result_set = mysql_query($sql);
	$result = mysql_fetch_array($result_set);
	
		
			echo mysql_error();	
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
					<li class="menu_holder"><a href="list_group.php"><div>Учебная часть</div></a></li>
					<li><a href="anketa.php"><div>Анкета	</div></a></li>
					<li><?php if (empty($_SESSION['login'])): ?> <a href="admin/index.php"><div>Войти</div></a></li>
					<li><?php elseif (isset($_SESSION['login'])): ?> <p>Здравствуйте, <?=$_SESSION['login']?><br>
					<a href="admin_panel.php"  >Панель</a>
					<a href="clear.php"  >Выйти</a>
					
					<?php endif; ?></li>
				
				</ul>
			</nav>
		</div>
			 
		<div id="content">
		<h1>Личная карточка студента</h1>
			<div id="ud_card">	
		
		<?php 	switch ($_SESSION['usertype_id']){
				case 1:
				//echo ("<input class=\"button_green\" type=\"submit\" style=\"width:200px;float:right\"  value=\"Переместить в другую группу\" onClick=\"location.href='perem_stud.php?id=".$group_id."'\">");	
				echo ("<input class=\"button_red\" type=\"submit\" style=\"width:200px;float:right\"  value=\"Изменить данные\" onClick=\"location.href='stud_card_edit.php?id=".$stud_id."'\">");	
								
				break;
						case 2:
							break;
						}
					
					
						?>
													
		
				<div id="">
					<form class="form-horizontal" method="post" action="">
				<table  class="table table-striped table-bordered table-hover">
			
						  <tr>
							<tr>
								<td><label>ФИО</label></td>
								<td><label><?php echo $result["fio"];?> </label></td>
							</tr>
							<tr>
								<td><label>Учебная группа </label></td>
								<td><label><?php echo $result["namegroup"];?></label></td>
							</tr>
							<tr>
								<td><label>Школа</label></td>
								<td><label><?php echo $result["nameschool"];?></label></td>
							</tr>
							<tr>
								<td><label>Класс</label></td>
								<td><label><?php  echo $result["grade"];?></label></td>
							</tr><tr>
								<td><label>Телефон</label></td>
								<td><label><?php  echo $result["phone"];?></label></td>
							</tr>
							<tr>
								<td><label>Электронная почта</label></td>
								<td><label><?php echo $result["email"];?></label></td>
								
							</tr>
							
		
		
		
		</div>				
			</table>		
		</form>
		<input class="button_green" style="width:100px" type="button" value="Назад" onclick="history.back()">
			</div>
		</div>
		
		<div id="footer">Copyright © 1999 – 2015 Институт математики и компьютерных наук.<br> Дальневосточный Федеральный Университет
		</div>
		
	</div>
</body>
</html>