<?php
session_start();

if($_SESSION['auth_admin']=="yes_auth")
{
	include("include/db_connect.php");
	include("include/functions.php");
	
	//echo $_SESSION["user_id"];
	if (isset($_GET["logout"]))
   {
    unset($_SESSION['auth_admin']);
	header("Location: login.php");
	
   }
   
   if(isset($_POST["add_proect"])){
if(!empty($_POST['location']) && !empty($_POST['phone']) && !empty($_POST['name_company']) && !empty($_POST['director']) && !empty($_POST['activity'])) {
	$location=$_POST['location'];
	$phone=$_POST['phone'];
	$name_company=$_POST['name_company'];
	$director=$_POST['director'];
	$activity=$_POST['activity'];
	$user_id=$_SESSION["user_id"]; 
	

		
	$query=mysql_query("SELECT * FROM proects WHERE name_company='".$name_company."'");
	$numrows=mysql_num_rows($query);
	
	if($numrows==0)
	{
	$sql="INSERT INTO proects(user_id,location, phone, name_company,director,activity) VALUES('$user_id','$location','$phone', '$name_company', '$director', '$activity')";

	$result=mysql_query($sql);


	if($result){
	 $message = "Проект успешно добавлен!";
	} else {
	 $message = "Оштбка добавления информации.";
	}

	} else {
	 $message = "Это имя проекта уже есть. Используйте другое.";
	}

} else {
	 $message = "Заполните все поля!";
}
}
   
   

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Добавление нового проекта</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/style-login.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
include ("include/header.php"); 
?>
<div class="header_title">
	<h1>Добавление нового проекта в систему</h1>
	<p>Введите необходимые данные.</p>
</div>
<div class="add_proect">
<?php if (!empty($message)) 
{
	echo '<p id="msgerror">'.$message.'</p>';
} 
?>
<!--<div class="auth">
	<h2>Проект</h2>
</div>-->
			<div id="login">
<form name="registerform" id="registerform" action="add_proect.php" method="post">
	<p style="margin-top: 15px;">
		<label for="user_pass">Название проекта<br />
		<input type="text" name="name_company" id="name_company" class="input" value="" size="20" /></label>
	</p>
	<p>
		<label for="user_login">Адресс<br />
		<input type="text" name="location" id="location" class="input" size="32" value=""  /></label>
	</p>
	
	
	<p>
		<label for="user_pass">Телефон<br />
		<input type="text" name="phone" id="phone" class="input" value="" size="32" /></label>
	</p>
	<p>
		<label for="user_pass">Директор<br />
		<input type="text" name="director" id="director" class="input" value="" size="32" /></label>
	</p>
	<p>
		<label for="user_pass">Деятельность<br />
		<input type="text" name="activity" id="activity" class="input" value="" size="32" /></label>
	</p>	
	

		<p class="submit">
		<input type="submit" name="add_proect" id="add_proect" class="button" value="Добавить!" />
	</p>
	
	<p class="regtext"><a href="proects.php" id="submit_enter" >Перейти к проектам</a></p>
</form>
	
	</div>
	</div>	
	<!--[if lt IE 9]>
	<script src="libs/html5shiv/es5-shim.min.js"></script>
	<script src="libs/html5shiv/html5shiv.min.js"></script>
	<script src="libs/html5shiv/html5shiv-printshiv.min.js"></script>
	<script src="libs/respond/respond.min.js"></script>
	<![endif]-->
	
	<script src="js/common.js"></script>
	<!-- Yandex.Metrika counter --><!-- /Yandex.Metrika counter -->
	<!-- Google Analytics counter --><!-- /Google Analytics counter -->
</body>
</html>
<?php 
}else
{
    header("Location: login.php");
}
?>