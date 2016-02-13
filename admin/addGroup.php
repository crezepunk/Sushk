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
                <td class="top" colspan="3">Добро пожаловать, <?php echo ($_SESSION['name']);?></td>    
            </tr>
                <tr>
                    <td class="left">
					<ul class="menu">
						<li><a href="main.php">Главная</a></li>
						<li><a href="anketa.php">Заявки</a></li>
						<li><a href="allusers.php">Пользователи</a></li>
						<li><a href="">Управление группами </a></li></ul>
					</td>
					<td class="center" colspan="2">
                  
						<h1>Создать группу</h1>
						<form name="addgroup" method="post" action="" >
					<tr>
						<td>
							<p>name<br/>
							<input type="text" autocomplete="off" name="name"/></p>
						</td>	
						
						<td>
							<p>Преподаватель<br/>
							<select name="teacher_id" size="1">
									<?php
									//через селект вытаскиваем тип по айди
										$teachers_id = mysql_query("SELECT * FROM teachers ");
										while ($result = mysql_fetch_array($teachers_id)) {
											echo "<option select value =".$result["id"].">".$result['fio']."";	
										}
									?>
							</select>
						</td>	
						
						<td>
							<p>Тип группы<br/>
							<select name="grouptypes_id" size="1">
									<?php
									//через селект вытаскиваем тип по айди
										$grouptypes_id = mysql_query("SELECT * FROM grouptypes ");
										while ($result = mysql_fetch_array($grouptypes_id)) {
											echo "<option select value =".$result["id"].">".$result['type']."";	
										}
									?>
							</select>
						</td>
							
						
						<td>
							<input type="submit" name="adduser" value="Добавить" />
							<?php
							//оставил adduser просто из-за того что прост всё не ложилось
							if (isset($_POST["adduser"])){
					
								$name = $_POST['name'];
								$teacher_id = $_POST['teacher_id'];
								$grouptypes_id = $_POST['grouptypes_id'];
								$now=date("Y-m-d H:i:s");
								echo $now;
								$sql = mysql_query("INSERT INTO `groups` (`name`, `teacher_id` , `startdate` ,	`grouptype_id`) VALUES ('$name', '$teacher_id', '$now', '$grouptypes_id') ");
								echo mysql_error();
							}
							
								
							
						?>
						</td>
							
						
							
					</tr>
					</form>
					<tr>
					<td>
					<form class="form-horizontal" method="post" action="">
						<p>закрыть группу<br/>
						<select name="groups_id" size="1">
						<?php
						//через селект вытаскиваем названия группы используя айдишник, а так же фильтруем,
						//тоесть выводим только не закрытые группы со значением ноль.
							$groups_id = mysql_query("SELECT * FROM groups WHERE `closed` = '0' ");
								while ($result = mysql_fetch_array($groups_id)) {
									echo "<option select value =".$result["id"].">".$result['name']."";	
									}
						?>
						</select>
						<input class="button_green" name="action" type="submit" style="width:200px" value="закрыть"/>
					</form>
					<?php
					if ( isset( $_POST['action'] ) ){
						closeGroup();
					}
					?>
					</td>
					</tr>
					</div>	
					</td>	
				</tr>		              
				
                <tr>
                    <td class="bottom" colspan="3">©any</td>
                </tr>
            </tbody>
			</table>
        </div>
</body>

</html>