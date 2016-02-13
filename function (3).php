<?php
//функция добавления заявки в базу данных
function addCard(){
	$lastName = $_POST['lastName'];
	//проверка на пустату данных
	if(empty($lastName))
        {
            echo "<script>alert(\"Введите Фамилию.\");</script>";
			exit();
        }
        //проверка на длину данных
        elseif(strlen($lastName)>50)
        {
            echo "<script>alert(\"Фамилия превышает 20 символов!.\");</script>";
			exit();
        }
		
	$name = $_POST['name'];
	if(empty($lastName))
        {
            echo "<script>alert(\"Введите имя.\");</script>";
			exit();
        }
        // Например, если длина имени превышает 20 символов
        elseif(strlen($lastName)>20)
        {
            echo "<script>alert(\"имя превышает 20 символов!.\");</script>";
			exit();
        }
	$middleName = $_POST['middleName'];
	if(empty($middleName))
        {
            echo "<script>alert(\"Введите отчество.\");</script>";
			exit();
        }
       
        elseif(strlen($middleName)>50)
        {
            echo "<script>alert(\"Отчество превышает 20 символов!.\");</script>";
			exit();
        }
	$fio = $lastName." ".$name." ".$middleName;
	
		
	$grade = $_POST['grade'];
	if(empty($grade))
        {
            echo "<script>alert(\"Введите класс.\");</script>";
			exit();
        }
        
        elseif(strlen($grade)>10)
        {
            echo "<script>alert(\"Поле \"Класс\" превышает 10 символов!.\");</script>";
			exit();
        }
		
	$email = $_POST['email'];
	if(empty($email))
        {
            echo "<script>alert(\"Введите Электронный адрес.\");</script>";
			exit();
        }
       
        elseif(strlen($email)>100)
        {
            echo "<script>alert(\"Электронный адрес превышает 100 символов!.\");</script>";
			exit();
        }
		
	$phone = $_POST['phone'];
	if(empty($phone))
        {
            echo "<script>alert(\"Введите номер телефона.\");</script>";
			exit();
        }
        
        elseif(strlen($phone)>15)
        {
            echo "<script>alert(\"Номер телефона превышает 15 символов!.\");</script>";
			exit();
        }
	
		$schoolsId = $_POST['schoolsId'];
	if($schoolsId == 458)
        {
         echo "<script>alert(\"выберите школу.\");</script>";
		exit();
        }
	else{
		
	}

	
	$sql = mysql_query("INSERT INTO `students` (`fio`, `grade`, `email`, `phone`, `school_id`) VALUES ('$fio', '$grade', '$email', '$phone', '$schoolsId')");
	echo "<div id = \"parent_div\">
										  <div id = \"div\">
											<p>Вы успешно подали заявку. Ожидайте рассмотрения вашей заявки.</p>
											<a href=\"anketa.php\">Я очень рад этому</a>
											<p>..</p>
											
										  </div>
										</div>";
}
function addCardAdmin(){
	$lastName = $_POST['lastName'];
	//проверка на пустату данных
	if(empty($lastName))
        {
            echo "<script>alert(\"Введите Фамилию.\");</script>";
			exit();
        }
        //проверка на длину данных
        elseif(strlen($lastName)>50)
        {
            echo "<script>alert(\"Фамилия превышает 20 символов!.\");</script>";
			exit();
        }
		
	$name = $_POST['name'];
	if(empty($lastName))
        {
            echo "<script>alert(\"Введите имя.\");</script>";
			exit();
        }
        // Например, если длина имени превышает 20 символов
        elseif(strlen($lastName)>20)
        {
            echo "<script>alert(\"имя превышает 20 символов!.\");</script>";
			exit();
        }
	$middleName = $_POST['middleName'];
	if(empty($middleName))
        {
            echo "<script>alert(\"Введите отчество.\");</script>";
			exit();
        }
       
        elseif(strlen($middleName)>50)
        {
            echo "<script>alert(\"Отчество превышает 20 символов!.\");</script>";
			exit();
        }
	$fio = $lastName." ".$name." ".$middleName;
	
		
	$grade = $_POST['grade'];
	if(empty($grade))
        {
            echo "<script>alert(\"Введите класс.\");</script>";
			exit();
        }
        
        elseif(strlen($grade)>10)
        {
            echo "<script>alert(\"Поле \"Класс\" превышает 10 символов!.\");</script>";
			exit();
        }
		
	$email = $_POST['email'];
	if(empty($email))
        {
            echo "<script>alert(\"Введите Электронный адрес.\");</script>";
			exit();
        }
       
        elseif(strlen($email)>100)
        {
            echo "<script>alert(\"Электронный адрес превышает 100 символов!.\");</script>";
			exit();
        }
		
	$phone = $_POST['phone'];
	if(empty($phone))
        {
            echo "<script>alert(\"Введите номер телефона.\");</script>";
			exit();
        }
        
        elseif(strlen($phone)>15)
        {
            echo "<script>alert(\"Номер телефона превышает 15 символов!.\");</script>";
			exit();
        }
	
		$schoolsId = $_POST['schoolsId'];
	if($schoolsId == 458)
        {
         echo "<script>alert(\"выберите школу.\");</script>";
		exit();
        }
		$groups = $_POST['groups'];
	if(empty($email))
        {
            echo "<script>alert(\"Выберите группу.\");</script>";
			exit();
        }
	else{
		
	}

	
	$sql = mysql_query("INSERT INTO `students` (`fio`, `grade`, `email`, `phone`, `school_id`, `active`) VALUES ('$fio', '$grade', '$email', '$phone', '$schoolsId', `1`)");
	echo "<div id = \"parent_div\">
										  <div id = \"div\">
											<p>Вы успешно подали заявку. Ожидайте рассмотрения вашей заявки.</p>
											<a href=\"anketa.php\">Я очень рад этому</a>
											<p>..</p>
											
										  </div>
										</div>";
}

//Функция чего то!
function closeGroup(){
	$now=date("Y-m-d H:i:s");
						$groups_id = $_POST['groups_id'];
						echo $groups_id;
						$sql = mysql_query("UPDATE `groups` SET `enddate` = '$now'  ,`closed` = '1' WHERE `id` = '$groups_id'");
						echo mysql_error();
	}
	function editStudCard(){
		$id = $_GET["id"];
		$fio = $_POST['fio'];
		$group = $_POST['group'];
		echo $group;
		$schoolsId = $_POST['schoolsId'];
		echo $schoolsId;
		$now=date("Y-m-d H:i:s");
		$grade = $_POST['grade'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		echo $email;
		$sql = mysql_query("UPDATE students SET fio='$fio', school_id='$schoolsId', grade='$grade', phone='$phone', email='$email' WHERE id='$id' ");
		
		//$sql2 = mysql_query("INSERT INTO  `students_groups` (`student_id`, `group_id`, `startdate`) VALUES (`$id`, `$group`$group' WHERE student_id='$id'");
		echo mysql_error();
		
	}
	function perevod($group_id){
						// ОБРАТИ СЮДА ВНИМАНИЕ!!!! если нужно обновлять дату то раскаменти и добавь это в SET `startdate` = '$now'
		$now=date("Y-m-d H:i:s");	
		$id = $_GET["id"];
		$new_group_id = $_POST["group"];
		echo $new_group_id;
		echo $group_id;
		echo $id;
		echo mysql_error();
		$sql = mysql_query("UPDATE `students_groups` SET  `enddate` = '$now' WHERE `student_id` = '$id' And `group_id`='$group_id'");
		$sql2 = mysql_query("INSERT INTO `students_groups` (`student_id`, `group_id`, `startdate`) VALUES ('$id', '$new_group_id', '$now')");
						
						
	}
	function addSubject($group_id){
		$name = $_POST['name'];
		
		$description = $_POST['description'];
		
		$days = $_POST['days'];
	
		$task_name = $_POST['task_name'];
		$weight = $_POST['weight'];
		$task_description = $_POST['task_description'];
		
		$sql = mysql_query("INSERT INTO `subjects` (`name`, `description`, `group_id`) VALUES ('$name', '$description', '$group_id')");
		
		$result_set = mysql_query("SELECT * FROM subjects   ORDER BY id DESC LIMIT 1");
		$result = mysql_fetch_array($result_set);
		$sub_id = $result['id']; //полученный последний айди 
	
		 // Если ты забыл. то спомощью этой функции ты сможешь узнать ошибки в MYSQL
		$sql_task = mysql_query("INSERT INTO `tasks` (`task_name`, `subject_id`, `task_weight`, `days`, `task_description`) VALUES ('$task_name', '$sub_id', '$weight', '$days', '$task_description')");
		echo mysql_error();
		echo $group_id;
		//Получаем список студентов для запеси в таблицу subjects_students
		$sql24 = "SELECT students_groups.student_id ,students_groups.group_id, students.fio as namestudent , groups.name as namegroup FROM students_groups 
														JOIN groups ON (groups.id=students_groups.group_id)
														JOIN students ON (students.id=students_groups.student_id)";
							if ($group_id){
								$sql .= " WHERE students_groups.group_id= $group_id";
							}
		$result_set24 = mysql_query($sql24);
		//вставляем значения в subjects_students
		while ($result24 = mysql_fetch_array($result_set24)) {
			$student_id = $result24['student_id'];
			$idSubject = mysql_query("SELECT * FROM  subjects  ORDER BY id DESC LIMIT 1");
			$resultIdSubject = mysql_fetch_array($idSubject);
			$Subject_id23 = $resultIdSubject['id'];
			$sql_task = mysql_query("INSERT INTO `subjects_students` (`student_id`, `subject_id`, `work`) VALUES ('$student_id', '$Subject_id23', '')");
		}
	}
	
	function upSubject($subject_id){
		$group_id = $_GET["id"];
		$name = $_POST['name'];
		$days = $_POST['days'];
		$description = $_POST['description'];
		$task_name = $_POST['task_name'];
		$task_weight = $_POST['task_weight'];
		$task_description = $_POST['task_description'];
		$up = "UPDATE subjects,tasks SET subjects.name='$name', tasks.days='$days', subjects.description='$description' , 
		tasks.task_name='$task_name', tasks.task_description='$task_description', tasks.task_weight='$task_weight'
		WHERE id='$group_id' and subject_id='$group_id'";
		//$up2 = "UPDATE tasks SET task_name='$task_name', task_description='$task_description', task_weight='$task_weight'  WHERE subject_id='$group_id'";
		mysql_query($up);
		//mysql_query($up2);
		$rez = mysql_query("SELECT id FROM subjects");
		/*if (!$up2){
			die('updating error'. mysql_error());
				}
				else { echo 1; }*/
	
   echo mysql_error();
			/*if ($up == true) {
		echo "<meta http-equiv='Refresh' content='0;URL=view_task.php?id="<?php .$rez["id"].?>"'>";
		}*/
		
	}
	function peremStud(){
	
	$old_group = $_POST["old_group"];
	$new_group = $_POST["new_group"];
    echo $new_group;	
	$up = "UPDATE students_groups SET group_id='$new_group'	WHERE group_id='$old_group'";
	mysql_query($up);
	  echo mysql_error();
	/*$u2 = $_POST['perem'];
													  if(empty($u2))
													  {
														echo("Вы ничего не выбрали.");
													  }
													  else
													  {
														$N = count($u2);
													  echo("Вы выбрали $N здание(й): ");}	*/
		
		
		
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
	function prep_update($prep_id){
		$group_id = $_GET['id'];
		$prep_id = $_POST['prep_id'];

	
		$up = "UPDATE groups SET teacher_id='$prep_id'	WHERE id='$group_id'";
	mysql_query($up);
	  echo mysql_error();
	
	}
	//две функции отвечающие за посещение
	function addWork($studentIdForAddWork){
		
		$sql = mysql_query("UPDATE `subjects_students` SET `work` = '1' WHERE `student_id` = '$studentIdForAddWork'");
		echo mysql_error();
	}
	
	function deleteWork($studentIdForAddWork){
		echo $studentIdForAddWork;
		$sql = mysql_query("UPDATE `subjects_students` SET `work` = '0' WHERE `student_id` = '$studentIdForAddWork'");
		echo mysql_error();
	}
?>