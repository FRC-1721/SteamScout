<?php

  $db_host = "localhost";
  $database = "database";
  $db_username = "username";
  $db_password = "password";


  session_start();
  mysql_connect($db_host, $db_username, $db_password) or die("MySQL Error: " . mysql_error());
  mysql_select_db($database) or die("MySQL Error: " . mysql_error());
?>
