<?php
include("/serverforadmin/connectMysql.php");

?>
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
			<h1>Мастер классы по программированию</h1>
		</div>
		
			 <h1>Добавление задания</h1>
			 	<div id="main">
				 <div id="aside">
					 <div id="nav">
						 <ul class="aside-menu">
							<li class="active">Организационная информация</li>
							<li><a href="/donec/">Подать заявку</a></li>
							<li><a href="/vestibulum/">Учебная часть</a></li>
							<li><a href="/">Просмотреть рейтинг</li>
							<li><a href="/vestibulum/">Посещаемость</a></li>
						 </ul>
					 </div>
					
		         </div>	
		     <div id="content">
			 <!-- Форма добавления занятия-->
				<div id="add_task" >			
				<form class="form-horizontal" method="post" action="">
				
					<input type="text" name="subject" autocomplete="off" class="placeholder" placeholder="Тема занятий"/>	
					
					<input type="text" style="width:57px" name="weigth" autocomplete="off" class="placeholder" placeholder="Дата"/><br/>
					
					<textarea class="textarea_add_task" autocomplete="off" rows="10" cols="70" style="resize:none" placeholder="Здесь записывается и редактируется сам текст занятия"></textarea><br/>
					
					<input type="text" name="name" class="placeholder" autocomplete="off" placeholder="Название задания"/>	
					
					<input type="text" style="width:57px" autocomplete="off" name="weight" class="placeholder" placeholder="Вес"/>
		
					<textarea rows="5" autocomplete="off" class="textarea_add_task" style="resize:none" name="description" placeholder="Описание задания"></textarea>
							<input type="image" src="images/delete.png"><br>
							<input type="image" src="images/add.png" style="margin-left: 45%;margin-top:10px"><br>
							
					<input class="button_green" name="add" type="submit" style="width:150px" value="Принять"/>
					
					<input class="button_red" type="reset" style="width:150px;float:right;" value="Отменить"/>
					
					<input type="hidden" name="action" value="reg" />
					
				</form>
				<?php
				if (isset($_POST["add"])){
					$sql = mysql_query("INSERT INTO `tasks` (`name`, `weigth`, `days`, `description`) VALUES ('".$_POST['name']."','".$_POST['weigth']."','".$_POST['days']."','".$_POST['description']."')");
					
					   if ($sql) {
						echo "  <script>alert( 'Привет, Мир!' );</script>";
						unset($_POST);
						} else {
						echo "<p>Произошла ошибка.</p>";
						}
				}
				?>
				
		</div>
			</div>
		</div>
	<div id="footer">Подвал
	</div>
	</div>
</body>
</html>