<?php

        $host = 'localhost';
        $user = 'root';
        $db = 'arm';
        $connection = mysql_connect($host, $user);
        mysql_query('SET NAMES "utf8"', $connection);
        if(!$connection || !mysql_select_db($db,$connection))
        {
            return false;
        }
        return $connection;
		mysql_query("SET NAMES utf8");

?>