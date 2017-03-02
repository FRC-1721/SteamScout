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
        <h1>Removing Event...</h1>
        <p><strong>Please wait while we delete that event for you.</strong></p>
      </div>
    </div>
    <?php
      $id = ($_GET['id']);
      $query = "DELETE FROM events WHERE ID=".$id."";
      $result = mysql_query($query);
      if ($result) {
        echo "<script> window.location.replace('/manager/index?success=deleteEvent')</script>";
      } else {
        echo "<script> window.location.replace('/manager/index?failure=deleteEvent')</script>";
      }
    ?>
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
