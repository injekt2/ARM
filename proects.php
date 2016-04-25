<?php
session_start();

if($_SESSION['auth_admin']=="yes_auth")
{
	include("include/db_connect.php");
	include("include/functions.php");
	
	if (isset($_GET["logout"]))
   {
    unset($_SESSION['auth_admin']);
	header("Location: login.php");
	
   }
   if (isset($_GET["submit_proect"]))
   {
    header("Location: add_proect.php");
   }
    if (isset($_GET["delete"]))
   {
    $id=$_GET['id'];
	$sql = "DELETE FROM proects WHERE id=$id";
    mysql_query($sql) or die (mysql_error());
	header("Location: proects.php");
   }
   

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Проекты</title>
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
	<h1>Список ваших предприятий</h1>
	<p>Выберете предприятие, которое вас интересует.</p>
</div>
<section class="proect_content">
<?php
	$user_id = $_SESSION["user_id"];
	$result = mysql_query("SELECT * FROM proects WHERE user_id = '$user_id'",$connection);
if (mysql_num_rows($result)> 0) 
{
	$row = mysql_fetch_array($result);
	do 
	{
		echo'
		<div class="item_proect">
		<h2>'.$row["name_company"].'</h2>
		<ul>
			<li><span>Адресс:</span>'.$row["location"].'</li>
			<li><span>Телефон:</span>'.$row["phone"].'</li>
			<li><span>Директор:</span>'.$row["director"].'</li>
			<li><span>Деятельность:</span>'.$row["activity"].'</li>
		</ul>
		<p><a href="proect.php?id='.$row["id"].'" id="submit_enter">Выбрать</a></p>
		<p><a href="'.$_SERVER['PHP_SELF'].'?delete&id='.$row['id'].'" id="submit_delete">Удалить</a></p>
	</div>
	
		';
	} 
	while ( $row = mysql_fetch_array ($result));
}
else 
{
	echo '<div class="msg_no_proects"><h2>У вас ещё нет проектов в системе!</h2></div>';
}

?>
</section>
<section class="proect_submit">
	<a href="?submit_proect" class="submit_proect">Добавить проект</a>
</section>
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