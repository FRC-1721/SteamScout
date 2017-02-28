<?php

  include "lib/mysql.php";
  $db_host = "localhost";
  $database = "robotics";
  $db_username = "scouting";
  $db_password = "StormScout";


  session_start();
  mysql_connect($db_host, $db_username, $db_password) or die("MySQL Error: " . mysql_error());
  mysql_select_db($database) or die("MySQL Error: " . mysql_error());
?>
