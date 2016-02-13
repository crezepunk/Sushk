<?php
error_reporting(E_ERROR);
session_start();
include("/server/connectMysql.php");
//include("/admin/serverforadmin/function.php");
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


	<link rel="stylesheet" type="text/css" href="css/style1.css" />
	<script language="javascript" type="text/javascript" src="js/jquery.js"></script>
	<script language="javascript" type="text/javascript" src="js/jquery.easing.js"></script>
	<script language="javascript" type="text/javascript" src="js/script.js"></script>
<style type = "text/css">


</style>	
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
					<li><a href="list_group.php" ><div>Учебная часть</div></a>
				
					</li>
					<li><a href="anketa.php"><div>Анкета</div></a></li>
					<li><?php if (empty($_SESSION['login'])): ?> <a href="admin/index.php"><div>Войти</div></a></li>
					<li><?php elseif (isset($_SESSION['login'])): ?> <p>Здравствуйте, <?=$_SESSION['login']?><br>
					<a href="admin_panel.php"  >Панель</a>
					<a href="clear.php"  >Выйти</a>
					
					<?php endif; ?></li>
					
					<?/*php
					switch ($_SESSION['usertype_id']){
						case 2:
							echo ("вы учитель!!! ");
							echo ($_SESSION['usertype_id']);
							echo ("<input class=\"button_green\" type=\"submit\" style=\"width:200px\" value=\"Создать группу\"/");
							break;
					}*/
					?>
				</ul>
			</nav>
		</div>
		
		<div id="main">
		<h1>Панель администратора</h1>
		    <div id="content">
			<div id="admin_zayavki">
			<h3>Заявки на обучение</h3>
			<table class="table table-striped table-bordered table-hover"  style="margin: 0 auto;" width="50%">
				<tr>
				<th>ФИО</th>
				<th>Школа</th>
				<th>Класс</th>
	
				<!--<th>Почта</th>
				<th>Телефон</th>
				
				<th>Статус</th>-->
				<th>Удалить</th>
				<th>Определить в группу</th>
				</tr>
							<?php
							
							$result_set = mysql_query("SELECT * FROM students WHERE `active` = '0' ");
							
								
							while ($result = mysql_fetch_array($result_set)) {
								
								$school_id = $result["school_id"];
								$name_school = mysql_query("SELECT name FROM schools WHERE `id`= '$school_id'");
								$ns = mysql_fetch_array($name_school);

								$idishnikStudent =$result['id'];
								echo "<td>".$idishnikStudent."</td>";
								echo "<tr><form method=\"POST\">";
								echo "<td>".$result["fio"]."</td>";
							
								echo   "<td>".$ns["name"]."</td>";
								echo   "<td>".$result["grade"]."</td>";
								//echo   "<td>".$result["email"]."</td>";
								//echo   "<td>".$result["phone"]."</td>";
								
								//echo   "<td>".$result["active"]."</td>";
								echo "<td><input  type=\"submit\" method=\"post\" name=\"del\" value= \"удалить\" /></td></form>";
								
								echo "<td><form class=\"form-horizontal\" method=\"post\" >";
								echo "<select name=\"groups_id\" size=\"1\">";
								//через селект вытаскиваем названия группы используя айдишник, а так же фильтруем,
								//тоесть выводим только не закрытые группы со значением ноль.
										$groups_id = mysql_query("SELECT * FROM groups WHERE `closed` = '0' ");
											while ($group = mysql_fetch_array($groups_id)) {
												echo "<option select value =".$group["id"].">".$group['name']."";
												}
								
								echo "</select>";
								
								echo "<input class=\"button_green\" name=\"action\" type=\"submit\" style=\"width:auto\" value=".$result["id"]." /></form></td>";
									
								echo "</tr>";
							}
							?>
							
							</table>
									<?php
							
							if( isset( $_POST['action'] ) ){
								$idishnikGroup = $_POST['groups_id'];
								$idishnikStudent = $_POST['action'];
								action($idishnikGroup,$idishnikStudent);
							}	
							if( isset( $_POST['del'] ) )
								{
									//$id = $result["id"];
									$delete = mysql_query ("DELETE FROM `students` WHERE `id` = $idishnikStudent");
								}
								
							?>
						</div>
						<div id="addUser" >
						<h3>Добавление пользователя</h3>
					<form  name="adduser" method="post" action="" >
						<table class="table table-striped table-bordered table-hover">
						<tr>
							<tr><td>
							<p>fio
							<input style="width:150px" type="text" autocomplete="off" name="name"/>
							</td></tr>
						
						<tr><td>
							login
							<input style="width:150px" type="text" autocomplete="off" name="login"/>
						</td></tr>	
						
						<tr><td>
							Pass
							<input style="width:150px" type="password" autocomplete="off" name="pass"/>
							
						</td></tr>
						<tr><td>
							E-mail
							<input style="width:150px" type="text" autocomplete="off" name="email"/>
							
						</td></tr><tr><td>
						Телефон
							<input style="width:150px" type="text" autocomplete="off" name="phone"/>
							
						</td></tr>
								<tr><td>
							Тип
							
								<select name="usertypeList" size="1">
									<?php
									//через селект вытаскиваем тип по айди
										$usertype_id = mysql_query("SELECT * FROM usertypes ");
										while ($result = mysql_fetch_array($usertype_id)) {
											echo "<option select value =".$result["id"].">".$result['type']."";	
										}
									?>
								</select>
							</td></tr>
						
						<td>
							<input type="submit" name="adduser" value="adduser" />
							
							<?php
							if (isset($_POST["adduser"])){
								$name = $_POST['name'];
								$login = $_POST['login'];
								$result = mysql_query("SELECT id FROM users WHERE login='$login'");
								$myrow = mysql_fetch_array($result);
										if (!empty($myrow['id'])) {	
								?>
											<script type="text/javascript">
											alert("Извините, введённый вами логин уже зарегистрирован. Введите другой логин.")
											</script>
											<?php
								exit;
									}
								//$success = adduser($_POST["login"], $_POST["pass"], $_POST["email"],$_POST["nametype"]);
								//echo "вящарыщуаощшуфыао";
								
								
								//echo ($login);
								$pass = $_POST['pass'];
								$email = $_POST['email'];
								$phone = $_POST['phone'];
								$usertypeList = $_POST['usertypeList'];
								$sql = mysql_query("INSERT INTO `users` (`login`, `pass` , `email` , `phone`,	`usertype_id`) VALUES ('$login', '$pass', '$email', '$phone','$usertypeList') ");
								//echo mysql_error();
									echo "<div id = \"parent_div\">
										  <div id = \"div\">
											<p>Вы успешно добавили нового пользователя</p>
											<a href=\"admin_panel.php\">Я очень рад этому</a>
											<p>..</p>
											
										  </div>
										</div>";
									
								};
								$user_id = mysql_query("select id from users order by id desc limit 1");
								while ($user_idd = mysql_fetch_array($user_id)){
								if ($usertypeList == 2){
								$id =  $user_idd["id"];
								$sql = mysql_query("INSERT INTO `teachers` (`fio`,  `email`, `user_id` ) VALUES ('$name', '$email', '$id') ");
								}
									 
							}
						
						?>				
						<td>
						</tr>
						</table>
						</div>
						
						</form>
						<div id="anketa">
			<h3>Добавление студента</h3>
				<form name="addCardAdmin" class="form-horizontal" method="post" action="">
					<input type="text" name="lastName" class="placeholder" placeholder="Фамилия"/><br/>
					<input type="text" name="name" class="placeholder" placeholder="Имя"/><br/>
					<input type="text" name="middleName" class="placeholder" placeholder="Отчество"/><br/>
					
					<select placeholder="Школа" name="schoolsId" size="1">
									<?php
									//через селект вытаскиваем тип по айди
										$schools_id = mysql_query("SELECT * FROM schools ");
										while ($result = mysql_fetch_array($schools_id)) {
											echo "<option select value =".$result["id"].">".$result['name']."";	
										}
									?>
					</select><br/>
					<select placeholder="Группа" name="groups" size="1">
						<?php
									//через селект вытаскиваем тип по айди
										$groups = mysql_query("SELECT * FROM groups ");
										while ($result = mysql_fetch_array($groups)) {
											echo "<option select value =".$result["id"].">".$result['name']."";	
										}
									?>
					</select><br/>
					
					<input type="text" name="grade" class="placeholder" placeholder="Класс"/><br/>
					<input type="text" name="email" class="placeholder" placeholder="Электронная почта"/><br/>
					<input type="text" name="phone" class="placeholder" placeholder="Телефон"/><br/>
					<input class="button_green" name="addCardAdmin" type="submit" style="width:200px" value="Добавить"/>
					<!--<input type="hidden" name="action" value="reg" />-->
				</form>
				<?php
				if ( isset( $_POST['addCardAdmin'] ) ){
					addCardAdmin();
				}
				?>
		</div>		
									
						</div>
						
                        
               
             
			
			
			</div>
		
				<input class="button_green" style="width:100px" type="button" value="Назад" onclick="history.back()">
			</div>	
		
		</div>
		
		<div id="footer">Copyright © 1999 – 2015 Институт математики и компьютерных наук.<br> Дальневосточный Федеральный Университет<br>
		<?php if (empty($_SESSION['name'])): ?> <a href="admin/index.php">Войти</a><?php endif; ?>				
		</div>
	</div>
</body>
</html>