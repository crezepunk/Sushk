<?php
	
	/*function getAllUsers(){
	include("/serverforadmin/connectMysql.php");
	$result_set = mysql_query("SELECT name FROM users");
	return $result_set;
	}*/
	
	//функция для закрытии группы 

	function closeGroup(){
	$now=date("Y-m-d H:i:s");
						$groups_id = $_POST['groups_id'];
						
						$sql = mysql_query("UPDATE `groups` SET `enddate` = '$now'  ,`closed` = '1' WHERE `id` = '$groups_id'");
						echo mysql_error();
	}
	
	function action($idishnikGroup,$idishnikStudent){
		echo $idishnikGroup;
		echo $idishnikStudent;
		$now=date("Y-m-d H:i:s");
		$active = 1;
		$up = mysql_query("UPDATE `students` SET `active`='$active' WHERE `id`='$idishnikStudent'");
		echo mysql_error();
		$sql2 = mysql_query("INSERT INTO `students_groups` (`student_id`, `group_id` , `startdate` ) VALUES ('$idishnikStudent', '$idishnikGroup', '$now') ");
		echo mysql_error();
		}
		
?>