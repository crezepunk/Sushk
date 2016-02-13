<?php
session_start();
include("/serverforadmin/connectMysql.php");
include("/serverforadmin/function.php");
mysql_query("SET NAMES 'utf8'");
?>

<html>
<title>Adminochka</title>
<head>
<link href="css/customstyle.css" rel="stylesheet">
<link href="css/reset.css" rel="stylesheet">
</head>
<body>
        <div class="wrap">
            <table class="main_table">
            <tbody>
			<tr>
                    <td class="top" colspan="3">Добро пожаловать, <?php 
					echo ($_SESSION['name']);
					?></td>
                </tr>
                <tr>
                    <td class="left">
					<ul class="menu">
						<li><a href="main.php">Главная</a></li>
						<li><a href="anketa.php">Заявки</a></li>
						<li><a href="allusers.php">Пользователи</a></li>
						<li><a href="">Управление группами </a></li></ul></td>
                    <td class="center" colspan="2">
                        <div style = "text-align: center;">
						<h1>Все заявки</h1>
							<table border="1" style="margin: 0 auto;" width="50%">
							<tr>
								<td border="2">Фамилия Имя Отчество	
								</td>
								<td border="2">Класс
								</td>
								<td border="2">Електронный адрес
								</td>
								<td border="2">Телефон
								</td>
								<td border="2">Школа
								</td>
								<td border="2">active
								</td>
								<td border="2">Удалить
								</td>
								<td border="2">Перевести
								</td>
							</tr>
							<?php
							$result_set = mysql_query("SELECT * FROM students WHERE `active` = '0' ");
							while ($result = mysql_fetch_array($result_set)) {
								echo "<tr><form method=\"POST\">";
								echo "<td>".$result["fio"]."</td>";
								echo   "<td>".$result["grade"]."</td>";
								echo   "<td>".$result["email"]."</td>";
								echo   "<td>".$result["phone"]."</td>";
								echo   "<td>".$result["school_id"]."</td>";
								echo   "<td>".$result["active"]."</td>";
								echo "<td><input type=\"submit\" method=\"post\" name=\"del\" value= ".$result["id"]." /></td></form>";
								
								echo "<td><form class=\"form-horizontal\" method=\"post\" >";
								echo "<select name=\"groups_id\" size=\"1\">";
								//через селект вытаскиваем названия группы используя айдишник, а так же фильтруем,
								//тоесть выводим только не закрытые группы со значением ноль.
										$groups_id = mysql_query("SELECT * FROM groups WHERE `closed` = '0' ");
											while ($group = mysql_fetch_array($groups_id)) {
												echo "<option select value =".$group["id"].">".$group['name']."";
												
												 
												}
								
								echo "</select></td>";
								
								echo "<td><input class=\"button_green\" name=\"action\" type=\"submit\" style=\"width:auto\" value=".$result["id"]." /></form></td>";
								
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
									$delete = mysql_query ("DELETE FROM `students` WHERE `id` = ".$_POST["del"]);
								}
								
							?>
						</div>
						
                        
                    </td>                
                </tr>
                <tr>
                    <td class="bottom" colspan="3">©any</td>
                </tr>
            </tbody></table>
        </div>
</body>

</html>