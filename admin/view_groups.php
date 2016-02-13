<?php
session_start();
include("/serverforadmin/connectMysql.php");
mysql_query("SET NAMES 'utf8'");
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
						<li><a href="view_groups.php">Просмотр ГРУПП</a></li>
						<li><a href="addGroup.php">Управление группами </a></li></ul></td>
                    <td class="center" colspan="2">
						<hr>
						<!-- выводим всех пользователей-->
						<div style = "text-align: center;">
							<h1>Список ЮД в группе</h1>
							<table border="1" style="margin: 0 auto;" width="50%">
							<tr>
								<td border="2">
								<form class="form-horizontal" method="post" action="">
						<p>закрыть группу<br/>
						<select name="groups_id" size="1" onchange="this.form.submit();">
						<option value="">все</option>
						<?php
						$group_id = $_POST["groups_id" ];
						//через селект вытаскиваем названия группы используя айдишник, а так же фильтруем,
						//тоесть выводим только не закрытые группы со значением ноль.
						
							$groups_id = mysql_query("SELECT * FROM groups WHERE `closed` = '0' ");
								while ($result = mysql_fetch_array($groups_id)) {
									echo "<option ";
									if ($group_id == $result["id"]){
										echo " selected ='selected' ";
									}
									echo " value =".$result["id"].">".$result['name']."";	
									}
						?>
						</select>
						<input class="button_green" name="action" type="submit" style="width:200px" value="закрыть"/>
					</form>
								</td>
								<td border="2">Студент
								</td>
							</tr>
							<?php
							$sql = "SELECT students_groups.student_id ,students_groups.group_id, students.fio as namestudent , groups.name as namegroup FROM students_groups 
														JOIN groups ON (groups.id=students_groups.group_id)
														JOIN students ON (students.id=students_groups.student_id)";
							if ($group_id){
								$sql .= " WHERE students_groups.group_id= $group_id";
							}
							$result_set = mysql_query($sql);
							while ($result = mysql_fetch_array($result_set)) {
								echo "<tr><form method=\"POST\">";
								echo   "<td>".$result["namegroup"]."</td>";
								echo   "<td>".$result["namestudent"]."</td>";
								echo   "<td><li><a href=\"perevod.php?id=".$result["student_id"]."\">Перевести студента в другую группу</a></li>";
							}
							//SELECT count(*)  FROM `students_groups` WHERE `group_id` = 20
							
							
							?>
							</table>
                        
						</div>
						<hr>						              
				</tr>
                <tr>
                    <td class="bottom" colspan="3">©any</td>
                </tr>
            </tbody></table>
        </div>
</body>

</html>