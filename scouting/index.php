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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link href="../css/font-awesome.min.css" rel="stylesheet"/>
    <!-- Custom Style -->
    <link href="../css/index.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
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
            <li class="active"><a href="#">Home</a></li>
            <li><a href="../scouting/viewAllData.php">View All Data</a></li>
            <li><a href="../scouting/print.php">Print Data</a></li>
            <li><a href="../logout">Log Out</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <?php
            if (isset($_GET['s'])) {
            switch ($_GET['s']) {
                case "1":
                    ?>
                    <div class="alert alert-success" role="alert">
                        <p><strong>(づ｡◕‿‿◕｡)づ</strong> We added your scouting record. Do another!</p>
                    </div>
                    <?php
                    break;
            }}
            if (isset($_GET['f'])) {
            switch ($_GET['f']) {
              case "1":
                ?>
                <div class="alert alert-danger" role="alert">
                    <p><strong>┐(‘～`；)┌</strong> Sorry, but that record failed. Try again maybe?</p>
                </div>
                <?php break;
            }}
            ?>
    <div class="jumbotron">
      <div class="container">
        <h1>SteamScout</h1>
        <p><strong>FRC 1721 - Tidal Force presents SteamScout.</strong> This is a cloud based scouting software designed to run on a raspberry pi in the stands for competition. It was designed by
          members of the team, and then built by Brennan Macaig.</p>
      </div>
    </div>
    <?php
      if (isset($_POST['team']) && isset($_POST['match']) && isset($_POST['auto']) && isset($_POST['gear']) && isset($_POST['kpa']) && isset($_POST['climb'])) {
        $team = mysql_real_escape_string($_POST['team']);
        $match = mysql_real_escape_string($_POST['match']);
        $auto = mysql_real_escape_string($_POST['auto']);
        $gear = mysql_real_escape_string($_POST['gear']);
        $kpa = mysql_real_escape_string($_POST['kpa']);
        $climb = mysql_real_escape_string($_POST['climb']);

        $postQuery = mysql_query("INSERT IGNORE 2017marea (Team, `Match`, Auto, Gear, Kpa, Climb) VALUES ($team, $match, $auto, $gear, $kpa, $climb)");

        if ($postQuery) {
          echo "<script> window.location.replace('../scouting/index.php?s=1')</script>";
        } else {
          echo "<script> window.location.replace('../scouting/index.php?f=1')</script>";
        }
      } else {
    ?>
    <div class="container">
      <hr>
      <div class="row">
        <form method="POST" action="/scouting/index.php", name="registerform" id="registerform" class="form-horizontal">
          <div class="form-group">
            <label for="team" class="col-sm-2">Team Number:</label>
            <div class="col-sm-10">
              <input type="text" name="team" id="team">
            </div>
            <label for="match" class="col-sm-2">Match Number:</label>
            <div class="col-sm-10">
              <input type="text" name="match" id="match">
            </div>
          </div>
          <div class="form-group">
            <label for="auto" class="col-sm-2">Autonomous Performance</label>
            <div class="col-sm-10">
              <div class="radio">
                <label>
                  <input type="radio" name="auto" id="auto" value="1" checked>
                  Did nothing
                </label>
              </div>
              <div class="radio">
                <label>
                  <input type="radio" name="auto" id="auto" value="2">
                  Only Crossed Line (Dark Green / Gray)
                </label>
              </div>
              <div class="radio">
                <label>
                  <input type="radio" name="auto" id="auto" value="3">
                  Deposited Gear
                </label>
              </div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2">Gears Delivered (TELE)</label>
          <div class="col-sm-10">
            <select class="form-control" name="gear">
              <option value="0">0</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
            </select>
          </div>
          <label class="col-sm-2">Aprox. KPA Contribution</label>
          <div class="col-sm-10">
            <select class="form-control" name="kpa">
              <option value="0">0</option>
              <option value="5">5</option>
              <option value="10">10</option>
              <option value="15">15</option>
              <option value="20">20</option>
              <option value="25">25</option>
              <option value="30">30</option>
              <option value="35">35</option>
              <option value="40">40</option>
            </select>
          </div>
          <label for="tele" class="col-sm-2">Did they climb?</label>
          <div class="col-sm-10">
            <div class="radio">
              <label>
                <input type="radio" name="climb" id="climb" value="1" checked>
                Yes
              </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio" name="climb" id="climb" value="0">
                No
              </label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <input type="submit" name="register" id="register" class="btn btn-success" value="Submit" />
        </div>
      </form>
      </div>
      <?php } ?>
      <hr>
      <footer>
        <div style="display:table-cell;vertical-align:bottom;">
          <div style="margin-left:auto;margin-right:auto;">
            <p>SteamScout &copy; Concord Robotics and Brennan Macaig 2017. All Rights Reserved. &bull; <a href="../license.html">License</a> &bull; <a href="http://www.frc1721.org">FRC 1721 Home</a>'
          </div>
        </div>
      </footer>
    </div>
  <?php
    } else {
      echo "<meta http-equiv='refresh' content='/' />";
      echo "<script> window.location.replace('/')</script>";
      // Whoops! Not logged in.
    }
  ?>
  </body>
</html>
