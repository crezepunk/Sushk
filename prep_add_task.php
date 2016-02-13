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
		
				
		   <div id="content">
			  <h1>Добавление занятия в группе "<?php echo $result["namegroup"]; ?>"</h1>
			 <!-- Форма группы-->
				<div id="view_task">
		
				<a onclick="$('#name').slideToggle('slow');" href="javascript://">Свернуть/Развернуть занятие</a>				
				<form class="form-horizontal" method="post" action="">
					
					<div  id="name" class="NavFrame">
					

					 
					<form name="addSubject" method="post" action="" >
					
								<input type="text" style="width:74.5%" name="name" class="placeholder" placeholder="Тема занятий"/> 
								<input type="date" style="width:15%" name="days" class="form-control"/><br/> 
								<textarea name="description" class="textarea_add_task" rows="5" style="resize:none" placeholder="Здесь записывается и редактируется сам текст занятия"></textarea><br> 
								<input type="text" style="width:74.5%" name="task_name" class="placeholder" placeholder="Название задания"/> 
								<input type="text" style="width:15%" name="weight" class="placeholder" placeholder="Вес"/> 
								<textarea rows="2" name="task_description" class="textarea_add_task" style="resize:none" placeholder="Описание задания"></textarea> 
								<!--<input type="image" src="images/delete.png"><br> 
								<input type="image" src="images/add.png" name="action" style="margin-left: 45%;margin-top:10px"><br>-->
						<input class="button_green" name="addSubject" type="submit" style="width:150px" value="Принять"/>
						<input class="button_red" type="reset" style="width:150px" value="Отменить"/>
					</form>
						
					</div>
					<!--ПОСЕЩЕНИЕ -->
					<table id="table_edit" border="2px" class="table table-striped table-bordered table-hover" >
					  <tr>
					  <th>ФИО студента</th>
					  <th>Посещение</th>
					  
					<?php
							$group_id = $_GET["id"];
						
							$sql = "SELECT students_groups.student_id ,students_groups.group_id, students.fio as namestudent , groups.name as namegroup FROM students_groups 
														JOIN groups ON (groups.id=students_groups.group_id)
														JOIN students ON (students.id=students_groups.student_id)";
							if ($group_id){
								$sql .= " WHERE students_groups.group_id= $group_id";
							}
							$result_set = mysql_query($sql);
							while ($result = mysql_fetch_array($result_set)) {
								echo "<tr><form method=\"POST\">";
							
								echo   "<td>".$result["namestudent"]."</td>";
								echo   "<td><input type=\"checkbox\"></td>";
								//echo   "<td><input type=\"text\"> </td>";
								
								
								echo "</tr> </form>";
							}
						
							?>
						<?php
						
							$group_id = $_GET["id"];
							if ( isset ($_POST['addSubject']) ){
								addSubject($group_id);
							}
						?>
						</tr>
					</table>		
						</form>
<input class="button_green" style="width:100px" type="button" value="Назад" onclick="history.back()">
					</div>
				
					
							
					<!-- возвращаемся обратно в admin_list_group_raiting с имзиенениями-->
					
					
			
		</div>
		</div>
	<div id="footer">Copyright © 1999 – 2015 Институт математики и компьютерных наук.<br> Дальневосточный Федеральный Университет
		</div>
</body>
</html>