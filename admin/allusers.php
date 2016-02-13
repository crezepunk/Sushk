<?php
session_start();
include("/serverforadmin/connectMysql.php");
?>


<html><head>
<style type = "text/css">

#parent_div {
  background: black; 
  height: 100%;
  opacity: 0.75;
  position: fixed;
  width: 100%;
  z-index: 100;
  top: 0;
  left: 0;
}
#div {
  background: white;
  padding: 10px;  
  height: 30px;
  position: fixed;
  top: 30%;
  left: 35%;
  color: black;
  width: 400px;
}
a#close {
  color: gray;
  font-weight: bold;
  text-decoration: underline;
  cursor: pointer;
}
</style>
<title>Adminochka</title>

<link href="css/customstyle.css" rel="stylesheet">
<link href="css/reset.css" rel="stylesheet">
</head>
<body>
        <div class="wrap">
            <table class="main_table">
            <tbody>
			<tr>
                    <td class="top" colspan="3">Добро пожаловать к своим подданным, <?php 
					echo ($_SESSION['name']);
					?><img src="img/1.jpg"></td> 
                </tr>
                <tr>
                    <td class="left">
					<ul class="menu">
						<li><a href="main.php">Главная</a></li>
						<li><a href="anketa.php">Заявки</a></li>
						<li><a href="allusers.php">Пользователи</a></li>
						<li><a href="addGroup.php">Управление группами </a></li></ul></td>
                    <td class="center" colspan="2">
						<hr>
						<!-- выводим всех пользователей-->
						<div style = "text-align: center;">
							<h1>Все пользователи</h1>
							<table border="1" style="margin: 0 auto;" width="50%">
							<tr>
								<td border="2">name	
								</td>
								<td border="2">пароль
								</td>
								<td border="2">електронный адрес
								</td>
								<td border="2">Категория
								</td>
								<td border="2">удалить
								</td>
							</tr>
							<?php
							$result_set = mysql_query("SELECT users.id, users.name, users.pass, users.email, users.usertype_id, usertypes.type as typecategory FROM users  JOIN usertypes ON (usertypes.id=users.usertype_id)");
							while ($result = mysql_fetch_array($result_set)) {
								echo "<tr><form method=\"POST\">";
								echo "<td>".$result["name"]."</td>";
								echo   "<td>".$result["pass"]."</td>";
								echo   "<td>".$result["email"]."</td>";
								echo   "<td>".$result["typecategory"]."</td>";
								echo "<td><input type=\"submit\" method=\"post\" name=\"del\" value= ".$result["id"]." /></td> ";
								
							echo "</tr> </form>";
							}
							?>
							<?php
							if( isset( $_POST['del'] ) )
								{
									echo $_POST['del'];
									//$id = $result["id"];
									
									$delete = mysql_query ("DELETE FROM `users` WHERE `id` = ".$_POST["del"]);
									echo 'Кнопка нажата!';
								}
							?>
							</table>
                        
						</div>
						<hr>
						// Меню Добавление нового пользователя.
						<table border="1" style="margin: 0 auto;" width="50%">
						<div style = "text-align: center;">
						Добавте нового пользователя
						<form name="adduser" method="post" action="" >
						<tr>
						<td>
							<p>name<br/>
							<input type="text" autocomplete="off" name="name"/></p>
						</td>	
						
						<td>
							<p>lastname<br/>
							<input type="text" autocomplete="off" name="lastname"/></p>
						</td>	
						
						<td>
							<p>Pass<br/>
							<input type="password" autocomplete="off" name="pass"/>
							</p></td>
						<td>
							<p>E-mail<br/>
							<input type="text" autocomplete="off" name="email"/>
							</p>
						</td>
							
						<td>
							
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
							
						</td>
						
						<td>
							<input type="submit" name="adduser" value="adduser" />
							<?php
							if (isset($_POST["adduser"])){
								
								//$success = adduser($_POST["login"], $_POST["pass"], $_POST["email"],$_POST["nametype"]);
								//echo "вящарыщуаощшуфыао";
								$name = $_POST['name'];
								$lastname = $_POST['lastname'];
								$login = $name." ".$lastname;
								echo ($login);
								$pass = $_POST['pass'];
								$email = $_POST['email'];
								$usertypeList = $_POST['usertypeList'];
								$sql = mysql_query("INSERT INTO `users` (`name`, `pass` , `email` ,	`usertype_id`) VALUES ('$login', '$pass', '$email', '$usertypeList') ");
								echo mysql_error();
								//Вызываем окно с затенённым фоном, для того чтобы пользователь нажал на 
								echo "<div id = \"parent_div\">
										  <div id = \"div\">
											<p>Вы успешно добавили нового пользователя</p>
											<a href=\"main.php\">Перейти</a>
										  </div>
										</div>";
							}
							
								
							
						?>
						</td>
						</form>

						<tr>
						<td>
						<a href="add_task.php">ТЕСТ!</a>
						</td>
						</tr>
						</tr>
						
						</div>
						</table>
						              
				</tr>
                <tr>
                    <td class="bottom" colspan="3">©any</td>
                </tr>
            </tbody></table>
        </div>
</body>

</html>