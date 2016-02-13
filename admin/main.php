<?php
session_start();
include("/serverforadmin/connectMysql.php");
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
						<li><a href="main.php">Главная</a></li>
						<li><a href="anketa.php">Заявки</a></li>
						<li><a href="allusers.php">Пользователи</a></li>
						<li><a href="addGroup.php">Управление группами </a></li></ul></td>
                    <td class="center" colspan="2">
                        <div></div>
                        
                    </td>                
                </tr>
                <tr>
                    <td class="bottom" colspan="3">©any</td>
                </tr>
            </tbody></table>
        </div>
</body>

</html>