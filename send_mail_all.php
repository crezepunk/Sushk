<?php 
error_reporting(E_ERROR);
session_start();
include("/server/connectMysql.php");
include("/server/function.php");
mysql_query("SET NAMES 'utf8'");
$group_id = $_GET["id"];
		$sql = "SELECT students_groups.student_id ,students_groups.group_id, students.email as email FROM students_groups 
									
										JOIN students ON (students.id=students_groups.student_id)";
										
			if ($group_id){
				$sql .= " WHERE students_groups.group_id= $group_id";
			}
			$result_set = mysql_query($sql);
			while($result = mysql_fetch_array($result_set)){
			echo $group_id;
			echo $result["email"];
			}
			?>


<!doctype html>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<title>Добавить задание</title>
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
					<li><?php if (isset($_SESSION['login'])):?> <p>Здравствуйте, <?=$_SESSION['login']?><br>
					<a href="admin_panel.php"  >Панель</a>
					<a href="clear.php"  >Выйти</a>
					
					<?php endif; ?></li>
		
				</ul>
			</nav>
		</div>
			
	 <div id="content">
	 <h1>Отправка уведомления</h1>
		
		<div id="form_send">
					<div>Группе "Высшая ступень 2016"</div> <!-- Берем из базы-->
		<form name="send_mail" class="form-horizontal" method="post" action="">
		<input type="text" name="subject" style="width:500px" class="placeholder" placeholder="Заголовок"/><br/>
		<textarea name="body" rows="5" style="resize:none" ></textarea><br/>
		<input name="send_mail" class="button_green" style="width:300px;margin-left:20%" type="submit" value="Отправить уведомление группе"/>
		
	</form>
	<?
				if ( isset ($_POST['send_mail']) ){

							error_reporting(0);
							
							$subject = $_POST["subject"];
							$body = $HTTP_POST_VARS["body"];
							$subject = stripslashes($subject);
							$body = stripslashes($body);

							//$file = "maillist.txt";
							//$maillist = file($file);

							while($result = mysql_fetch_array($result_set)){
							$mail = $result["email"];
							#echo($maillist[$i]."<br>");
							mail($mail, $subject,
							$body);
							}
							echo "Готово!";
							echo $subject;
							echo $body;
							echo $mail;
							
				}
							?>
	</div>
	</div>
	
	
		
	<div id="footer">Copyright © 1999 – 2015 Институт математики и компьютерных наук.<br> Дальневосточный Федеральный Университет
		</div>
	</div>
</body>
</html>