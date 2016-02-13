<?php
error_reporting(E_ERROR);
session_start();
include("/server/connectMysql.php");
include("/server/function.php");
mysql_query("SET NAMES 'utf8'");
$group_id = $_GET["id"];
		$sql = "SELECT students_groups.student_id ,students_groups.group_id, students.fio as namestudent , teachers.fio as teachfio, groups.name as namegroup, subjects.id as id_subject FROM students_groups 
										JOIN groups ON (groups.id=students_groups.group_id)
										JOIN teachers ON (teachers.id=groups.teacher_id)
										JOIN subjects ON (subjects.group_id=groups.id)
										JOIN students ON (students.id=students_groups.student_id)";
										
			if ($group_id){
				$sql .= " WHERE students_groups.group_id= $group_id";
			}
			$result_set = mysql_query($sql);
			$result = mysql_fetch_array($result_set);
				$date = mysql_query("SELECT tasks.days FROM tasks");
				$date2 = mysql_fetch_array($date);
				$date3 =  mysql_query("DAYOFMONTH('$date')");
				$date4 = mysql_fetch_array($date3);
				echo $date4;
	//			SELECT DATE_FORMAT("2008-11-19",'%d.%m.%Y');
?>

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
					<li><a href="/"><div>Главная</div></a></li>
					<li><a href="/blog"><div>Информация</div></a>
						<div>
							<ul>
								<li><a href="#">О мастер-классах</a></li>
								<li><a href="#">Список преподавателей</a></li>
								<li><a href="#">Расписание</a></li>
							</ul>
						</div>
					</li>
					<li class="menu_holder"><a href="list_group.php"><div>Учебная часть</div></a></li>
					<li><a href="anketa.php"><div>Подать заявку</div></a></li>
					<li><a href="/forum"><div>Контакты</div></a></li>
				</ul>
			</nav>
		</div>
			 <h1>Рейтинг <?php echo $result["namegroup"];  ?></h1> <!-- БЕРЕМ ИЗ БАЗЫ-->
	<div id="content">
			<div id="view_task">	
				<div id="">
					
						<p> <?php echo $result["teachfio"];?> 
							<!--switch ($_SESSION['usertype_id']){
								case 1:
					//ЭТА КНОПКА 'сменить препода' ТОЛЬКО ДЛЯ АДМИНА
						echo ("<input class=\"button_green\" type=\"submit\" style=\"width:100px\" value=\"Сменить\">");
						echo ("<input class=\"button_red\" type=\"submit\" style=\"width:200px;float:right\"  value=\"Добавить новое занятие\" onClick=\"location.href=\'prep_add_task.php?id=".$group_id = $_GET["id"]."\">");	
						break;
						case 2:
						echo ("<input class=\"button_red\" type=\"submit\" style=\"width:200px;float:right\"  value=\"Добавить новое занятие\" onClick=\"location.href=\'prep_add_task.php?id=".$group_id = $_GET["id"]."\">");	
						break;
						}
						?>
				<!-- только для админа и препода--><input class="button_red" type="submit" style="width:200px;float:right" onClick="location.href='prep_add_task.php?id=<?php
																																													$group_id = $_GET["id"];
																																													echo "$group_id";?> '"  value="Добавить новое занятие"/><br></p>
				
				</div>
					<form class="form-horizontal" method="post" action="">		

				<table id="admin_table_list_group" border="2px" class="table table-striped table-bordered table-hover">
				
					<tr>
						<td width="100px"  rowspan="1">ФИО
						</td>
						<?php
							$sql2 = mysql_query("SELECT id, date FROM subjects WHERE group_id = $group_id");
							echo mysql_error();
							$dataRow = Array();
							$SubjectsArray = Array();
							$p = 0;
							while ($result3 = mysql_fetch_array($sql2)) {
								$dataRow[$p]['id'] = $result3["id"];
								$p++;
								$SubjectsArray[] = $result3["id"];
								echo   "<td>".$result3["date"]."";
								echo "".$idshnikiSubjectov."</td>";
								
								
							}
							
						?>
					</tr>
					
					<?php
					
						$sql = "SELECT students_groups.student_id ,students_groups.group_id,
										students.fio as namestudent, students.id as IdishnikStudenta, groups.name as namegroup 
											FROM students_groups 
												JOIN groups ON (groups.id=students_groups.group_id)
												JOIN students ON (students.id=students_groups.student_id)";
						if ($group_id){
							$sql .= " WHERE students_groups.group_id= $group_id";
						}
						
						$result_set = mysql_query($sql);
						
						while ($result = mysql_fetch_array($result_set)){
							
							//$result3["id"];
							echo $idshnikiSubjectov ;
							echo "<tr>";
							
							echo  "<td>".$result["namestudent"]."";
							$IdishnikStudenta = $result["IdishnikStudenta"];
							echo "".$IdishnikStudenta."</td>";
							foreach ($SubjectsArray as $subject){
								echo "<td>";
								
								$sql33 = mysql_query("SELECT * FROM tasks 
										LEFT JOIN tasks_students ON(tasks_students.task_id=tasks.task_id)
												WHERE (tasks.subject_id = $subject) AND (tasks_students.student_id = ".$result["student_id"]." ) ");
								echo mysql_error();	
								if (mysql_num_rows($sql33) > 0 ){
										while ($resultView = mysql_fetch_array($sql33)){
										echo "<div>";
										echo $resultView['task_name'].": ".$resultView['mark'];
										echo "</div>";
										}
								
								}
								else{
									echo "<div style=\"color:red;\">АЙ АЙ Ай</div>";
								}
								
								echo "</td>";
							}
							/*
							// пробуем отрисовать задания используя айди каждой темы.
							//$sqlZaprosTask =  mysql_query("SELECT * FROM tasks WHERE subject_id = $idshnikiSubjectov");
							//echo mysql_error();	
							//echo "<td>SELECT * FROM tasks WHERE subject_id = $idshnikiSubjectov</td>";
							//while ($resultView = mysql_fetch_array($sqlZaprosTask)){
								$task_id = $resultView["task_id"];
								
								
								//пытаемся получить задания студента. и вставить в рэйтинг запись mark
								//$sqlZaprosTasks_students_mark =  mysql_query("SELECT * FROM tasks_students WHERE student_id = $IdishnikStudenta AND task_id = $task_id ELSE  ");
								$sqlZaprosTasks_students_mark =  mysql_query("SELECT * FROM tasks_students WHERE student_id = $IdishnikStudenta AND task_id = $task_id");
								echo mysql_error();
								while($resultViewMark = mysql_fetch_array($sqlZaprosTasks_students_mark)){
									
									if ($IdishnikStudenta != $resultViewMark["student_id"] or $task_id != $resultViewMark["task_id"]   ){	
									
										echo "FUCK YOU!";
									}
									else {
										echo "<td>";
										///echo $resultViewMark["mark"];
										echo"111111";
										echo "</td>";
									}
								}
							}	*/
							echo "</tr>";
						}
					?>
					
						<?php
						// ищем темы по айди группы для того чтобы перейти в базу таск
						
						/*		$dateSql = "SELECT  FROM `tasks` WHERE `subject_id` = 10 ";
						$resultdate = mysql_query($dateSql);
						while ($newresultdate = mysql_fetch_array($resultdate)) {
							echo "<td style=\"width:15px\"><a href=\"view_task.php?id=".$result["id_subject"]."\">".$result["id_subject"]."</a></td>";
						}
						 */
						 ?>
						
					
					
				
					</tr>
				</table>	
					<input class="button_green" type="submit" style="width:220px" value="Отправить уведомление группе"/>	
					<input class="button_green" type="submit" style="width:200px" action="perem_stud.php" value="Переместить группу"/>
					<!-- <input class="button_red" type="submit" style="width:200px" value="Расформировать группу"/> -->
					</form>
			</div>
		</div>
		
		<div id="footer">Copyright © 1999 – 2015 Институт математики и компьютерных наук.<br> Дальневосточный Федеральный Университет
		</div>
		
	</div>
</body>
</html>