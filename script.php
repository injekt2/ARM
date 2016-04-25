<?php
include("include/db_connect.php");
$actions = array('showlist', 'delete');
$action = 'showlist';
if ( isset($_GET['action']) and in_array($_GET['action'], $actions) ) $action= $_GET['action'];

switch ( $action ) 
{ 
  case 'showlist':    // Список всех записей в таблице БД
    show_list(); break; 
  case 'delete':      // Удалить запись в таблице БД
    delete_item(); break;
}

// Функция выводит список всех записей в таблице БД

function show_list() 
{ 
  $query = "SELECT `id`, `name_company`, `phone`, `director`, `location`, `activity` FROM `proects`"; 
  $res = mysql_query( $query ); 
  echo '<h2>Список</h2>'; 
  echo '<table border="1" cellpadding="2" cellspacing="0">'; 
  echo '<tr><th>ID</th><th>Наименование</th><th>Описание</th><th>Ред.</th><th>Удл.</th></tr>'; 
  while ( $item = mysql_fetch_array( $res ) ) 
  { 
    echo '<tr>'; 
    echo '<td>'.$item['id'].'</td>'; 
    echo '<td>'.$item['name_company'].'</td>'; 
    echo '<td>'.$item['phone'].'</td>';
	echo '<td>'.$item['director'].'</td>';
	echo '<td>'.$item['location'].'</td>';
    echo '<td>'.$item['activity'].'</td>';	
    echo '<td><a href="'.$_SERVER['PHP_SELF'].'?action=editform&id='.$item['id'].'">Ред.</a></td>'; 
    echo '<td><a href="'.$_SERVER['PHP_SELF'].'?action=delete&id='.$item['id'].'">Удл.</a></td>'; 
    echo '</tr>'; 
  } 
  echo '</table>';
  echo '<p><a href="'.$_SERVER['PHP_SELF'].'?action=addform">Добавить</a></p>';  
} 

// Функция формирует форму для добавления записи в таблице БД 


// Функция удаляет запись в таблице БД 
function delete_item() 
{ 
  $query = "DELETE FROM `proects` WHERE `id`=".$_GET['id']; 
  mysql_query ( $query ); 
  header("Location: proects.php");
  die();
} 
?>