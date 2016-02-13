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
					<li class="menu_holder"><a href="list_group.php"><div>Учебная часть</div></a></li>
					<li><a href="anketa.php"><div>Анкета</div></a></li>
					<li><?php if (empty($_SESSION['login'])): ?> <a href="admin/index.php"><div>Войти</div></a></li>
					<li><?php elseif (isset($_SESSION['login'])): ?> <p>Здравствуйте, <?=$_SESSION['login']?><br>
					<a href="admin_panel.php"  >Панель</a>
					<a href="clear.php"  >Выйти</a>
					
					<?php endif; ?></li>
		
				</ul>
			</nav>
		</div>
			 <h1>Список групп</h1>
		
	
		<div id="content">
		<form id="form_group" method="post" action="/">
			<table class="table table-striped table-bordered table-hover">
			<tr><td colspan="4"><h3>Активные группы</h3>
				</td></tr>
			<tr>
			
			<th>Название группы</th>
			<th>Преподаватель</th>
			<th>Кол-во учащихся</th>
			<th>Кол-во занятий</th>
			</tr>
			<?php
			//Достаём id препода, и далее по нему фильтруем группы которые к преподу относятся
			$id_teacher  = $_SESSION['id'];
			echo ($id_teacher );
			$result_set = mysql_query("SELECT groups.id as id_group, groups.name, groups.teacher_id , teachers.fio as teachfio, groups.id FROM groups  JOIN teachers ON (teachers.id=groups.teacher_id) WHERE `closed` = '0'");
			echo mysql_error();
			while ($result = mysql_fetch_array($result_set)){
				echo "<tr>";
				echo "<td><a href=\"list_group_raiting.php?id=".$result["id"]."\">".$result["name"]."</a></td>";
				echo "<td>".$result["teachfio"]."</td>";
				echo "<td>";
				$id_group = $result["id_group"];
				$sqll = mysql_query("SELECT count(*) FROM `students_groups` WHERE `group_id` = $id_group");
				$col_stud = mysql_fetch_array($sqll);
				$total = $col_stud[0];
				echo ($total);
				
				echo mysql_error();
				echo "</td>";
				echo "<td>";
				$sql2 = mysql_query("SELECT * FROM `subjects` WHERE `group_id` = $id_group");
				while ($col_sub = mysql_fetch_array($sql2)){
					$tmp_val=$col_sub['id'];
					$sql3= mysql_query("SELECT task_id FROM `tasks` WHERE `subject_id` = $tmp_val");
					$col_task = mysql_fetch_array($sql3);
					$total2 = $col_task[0];
					//echo ($total2);
					$i=$i+1;
					echo mysql_error();
				}
				echo ($i);
				$i='';
				echo mysql_error();
				echo "</td>";
					
			}
			
			?>
				<tr><td colspan="4"><h3>Закрытые группы</h3>
				</td></tr>
				<tr>
			
			<th>Название группы</th>
			<th>Преподаватель</th>
			<th>Кол-во учащихся</th>
			<th>Кол-во занятий</th>
			</tr>
				<?php
		
			$result_set = mysql_query("SELECT groups.id as id_group, groups.name, groups.teacher_id , teachers.fio as teachfio, groups.id FROM groups  JOIN teachers ON (teachers.id=groups.teacher_id) WHERE `closed` = '1'");
			while ($result = mysql_fetch_array($result_set)){
				echo "<tr>";
				echo "<td><a href=\"list_group_raiting.php?id=".$result["id"]."\">".$result["name"]."</a></td>";
				echo "<td>".$result["teachfio"]."</td>";
				echo "<td>";
				$id_group = $result["id_group"];
				$sqll = mysql_query("SELECT count(*) FROM `students_groups` WHERE `group_id` = $id_group");
				$col_stud = mysql_fetch_array($sqll);
				$total = $col_stud[0];
				echo ($total);
			echo mysql_error();
				echo "</td>";
				echo "<td>";
				$sql2 = mysql_query("SELECT * FROM `subjects` WHERE `group_id` = $id_group");
				while ($col_sub = mysql_fetch_array($sql2)){
					$tmp_val=$col_sub['id'];
					$sql3= mysql_query("SELECT task_id FROM `tasks` WHERE `subject_id` = $tmp_val");
					$col_task = mysql_fetch_array($sql3);
					$total2 = $col_task[0];
					//echo ($total2);
					$i=$i+1;
				
					echo mysql_error();
				}
				echo ($i);
				$i='';
				echo mysql_error();
				echo "</td>";
			}
			?>
					
			</table>
			<?php
				switch ($_SESSION['usertype_id']){
					case 1:
			echo ("<input class=\"button_green\" style=\"width:200px\" type=\"submit\" onClick=\"location.href='add_group.php'\" value=\"Создать группу\">");
			//echo ("<input class=\"button_green\" type=\"submit\" style=\"width:200px\" value=\"Рассылка\"/>");
						
			break;
			case 2:
			//echo ("<input class=\"button_green\" type=\"submit\" style=\"width:200px\" value=\"Рассылка\"/>");		
					}
			?>
<input class="button_green" style="width:100px" type="button" value="Назад" onclick="history.back()">
		</form>
			 
			</div>
			
			<div id="footer" style="margin-top:40%">Copyright © 1999 – 2015 Институт математики и компьютерных наук.<br> Дальневосточный Федеральный Университет
			</div>
		</div>
	</div>
	
</body>
</html>