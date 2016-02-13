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
	<script type="text/javascript" src="/js/jquery.leanModal.min.js"></script>
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
					<li class="menu_holder"><a><div>Информация</div></a>
						<div>
							<ul>
								<li><a href="info.php">О мастер-классах</a></li>
								<li><a href="prep_list.php">Список преподавателей</a></li>
							</ul>
						</div>
					</li>
					<li ><a href="list_group.php"><div>Учебная часть</div></a></li>
					<li><a href="anketa.php"><div>Анкета</div></a></li>
					<li><?php if (empty($_SESSION['login'])): ?> <a href="admin/index.php"><div>Войти</div></a></li>
					<li><?php elseif (isset($_SESSION['login'])): ?> <p>Здравствуйте, <?=$_SESSION['login']?><br>
					<a href="admin_panel.php"  >Панель</a>
					<a href="clear.php"  >Выйти</a>
					
					<?php endif; ?></li>
				
				</ul>
			</nav>
		</div>
			 <h1>Изменение списка преподавателей</h1>
		
	
		<div id="content">
		<div id="form_group" method="post" action="/">
			<table class="table table-striped table-bordered table-hover">
			<tr>
			<th>ФИО преподавателя</th>
			<th>Электронная почта</th>
			<th>Изменение статуса</th>
			<th>Подтверждение изменений</th>
		
			
			</tr>

				<?php 
				$result_set = mysql_query("SELECT * FROM teachers ");
				
				
				while ($result = mysql_fetch_array($result_set)){
					$res = mysql_query("SELECT usertype_id FROM users WHERE usertype_id='$id_prep'");
				$id_prep = $result["id"];
				//echo "<td>".$id_prep."</td>";
				$usertype_id_prep = $res["usertype_id"];
				echo "<tr><form name=\"up_prep\" method=\"post\">";
				//echo $usertype_id;
				echo "<td>"
				//php закрываем тут, чтобы фио отображалось полностью, а не до пробелов
				?> 
				
				<input name="fio" value="<?php echo $result["fio"];?>" style="width:100%" >
				<?php
				echo "</td>";
				echo "<td><input name=\"email\" value=".$result["email"]." style=\"width:100%\" ></td>";
				//echo "<td><input  type=\"submit\" method=\"post\" name=\"del\" value=\"удалить\" /></td></form>";
				echo "<td><select name=\"usertype_id\" size=\"1\">";
								
										$usertype_id = mysql_query("SELECT * FROM usertypes ");
											while ($usertype = mysql_fetch_array($usertype_id)) {
												echo "<option select value =".$usertype["id"].">".$usertype['type']."";
												}
								
								echo "</select></td>";
				
				echo "<td><input class=\"button_green\" name=\"up_prep\" type=\"submit\" style=\"width:auto\" value=".$result["id"]." /> </form></td>";
				
								
					echo "</tr>";
					
				}
				?>
				</table>
				
				
			
			<?php
			if( isset( $_POST['up_prep'] ) ){
								$id_prep = $_POST['up_prep'];
								echo  $id_prep;
								$fio = $_POST['fio'];
								$email = $_POST['email'];
								//echo $id_prep;
								$type = $_POST["usertype_id"];
								echo $type;
					//	echo $email;
								$up = mysql_query("UPDATE `teachers` SET `fio`='$fio', `email`='$email' WHERE `id`='$id_prep'");
								$up2 = mysql_query("UPDATE `users` SET `usertype_id`='$type' WHERE `id`='$id_prep'");
	//	$delete = mysql_query ("UPDATE `users` SET `usertype_id` = '$action' WHERE `id` = $id_prep");
								echo mysql_error();
									}	
		/*if( isset( $_POST['del'] ) )
								{
								$id_prep = $_POST['up_prep'];	
								echo $id_prep;
								  echo mysql_error();
									$delete = mysql_query ("DELETE FROM `users` WHERE `id` = $id_prep");
								}*/
								?>
								 <input class="button_green" style="width:100px" type="button" value="Назад" onclick="history.back()">
					</div>
			
			</div>
		
			
			
			<div id="footer" style="margin-top:40%">Copyright © 1999 – 2015 Институт математики и компьютерных наук.<br> Дальневосточный Федеральный Университет
			</div>
		</div>
	
	
</body>
</html>