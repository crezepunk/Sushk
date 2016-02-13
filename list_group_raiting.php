<?php
error_reporting(E_ERROR);
session_start();
include("/server/connectMysql.php");
include("/server/function.php");
mysql_query("SET NAMES 'utf8'");
$group_id = $_GET["id"];
		$sql = "SELECT students_groups.student_id ,students_groups.group_id, students.fio as namestudent , teachers.id as teach_id, teachers.fio as teachfio, groups.name as namegroup, subjects.id as id_subject FROM students_groups 
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
<title>Система контроля успеваемости</title>are</title>
	<link rel="stylesheet" href="css/styles.css" type="text/css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,300" type="text/css">
	<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
	<script type="text/javascript" src="/js/jquery.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<!--[if lt IE 9]><script type="text/javascript" src="/js/jquery.js"></script>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

<script type="text/javascript">
function openbox(id){
 display = document.getElementById(id).style.display;
 if(display=='none'){
    document.getElementById(id).style.display='block';
  }else{
    document.getElementById(id).style.display='none';
  }

}

</script>


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
		
			 <h1>Рейтинг группы "<?php echo $result["namegroup"];  ?>"</h1> <!-- БЕРЕМ ИЗ БАЗЫ-->
		
		<div id="content">
			<div id="view_task">	
						<p> Преподаватель:  <?php echo $result["teachfio"]; 
							switch ($_SESSION['usertype_id']){
								case 1:
				
						echo ("<input class=\"button_green\" onclick=\"openbox('box'); return false\" type=\"submit\" style=\"width:100px\" value=\"Сменить\">");
						echo ("<form id=\"box\"  name=\"action\" method=\"post\" action=\"\" style=\"display: none\" >Сменить текущего преподавателя на<select name=\"prep_id\"> ");
						$prep = mysql_query("SELECT * FROM teachers ");
										while ($res_prep = mysql_fetch_array($prep)) {
											echo "<option  select value =".$res_prep["id"].">".$res_prep['fio']."";	
										$prep_id = $res_prep['id'];
										//echo $prep_id;
										
										}
						echo ("</select><input class=\"button_green\" name=\"action\" type=\"submit\" value=\"Окей\"></form>");
			
						if ( isset ($_POST['action']) ){
							
								prep_update();
							}
				

						echo ("<input class=\"button_red\" type=\"submit\" style=\"width:200px;float:right\"  value=\"Добавить новое занятие\" onClick=\"location.href='prep_add_task.php?id=".$group_id."'\">");	
						//echo ("<input class=\"button_green\" type=\"submit\" style=\"width:200px;float:right\"  value=\"Переместить группу\" onClick=\"location.href='perem_stud.php?id=".$group_id."'\">");	
						//echo ("<input class=\"button_green\" type=\"submit\" style=\"width:200px;float:right\"  value=\"Рассылка\" onClick=\"location.href='send_mail_all.php?id=".$group_id."'\">");	
					
						echo ("<form name=\"closeGroup\" method=\"post\" action=\"\"><input name=\"closeGroup\" class=\"button_green\" type=\"submit\" style=\"width:200px;float:right\"  value=\"Закрыть группу\" ></form>");	
						if ( isset ($_POST['closeGroup']) ){
							$now=date("Y-m-d H:i:s");
						$groups_id = $_GET['id'];
						
						$sql = mysql_query("UPDATE `groups` SET `enddate` = '$now'  ,`closed` = '1' WHERE `id` = '$groups_id'");
						echo mysql_error();
						echo "<div id = \"parent_div\">
										  <div id = \"div\">
											<p>Вы закрыли группу</p>
											<a href=\"list_group.php\">Я очень рад этому</a>
											<p>..</p>
											
										  </div>
										</div>";
						
						
							}
						break;
						case 2:
						echo ("<input class=\"button_red\" type=\"submit\" style=\"width:200px;float:right\"  value=\"Добавить новое занятие\" onClick=\"location.href='prep_add_task.php?id=".$group_id."'\">");	
						break;
						break;
						}
					
					
						?></p>
						
					<form class="form-horizontal" method="post" action="">	
			<div class="scrolling">						
				<table id="admin_table_list_group" border="2px" class="table table-striped table-bordered table-hover table-layout:fixed">

					<tr>
						<td rowspan="1" overflow=hidden white-space=nowrap>ФИО
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
								$resultdate = $result3["date"]; 
								list($yaer, $mounth, $day) = explode("-", $resultdate); 
								echo "<td><a href=\"view_task.php?subject_id=".$result3["id"]."&group_id=".$group_id."\">".$day."-".$mounth."</a>";
								
							}
							
						?>
										<col width="250px">
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
							$IdishnikStudenta = $result["IdishnikStudenta"];
							switch ($_SESSION['usertype_id']){
							case 1:
							echo  "<td><a href=\"stud_card.php?id=".$IdishnikStudenta."\">".$result["namestudent"]."</a></td>";
							break;
							default:
							echo  "<td>".$result["namestudent"]."</td>";
							break;
							}
							//echo "".$IdishnikStudenta.;
							foreach ($SubjectsArray as $subject){
								echo "<td>";
								
								$sql33 = mysql_query("SELECT * FROM tasks 
										LEFT JOIN tasks_students ON(tasks_students.task_id=tasks.task_id)
												WHERE (tasks.subject_id = $subject) AND (tasks_students.student_id = ".$result["student_id"]." ) ");
								echo mysql_error();	
								if (mysql_num_rows($sql33) > 0 ){
										while ($resultView = mysql_fetch_array($sql33)){
										echo "<div>";
										echo $resultView['mark'];
										echo "</div>";
										}
								
								}
								else{
									echo "<div > </div>";
								
									if ( isset( $_POST['ball'] ) ){
										balls();
									}
								}
								
								echo "</td>";
						}
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
					</form>
					<input class="button_green" style="width:100px" type="button" value="Назад" onclick="history.back()">
				</div>
			</div>
		
			<div id="footer">Copyright © 1999 – 2015 Институт математики и компьютерных наук.<br> Дальневосточный Федеральный Университет
			</div>
		
		</div>
	</div>
</body>
</html>