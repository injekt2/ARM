<?php


$result = mysql_query("SELECT * FROM orders WHERE order_confirmed='no'",$connection);
$count = mysql_num_rows($result);
if($count>0)
{
    $count_str = '<p>+'.$count.'</p>';
}else
{
    $count_str = '';
}
?>
<div id="block-header">

<div id="block-header1">
<h3>������ ����������</h3>
</div>

<div id="block-header2">
<p align="right"><a href="?logout" class="button button-red"><span>�����</span></a></p>
</div>
</div>
<div id="left-nav">
<ul>
<li><a href="../index.php"><img src="images/logo.jpg" height="" width="184"  /></a></li>
<li><a href ='index.php' >�������</a></li>
<li><a href="orders.php">������</a><? echo $count_str ?></li>
<li><a href="tovar.php">������</a></li>
<li><a href="category.php">���������</a></li>
</ul>
</div>


