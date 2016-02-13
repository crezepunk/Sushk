<?php
session_start();
$login = $_POST["login"];
$pass = $_POST["pass"];
$email = $_POST["email"];
$usertype = $_POST["nametype"];					
				
						
								$success = mysql_query("INSERT INTO `users` (`login`, pass`) VALUES ('$login', '$pass') ");
					
?>