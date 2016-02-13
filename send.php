<?php
session_start();
include("/server/connectMysql.php");
include("/server/function.php");
mysql_query("SET NAMES 'utf8'");
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru">
	<head>
		<meta charset="Windows-1251" />
		<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
		<link href="/css/styles.css" rel="stylesheet" media="screen">
		<script type="text/javascript" src="/js/jquery.js"></script>
	</head>

	<body>
		<div class="container-fluid">
			<div class="page-header">
			<h1>ОТПРАВИТЬ 2015</h1>
			</div>
			<div class="row-fluid">
			    <div class="span2">
				    <h5>Здравствуйте, <a href="">Admin2</a></h5>
				    <ul class="nav nav-list">
					    <li ><a href="/">Главная страница</a></li>
					    <i class="icon-large icon-cart-in"></i>
					    <li class="nav-header">Меню</li>
					     	<ul class="nav nav-list">
				<li   ><a href="/catalog/cat/4">Профиль</a></li>
				<li ><a href="/catalog/cat/4">Группы</a></li>
					<ul class="nav nav-list">
					<li class="active"  ><a href="/catalog/cat/4">ВC 2015</a></li>
					</ul>
				<li   ><a href="/catalog/cat/5">Преподаватели</a></li>
				<li   ><a href="/catalog/cat/6">ЮД</a></li>
	
				<li><a href="/catalog/cat/7">Учебная часть</a></li>
				</ul>
				</ul>
			    </div>
				<div class="span7 offset1">
					<div>Отправить уведомление</div>
					<div>группе "Высшая ступень"</div>
  <form class="form-horizontal" method="post" action="/mail.php">
		<input type="text" name="name" class="placeholder" placeholder="Заголовок"/><br/>
		<textarea name="text" cols="40" rows="3"></textarea><br/>
		<input class="btn btn-primary" type="submit" value="Отправить уведомление группе"/>
		<input type="hidden" name="action" value="reg" />
	</form>

  <a href="/" class="btn">Обратно</a>
			</div>
		</div>
		</div>
	</body>
</html>