<?php 
error_reporting(E_ERROR);
session_start();
include("/server/connectMysql.php");
include("/server/function.php");
mysql_query("SET NAMES 'utf8'");
$subject_id = $_GET["subject_id"];
$group_id = $_GET["group_id"];
	
		
			$sql = "SELECT *  FROM subjects,tasks ";
			
			if ($group_id ){
				$sql .= " WHERE subjects.id= $subject_id and tasks.subject_id=$subject_id ";
			}
			$result_set = mysql_query($sql);
			$result = mysql_fetch_array($result_set);
	

			?>

<!doctype html>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<title>Просмотр занятия</title>
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
					<li class="menu_holder"><a href="list_group.php"><div>Учебная часть</div></a></li>
					<li><a href="anketa.php"><div>Анкета</div></a></li>
					<li class="menu_holder"><?php if (isset($_SESSION['login'])):?> <p>Здравствуйте, <?=$_SESSION['login']?><br>
					<a href="admin_panel.php"  >Панель</a>
					<a href="clear.php"  >Выйти</a>
					
					<?php endif; ?></li>
			
				</ul>
			</nav>
		</div>
		
				
		     <div id="content">
			  <h1>Просмотр занятия</h1>
			 <!-- Форма группы-->
				<div id="view_task">
					<a onclick="$('#name').slideToggle('slow');" href="javascript://">Свернуть/Развернуть занятие</a>				
				<form class="form-horizontal" method="post" action="">
					
					<div  id="name" class="NavFrame">
						<?php 
						$result_set = mysql_query($sql);

						echo "<div style=\"width:74%;background-color:white;display:inline-block;padding:4px;\">" .$result["name"]. "</div>";	

						echo "<div style=\"width:14%;background-color:white;display:inline-block;margin-top:1%;margin-left:2%;padding:4px\">" .$result["days"]."</div><br>";	
						
						echo "<div style=\"width:90%;background-color:#FDF5E6;margin-top:1%;height:auto;min-height:70px\">" .$result["description"]."</div><br>";
						$TasksIdArray = Array();
						while ($result = mysql_fetch_array($result_set)){
							echo "<div style=\"width:74%;background-color:white;display:inline-block;margin-top:1%;padding:4px\">" .$result["task_name"]."</div>";	
							echo "<div style=\"width:14%;background-color:white;display:inline-block;margin-top:1%;;margin-left:2%;padding:4px\">".$result["task_weight"]."</div>";	
							echo "<div style=\"width:90%;background-color:#FDF5E6;margin-top:1%;height:auto;min-height:50px\">".$result["task_description"]."</div>";	
							echo "<hr>";
							$TasksIdArray[] =  $result["task_id"];
							$subject_idddddd = $result["id"];
						}
						
						?>
						
					
						
					</div>
				
					<table id="table_edit" border="2px" class="table table-striped table-bordered table-hover" >
					  <tr>
					  <tr>
							<td ><label>Список группы</label></td>
							<td style="width:20px;font:15px verdana"><label>Посещение</label><br></td>
							<td style="width:20px"><label>1</label><br></td>
						
						</tr>
					<?php 
					// список айди заданий для получения списка отметок за задания
					
						$sql = "SELECT students_groups.student_id ,students_groups.group_id, students.fio as namestudent , groups.name as namegroup FROM students_groups 
														JOIN groups ON (groups.id=students_groups.group_id)
														JOIN students ON (students.id=students_groups.student_id)";
							if ($group_id){
								$sql .= " WHERE students_groups.group_id = $group_id";
							}
							$result_set = mysql_query($sql);
							while ($result = mysql_fetch_array($result_set)) {
								echo "<tr><form method=\"POST\">";
								$student_idForWork =  $result["student_id"];
								echo   "<td>".$result["namestudent"]."</td>";
								$subject_idddddd;
								
								$sql10 = mysql_query("SELECT * FROM subjects_students WHERE student_id = $student_idForWork AND subject_id = $subject_idddddd");
								echo mysql_error();
								while ($result2398 = mysql_fetch_array($sql10)) {
									
								
								switch ($result2398['work']){
									case 0:
									echo ("<td> <form method=\"post\"> <input  type=\"checkbox\" name=\"addWork\" value=\"".$result2398['student_id']."\" onchange=\"this.form.submit()\"></form></td>");	
									break;
									
									case 1:
									echo ("<td> <form method=\"post\"> <input  type=\"checkbox\" name=\"blabla\" value=\"".$result2398['student_id']."\" onchange=\"this.form.submit()\" checked=\"checked\"> </form></td>");	
									break;
									
								}
								
								
								
								}
													
								//$sql = "SELECT *  FROM subjects,tasks ";
								
								
							foreach ($TasksIdArray as $tasksId){
									
									echo   "<td><form id=\"".$tasksId."\" method=\"post\" action=\"\" ><div><select name=\"selectttt\" size=\"1\" onchange=\"this.form.submit()\">";	
									//определяем количество опшинов для селекта, то есть бал от 1 до максимального указанного в бд
									$sql102 = mysql_query("SELECT * FROM tasks WHERE task_id = $tasksId");
									$result239238 = mysql_fetch_array($sql102);
									$taskWeight = $result239238['task_weight'];
									for ($i = 1; $i <= $taskWeight; $i++){
										echo "<option select value =\" ".$i.":".$tasksId.":".$student_idForWork."\">".$i."</option>";
									}
									echo "</select></div></form></td>";
								}
								
								
							}	
							echo "</tr> </form>";
							
							if ( isset( $_POST['selectttt'] ) ){
								$data = $_POST['selectttt'];
								list($mark, $task_idForMark, $studentIdForMark) = explode(":", $data);
								addMark($mark,$task_idForMark,$studentIdForMark);
							}
							
							
							if ( isset( $_POST['blabla'] ) ){
								echo ($_POST['blabla']);
									$studentIdForAddWork2 = $_POST['deleteWork'];
									echo $studentIdForAddWork2;
									deleteWork($studentIdForAddWork);
							}
							
							if ( isset( $_POST['addWork'] ) ){
								echo ($_POST['addWork']);
										$studentIdForAddWork = $_POST['addWork'];
										
										addWork($studentIdForAddWork);
							}
							
									
							
							
							?>
						</tr>
						</table>
					<!-- возвращаемся обратно в admin_list_group_raiting с имзиенениями-->
					<p> <?php /*
							switch ($_SESSION['usertype_id']){
								case 1:
				
						echo ("<input class=\"button_green\" type=\"submit\" style=\"width:150px;\"  value=\"Редактировать\" onClick=\"location.href='edit_task.php?id=".$id_subject."'\">");	
						
						break;
						case 2:
						echo ("<input class=\"button_green\" type=\"submit\" style=\"width:150px;\"  value=\"Редактировать\" onClick=\"location.href='edit_task.php?id=".$id_subject."'\">");	
						break;
						break;
						}*/
						?>													
					
					</form>
		</div>
		</div>
	<div id="footer">Copyright © 1999 – 2015 Институт математики и компьютерных наук.<br> Дальневосточный Федеральный Университет
		</div>
</body>
</html>