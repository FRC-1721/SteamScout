<?php


  include "../base.php";
  $_SESSION = array();
  session_destroy();
?>
<html>
    <head>
        <!-- THESE TAGS COME FIRST -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- OTHER TAGS -->

        <title>Logout | SteamScout</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/index.css" rel="stylesheet">
        <meta http-equiv="refresh" content="0;index">
    </head>
    <body>
        <div class="container">
            <h1>You're being logged out.</h1>
            <h2>If you aren't refreshed automatically, just close this window.</h2>
        </div>
    </body>
</html>
