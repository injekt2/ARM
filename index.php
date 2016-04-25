<?php
session_start();
if($_SESSION['auth_admin']=="yes_auth")
{
   if (isset($_GET["logout"]))
   {
    unset($_SESSION['auth_admin']);
    header("Location: login.php");
   }
   include("include/db_connect.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link href="css/reset.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />	
    
    <title>Анализ условий труда</title>
</head>

<body style="background-image: url(images/background.ipg)">
<div id="block-body">
<?php
include ("include/block-header.php"); 

$query1 = mysql_query("SELECT * FROM orders",$connection);
$result1 = mysql_num_rows($query1);

$query2 = mysql_query("SELECT * FROM products",$connection);
$result2 = mysql_num_rows($query2);
?>
<div id="block-content">
<div id="block-parameters">
<p id="title-page">Общая статистика</p></div>

<ul id="general-statistics">
<li><p>Всего заказов - <span><? echo $result1?></span></p></li>
<li><p>Всего товаров - <span><? echo $result2?></span></p></li>
</ul>

<h3 id="title-statistics">Статистика продаж</h3>

<table align="center" cellpadding="10" width="100%">
<tr>
<th align="center">Дата</th>
<th align="center">Товар</th>
<th align="center">Цена</th>
<th align="center">Статус</th>
</tr>
<?php
$result = mysql_query("SELECT * FROM orders WHERE order_confirmed='yes'",$connection);
if(mysql_num_rows($result)>0)
{
    $row=mysql_fetch_array($result);
    do{
        
        echo'
        <tr>
        <td align="center">'.$row["order_datetime"].'</td>
        <td align="center">'.$row["product"].'</td>
        <td align="center">'.$row["cena"].'</td>
        <td align="center">Выполнен</td>
        </tr>
        ';
    }while($row=mysql_fetch_array($result));
}
 ?>
</table>
</div>
</div>


</body>
</html>
<?php 
}else
{
    header("Location: login.php");
}
?>