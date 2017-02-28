<?php


  include "../base.php";
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="SteamScout">
    <meta name="author" content="Brennan Macaig, FRC-1721">
    <title>SteamScout</title>
    <!-- Bootstrap 4.0.0-alpha.6 core CSS -->
    <link href="https://v4-alpha.getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="/css/font-awesome.min.css" rel="stylesheet"/>
    <!-- Custom Style -->
    <link href="css/index.css">
  </head>
  <body>
    <?php
    if (!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username'])) {
    ?>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href-"../scouting/">SteamScout</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active">Home</li>
            <li><a href="../logout">Log Out</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="jumbotron">
      <div class="container">
        <h1>SteamScout</h1>
        <<p><<strong>Create a new Event. </strong>On this page you can add a new event to the database. Please fill in all the required fields below.</p>
      </div>
    </div>
    <?php
      if (isset($_POST['register']) && isset($_POST['name']) && isset($_POST['week']) && isset($_POST['tba_code'])) {
        $name = mysql_real_escape_string($_POST['name']);
        $week = mysql_real_escape_string($_POST['week']);
        $tbacode = mysql_real_escape_string($_POST['tba_code']);

        $registerQuery = mysql_query("INSERT INTO events (Name, Week, TBACode) VALUES ('".$name."', '".$week."', '".$tbacode."');");

        if ($registerQuery) {
          echo "<script> window.location.replace('../scouting/index.php?s=addEvent')</script>";
        } else {
          echo "<script> window.location.replace('../scouting/index.php?f=addEvent')</script>";
        }
      } else {
    ?>
    <div class="container">
      <form method="post" action="/scouting/newEvent.php" name="registerform" id="registerform" class="form-horizontal">
        <div class="form-group">
          <label for="name" class="col-sm-2">Event Name</label>
          <div class="col-sm-10"><input type="text" class="form-control" id="name" name="name" placeholder="Granite State Event"></div>
          <label for="week" class="col-sm-2">Week</label>
          <div class="col-sm-10">
            <select class="form-control" name="week" for="week">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
            </select>
          </div>
          <label for="tbacode" class="col-sm-2">TBA Code</label>
          <div class="col-sm-10"><input type="text" class="form-control" id="tba_code" name="tba_code" placeholder="2011gsr"></div>
        </div>
        <div class="form-group">
          <input type="submit" name="register" id="register" class="btn btn-default" value="Submit" />
        </div>
      </form>
    </div>
    <?php } ?>
    <hr>
    <footer>
      <div style="display:table-cell;vertical-align:bottom;">
        <div style="margin-left:auto;margin-right:auto;">
          <p>SteamScout <i class="fa fa-copyright"> Concord Robotics and Brennan Macaig 2017. All Rights Reserved. &bull; <a href="../license.html">License</a> &bull; <a href="http://www.frc1721.org">FRC 1721 Home</a>'
        </div>
      </div>
    </footer>
    <?php
    } else {
      echo "<meta http-equiv='refresh' content='/' />";
      echo "<script> window.location.replace('/')</script>";
      // Whoops! Not logged in.
    }
    ?>
  </body>
</html>
