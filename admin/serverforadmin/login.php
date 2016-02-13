<?php
session_start();
	$login = $_POST['login'];
	$pass = $_POST['pass'];

		$server = "localhost";
	$user = "dariasushkova";
	$passer = "minifun19942307";
	$db = "youngstersdb";
	
	mysql_connect($server,$user,$passer) or die("всЄ пипец");
	mysql_select_db($db) or die("не пашет база");

	$query = mysql_query("SELECT * FROM users WHERE login='$login'");
	$user_data = mysql_fetch_array($query);


	if ($user_data['pass'] == $pass){
		$chek = true;
		$_SESSION['login']=$login;
		echo "<li><a href=\"..\main.php\">ура! наш повилитель тут! “ыкни в мен€</a></li>";
		
	}
	else{
		echo ("неверный пароль");
	}
?>


			