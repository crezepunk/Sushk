<?php
function send($email)
{
	//echo $email." ".$_POST['text']."</br>";
	if (mail($email, $_POST['name'], $_POST['text'],  
	"From: SmartYoungstersAcademy \r\n")) {
	    //echo "message accepted for delivery";
		header('Location: /');
	} else {
	    echo "some error happen";
	}
}

$DB = new PDO('mysql:host=localhost;dbname=youngstersdb', 'root');
$q = $DB->query("SELECT * from `students` WHERE `group`='2' AND `email`!=''")->fetchAll();
foreach ($q as $key) {
	send($key['email']);
}
?> 