<?
session_start();
define('auth_admin',true);
include("include/db_connect.php");
include("include/functions.php");

if($_POST["submit_enter"])
{
    $login=clear_string($_POST["input_login"]);
    $pass=clear_string($_POST["input_pass"]);
    
    if($login && $pass)
    { 
    $pass = md5($pass);
    //$pass = strrev($pass);
    //$pass = strtolower("erwerfs".$pass."ertegd");
        
        $result = mysql_query("SELECT * FROM users WHERE username ='$login' AND password = '$pass' ",$connection);
    
    if(mysql_num_rows($result)>0)
    {
        $row=mysql_fetch_array($result);
        $_SESSION['auth_admin']='yes_auth';
		$_SESSION["user_id"] = $row["id"];
		$_SESSION["admin_role"] = $row["role"];
        header("Location:proects.php");
    }
    else{
        $msgerror="Неверный пароль или логин";
    }
    
    }
    else{
        $msgerror="Заполните все поля!";
    
    }}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
   <link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/style-login.css" rel="stylesheet" type="text/css" />

	<title>АРМ инженера труда - Вход</title>
	<style type="text/css">
</style>
</head>

<body>
<?php
include ("include/header.php"); 
?>
<header>
	<div class="header_title">
		<h1>Добро пожаловать!</h1>
		<p>Для дальнейшей работы необходимо выполнить авторизацию.</p>
	</div>	
</header>

<div id="login" class="login">
<?php 
if($msgerror)
{
    echo'<p id="msgerror">'.$msgerror.'</p>';
}?>
<div class="auth">
	<h2>Авторизация</h2>
</div>
<form method="post">
<ul>
<label>Логин</label><li><input type="text" name="input_login" id="username" class="input" value="" size="20" /></li>
<label>Пароль</label><li><input type="password" name="input_pass" id="password" class="input" value="" size="32" /></li>
<input type="submit" name="submit_enter" id="submit_enter" value="Войти!"/>
</ul>
</form>
</div>



</body>
</html>