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
				$sql .= " WHERE subjects.id= $subject_id and tasks.subject_id=$subject_id";
			}
			$result_set = mysql_query($sql);
			$result = mysql_fetch_array($result_set);
					
		

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
		
				
		     <div id="content">
			  <h1>Редактирование занятия</h1>
			 <!-- Форма группы-->
				<div id="view_task">
					<a onclick="$('#name').slideToggle('slow');" href="javascript://">Свернуть/Развернуть занятие</a>				
				<form class="form-horizontal" name="upSubject" method="post" action="">
					
					<div  id="name" class="NavFrame">
						<?php 
						$result_set = mysql_query($sql);

						echo "<textarea name=\"name\" style=\"width:74%;background-color:white;display:inline-block;height:30px;padding:4px;resize:none\">" .$result["name"]."</textarea>";
						echo "<input name=\"days\"  style=\"width:14%;background-color:white;display:inline-block;margin-left:2%;padding:4px\"; type=\"date\";  value=".$result["days"].">";	
						echo "<textarea name=\"description\" style=\"width:90%;background-color:#FDF5E6;min-height:70px;resize:none\">" .$result["description"]."</textarea>";
							
							while ($result = mysql_fetch_array($result_set)){
								echo "<hr>";
								echo "<textarea name=\"task_name\" style=\"width:74%;background-color:white;display:inline-block;height:30px;padding:4px;resize:none\">" .$result["task_name"]."</textarea>";
						
								echo "<textarea name=\"task_weight\" style=\"width:10%; background-color:#FDF5E6; margin-top:1%; height:30px; margin-left:2%; min-height:10px;resize:none\">".$result["task_weight"]."</textarea>";
								echo "<textarea name=\"task_description\" style=\"width:90%;background-color:#FDF5E6;margin-top:1%;height:auto;min-height:50px;resize:none\">".$result["task_description"]."</textarea>";	
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
							<?php
								$podchetZadani = 1;
								foreach($TasksIdArray as $tasksId){
									echo "<td style=\"width:15px\"><label>".$podchetZadani."</label><br></td>";
									$podchetZadani++;
								}
							?>
						</tr>
						<?php 
					// список айди заданий для получения списка отметок за задания
					
						$sql2 = "SELECT students_groups.student_id ,students_groups.group_id, students.fio as namestudent , groups.name as namegroup FROM students_groups 
														JOIN groups ON (groups.id=students_groups.group_id)
														JOIN students ON (students.id=students_groups.student_id)";	
										
							if ($group_id){
								$sql2 .= " WHERE students_groups.group_id = $group_id";
							}
							
							$result_set2 = mysql_query($sql2);
							
							while ($result2 = mysql_fetch_array($result_set2)) {
								echo "<tr><form method=\"POST\">";
								$student_idForWork =  $result2["student_id"];
								
								echo   "<td>".$result2["namestudent"]."</td>";
								$subject_idddddd;
								echo mysql_error();	
								$sql10 = mysql_query("SELECT * FROM subjects_students WHERE student_id = $student_idForWork AND subject_id = $subject_idddddd");
								//echo mysql_error();	
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
							
								foreach ($TasksIdArray as $tasksId){
									$student_idForWork ;
										echo   "<td><form id=\"".$tasksId."\" method=\"post\" action=\"\" ><div><select name=\"selectttt\" size=\"1\" onchange=\"this.form.submit()\">";	
										//определяем количество опшинов для селекта, то есть бал от 1 до максимального указанного в бд
										$sql102 = mysql_query("SELECT * FROM tasks  WHERE task_id = $tasksId");
										$result239238 = mysql_fetch_array($sql102);
										$taskWeight = $result239238['task_weight'];
										$sqlZaprosFigZnaetKakoyPoChety = mysql_query("SELECT * FROM tasks_students  WHERE student_id = $student_idForWork AND task_id = $tasksId");
										$resultMarkForOptionSelect = mysql_fetch_array($sqlZaprosFigZnaetKakoyPoChety);
										$taskMarkForOptionSelect = $resultMarkForOptionSelect['mark'];
										
										for ($i = 0; $i <= $taskWeight; $i++){
											if ($i != $taskMarkForOptionSelect){
												echo "<option value =\" ".$i.":".$tasksId.":".$student_idForWork."\">".$i."</option>";
											}
											else{
												echo "<option selected=\"selected\" value =\" ".$i.":".$tasksId.":".$student_idForWork."\">".$i."</option>";
											}
			
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
					</table>	
							
					<!-- возвращаемся обратно в admin_list_group_raiting с имзиенениями-->
					<input class="button_red" type="submit" style="width:150px" name="upSubject" value="Сохранить изменения" >
				
					
				</form>
				<input class="button_green" style="width:100px" type="button" value="Назад" onclick="history.back()">
				<?php
						$subject_id = $_GET["subject_id"];
							$group_id = $_GET["id"];
							if ( isset ($_POST['upSubject']) ){
								upSubject($subject_id);
							}
						?>
		</div>
		</div>
	<div id="footer">Copyright © 1999 – 2015 Институт математики и компьютерных наук.<br> Дальневосточный Федеральный Университет
		</div>
</body>
</html>