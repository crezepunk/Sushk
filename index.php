<?php
error_reporting(E_ERROR);
session_start();
include("/server/connectMysql.php");
?>
<!doctype html>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<title>Система контроля успеваемости</title>
	<link rel="stylesheet" href="css/styles.css" type="text/css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,300" type="text/css">
	<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
	<script type="text/javascript" src="/js/jquery.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<!--[if lt IE 9]><script type="text/javascript" src="/js/jquery.js"></script>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->


	<link rel="stylesheet" type="text/css" href="css/style1.css" />
	<script language="javascript" type="text/javascript" src="js/jquery.js"></script>
	<script language="javascript" type="text/javascript" src="js/jquery.easing.js"></script>
	<script language="javascript" type="text/javascript" src="js/script.js"></script>
	<script type="text/javascript">	
 $(document).ready( function(){	
		var buttons = { previous:$('#lofslidecontent45 .lof-next') ,
next:$('#lofslidecontent45 .lof-previous') };
		$obj = $('#lofslidecontent45').lofJSidernews( { interval : 4000,
												direction		: 'opacitys',	
											 	easing			: 'easeInOutExpo',
												duration		: 1200,
												auto		 	: false,
												maxItemDisplay  : 4,
												navPosition     : 'horizontal', // horizontal
												navigatorHeight : 32,
												navigatorWidth  : 80,
												mainWidth		: 960,
												buttons			: buttons} );	
	});
</script>
</head>

<body>
	<div id="wrapper">
		<div id="header">
			<h1>Мастер-класс по программированию!!!!!!!!!!!!!</h1>
		</div>
		<div id="menu">
			<nav role="navigation">
				<ul>
					<li class="menu_holder"><a href="index.php"><div>Главная</div></a></li>
					<li><a><div>Информация</div></a>
						<div>
							<ul>
								<li><a href="info.php">О мастер-классах</a></li>
								<li><a href="prep_list.php">Список преподавателей</a></li>
							</ul>
						</div>
					</li>
					<li ><a href="list_group.php"><div>Учебная часть</div></a></li>
					<li><a href="anketa.php"><div>Анкета</div></a></li>
					<li><?php if (empty($_SESSION['login'])): ?> <a href="admin/index.php"><div>Войти</div></a></li>
					<li><?php elseif (isset($_SESSION['login'])): ?> <p>Здравствуйте, <?=$_SESSION['login']?><br>
					<a href="admin_panel.php"  >Панель</a>
					<a href="clear.php"  >Выйти</a>
					
					<?php endif; ?></li>
					
					<?/*php
					switch ($_SESSION['usertype_id']){
						case 2:
							echo ("вы учитель!!! ");
							echo ($_SESSION['usertype_id']);
							echo ("<input class=\"button_green\" type=\"submit\" style=\"width:200px\" value=\"Создать группу\"/");
							break;
					}*/
					?>
				</ul>
			</nav>
		</div>
		
		<div id="main">
		    <div id="content">
				<div id="lofslidecontent45" class="lof-slidecontent" style="width:960px; height:420px;">
					<div class="preload">
					</div>
					
					<div class="lof-main-outer" style="width:960px; height:420px;">
						<ul class="lof-main-wapper">
							<li>
								<img src="images/slider/001.jpg"  >           
							</li> 
							<li>
								<img src="images/slider/002.jpg"  >           
							</li> 
							<li>
								<img src="images/slider/003.jpg"  >            
							</li> 
							<li>
								<img src="images/slider/004.jpg"  >            
							</li> 
							<li>
								<img src="images/slider/005.jpg"  >            
							</li> 
							<li>
								<img src="images/slider/006.jpg"  >            
							</li> 
							 <li>
								<img src="images/slider/007.jpg"  >              	
							</li> 
							<li>
								<img src="images/slider/008.jpg"  >            
							</li> 
						</ul>  	
					</div>
					
					<div class="lof-navigator-wapper"> 
						<div onclick="return false" href="" class="lof-next">Next
						</div>
						
						<div class="lof-navigator-outer">
							<ul class="lof-navigator">
							   <li><img src="images/slider/min/001.jpg" /></li>
							   <li><img src="images/slider/min/002.jpg" /></li>
							   <li><img src="images/slider/min/003.jpg" /></li>
							   <li><img src="images/slider/min/004.jpg" /></li>    
							   <li><img src="images/slider/min/005.jpg" /></li>
							   <li><img src="images/slider/min/006.jpg" /></li>       
							   <li><img src="images/slider/min/007.jpg" /></li>       
							   <li><img src="images/slider/min/008.jpg" /></li>       		
							</ul>
						</div>
						
						<div onclick="return false" href="" class="lof-previous">Previous
						</div>
					</div> 
				</div> 
		
				<script type="text/javascript">
				</script>
			</div>	
		</div>
		
		<div id="footer">Copyright © 1999 – 2015 Институт математики и компьютерных наук.<br> Дальневосточный Федеральный Университет<br>
			
		</div>
	</div>
</body>
</html>