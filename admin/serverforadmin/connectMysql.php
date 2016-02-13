<?
	$server = "localhost";
	$user = "dariasushkova";
	$passer = "minifun19942307";
	$db = "youngstersdb";
	
	mysql_connect($server,$user,$passer) or die("всё пипец");
	mysql_select_db($db) or die("не пашет база");
	?>