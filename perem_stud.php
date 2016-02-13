<?php
error_reporting(E_ERROR);
session_start();
include("/server/connectMysql.php");
include("/server/function.php");
mysql_query("SET NAMES 'utf8'");
			$id_student = $_GET["id"];
							
							$result_set = mysql_query("SELECT * FROM students WHERE id = $id_student");
							$result = mysql_fetch_array($result_set);
								echo "<tr>";
								echo "<td>".$result["fio"]."</td>";
								echo   "<td>".$result["grade"]."</td>";
								echo   "<td>".$result["email"]."</td>";
								echo   "<td>".$result["phone"]."</td>";
								
							$sql = mysql_query("SELECT * FROM students_groups WHERE student_id = $id_student");
							echo mysql_error();	
							$sqlResult = mysql_fetch_array($sql);
							$student_groupId = $sqlResult["group_id"];
							$sql2 = mysql_query("SELECT * FROM groups WHERE id = $student_groupId");
							$sql2Result = mysql_fetch_array($sql2);
							echo   "<td>".$sql2Result["name"]."</td>";
							echo "<td><form method=\"POST\"><select name=\"group\" size=\"1\">";
									
										$sql3 = mysql_query("SELECT * FROM groups WHERE id <> $student_groupId");
															echo mysql_error();
										while ($sql3Result = mysql_fetch_array($sql3)) {
											echo "<option select value =".$sql3Result["id"].">".$sql3Result['name']."";	
										}
									
							echo "</select></td>";
							echo "<td><input type=\"submit\" method=\"post\" name=\"perevod\" value= ".$result["id"]." /></td>";
							echo "</tr> </form>";
						
							?>
						<?php
						if ( isset( $_POST['perevod'] ) ){
							perevod($id_student);
						}
						
					function perevod($id_student){
						// ОБРАТИ СЮДА ВНИМАНИЕ!!!! если нужно обновлять дату то раскаменти и добавь это в SET `startdate` = '$now'
						//$now=date("Y-m-d H:i:s");	
						$groups_id = $_POST['group'];
						echo $groups_id;
						echo $$id_student;
						$sql = mysql_query("UPDATE `students_groups` SET  `group_id` = '$groups_id' WHERE `student_id` = '$id_student'");
						echo mysql_error();
						//header ('Location: main.php');  // перенаправление на нужную страницу
						exit();// прерываем работу скрипта, чтобы забыл о прошлом
					}
						?>
						
?>
<!doctype html>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<title>Перемещение ЮД</title>
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
			<h1>Мастер классы по программированию</h1>
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
					<li class="menu_holder" ><a href="list_group.php"><div>Учебная часть</div></a>
						
					
					</li>
					<li><a href="anketa.php"><div>Анкета</div></a></li>
					<li><?php if (isset($_SESSION['name'])): ?> <p>Здравствуйте, <?=$_SESSION['name']?><br>
					<a href="admin_panel.php"  >Панель</a>
					<a href="clear.php"  >Выйти</a>
					
					<?php endif; ?></li>
				
				</ul>
			</nav>
		</div>
		
		
			 <h1>Перемещение группы</h1>
			 	<div id="main">
			
		     <div id="content">
			 <!-- Форма группы-->
				<div id="perem_stud">	
				
				<form  name="peremStud" method="post" action="">
					<h4>Из</h4> <?php/*	echo "<div name=\"old_group\">" .$result["namegroup"]. "</div>";
					echo "В";
							 echo "<select name=\"groups_id\" size=\"1\">";
								//через селект вытаскиваем названия группы используя айдишник, а так же фильтруем,
								//тоесть выводим только не закрытые группы со значением ноль.
										$groups_id = mysql_query("SELECT * FROM groups WHERE `closed` = '0' ");
								while ($result = mysql_fetch_array($groups_id)) {
									echo "<option select value =".$result["id"].">".$result['name']."";	
									}
												echo "</select>"
							?>
				
										<table id="perem_table" class="table table-striped table-bordered table-hover" >
								  <tr>
								<?php 
									$result_set = mysql_query($sql);
								while ($result = mysql_fetch_array($result_set)) {
								echo "<tr><form method=\"POST\">";
							
								echo   "<td>".$result["namestudent"]."</td>";
								echo   "<td><input name=\"perem\" type=\"checkbox\"></input></td>";
								
																					
								
								echo "</tr> </form>";
								
							}*/
							
							?>
						
						
								</table>	
					
									<input class="button_green" type="submit" name="addSubject" style="width:150px" value="Переместить"/>
									<input class="button_red" type="submit" style="width:150px;float:right;" value="Отменить"/>	
		
				
				</form>
					<?php
						
							$group_id = $_GET["id"];
							if ( isset ($_POST['peremStud']) ){
								peremStud($group_id);
							}?>
		
			</div>
		</div>
	<div id="footer">Copyright © 1999 – 2015 Институт математики и компьютерных наук.<br> Дальневосточный Федеральный Университет
		</div>
	</div>
</body>
</html>