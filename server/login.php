<?php
session_start();

	$server = "localhost";
	$user = "dariasushkova";
	$passer = "minifun19942307";
	$db = "youngstersdb";
	
	mysql_connect($server,$user,$passer) or die("всё пипец");
	mysql_select_db($db) or die("не пашет база");
$login = $_POST['login'];
$pass = $_POST['pass'];

$query = mysql_query("SELECT * FROM users WHERE login='$login'");

$user_data = mysql_fetch_array($query);

switch ($user_data['usertype_id']){
	case 1:
		if ($user_data['pass'] == $pass){
			$chek = true;
			$_SESSION['login']=$login;
			$_SESSION['usertype_id'] = $user_data['usertype_id'];
			echo "<li><a href=\"..\index.php\">ВЫ АДМИН</a></li>";
			
		}
		else{
			echo ("неверный пароль");
		}
	break;
	case 2:
			if ($user_data['pass'] == $pass){
			$chek = true;
			$_SESSION['login']=$login;
			$_SESSION['usertype_id'] = $user_data['usertype_id'];
			echo "<li><a href=\"..\index.php\">ВЫ УЧИТЕЛЬ</a></li>";
		}
		else{
			echo ("неверный пароль");
		}
	break;
	case 3:
				if ($user_data['pass'] == $pass){
			$chek = true;
			$_SESSION['login']=$login;
			$_SESSION['usertype_id'] = $user_data['usertype_id'];
			echo "<li><a href=\"..\index.php\">ВЫ СТУДЕНТ</a></li>";
		}
		else{
			echo ("неверный пароль");
		}
		
	break;
	default:
	echo "Войти в систему может только администратор или преподаватель!";
	echo "<li><a href=\"..\index.php\">Назад</a></li>";
	break;
	}




?>