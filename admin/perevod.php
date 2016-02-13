<?php
error_reporting(E_ERROR);

session_start();
include("/serverforadmin/connectMysql.php");
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
					echo ($_SESSION['usertype_id']);
					?></td>
                </tr>
                <tr>
                    <td class="left">
					<ul class="menu">
						<li><a href="main.php">Главная</a></li><br>
						<li><a href="anketa.php">Заявки</a></li><br>
						<li><a href="view_groups.php">Перемещение</a></li><br>
						<li><a href="allusers.php">Пользователи</a></li><br>
						<li><a href="addGroup.php">Управление группами </a></li></ul></td>
                    <td class="center" colspan="2">
                        <div></div>
						
						
						<?php
							$id_student = $_GET["id"];
							
							$result_set = mysql_query("SELECT * FROM students WHERE id = $id_student");
							$result = mysql_fetch_array($result_set);
								echo "<tr>";
								echo "<td>".$result["fio"]."</td>";
								echo   "<td>".$result["grade"]."</td>";
								echo   "<td>".$result["email"]."</td>";
								echo   "<td>".$result["phone"]."</td>";
								
							$sql = mysql_query("SELECT * FROM students_groups WHERE student_id = $id_student");
							echo mysql_error();	
							$sqlResult = mysql_fetch_array($sql);
							$student_groupId = $sqlResult["group_id"];
							$sql2 = mysql_query("SELECT * FROM groups WHERE id = $student_groupId");
							$sql2Result = mysql_fetch_array($sql2);
							echo   "<td>".$sql2Result["name"]."</td>";
							echo "<td><form method=\"POST\"><select name=\"group\" size=\"1\">";
									
										$sql3 = mysql_query("SELECT * FROM groups WHERE id <> $student_groupId");
															echo mysql_error();
										while ($sql3Result = mysql_fetch_array($sql3)) {
											echo "<option select value =".$sql3Result["id"].">".$sql3Result['name']."";	
										}
									
							echo "</select></td>";
							echo "<td><input type=\"submit\" method=\"post\" name=\"perevod\" value= ".$result["id"]." /></td>";
							echo "</tr> </form>";
						
							?>
						<?php
						if ( isset( $_POST['perevod'] ) ){
							perevod($id_student);
						}
						
					function perevod($id_student){
						// ОБРАТИ СЮДА ВНИМАНИЕ!!!! если нужно обновлять дату то раскаменти и добавь это в SET `startdate` = '$now'
						//$now=date("Y-m-d H:i:s");	
						$groups_id = $_POST['group'];
						echo $groups_id;
						echo $$id_student;
						$sql = mysql_query("UPDATE `students_groups` SET  `group_id` = '$groups_id' WHERE `student_id` = '$id_student'");
						echo mysql_error();
						//header ('Location: main.php');  // перенаправление на нужную страницу
						exit();// прерываем работу скрипта, чтобы забыл о прошлом
					}
						?>
						
						
						
						
                        
                    </td>                
                </tr>
                <tr>
                    <td class="bottom" colspan="3">©any</td>
                </tr>
            </tbody></table>
        </div>
</body>

</html>