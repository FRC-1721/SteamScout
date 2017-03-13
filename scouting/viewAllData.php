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
            <li><a href="../scouting">Home</a></li>
            <li class="active"><a href="#">View All Data</a></li>
            <li><a href="../scouting/print.php">Print Data</a></li>
            <li><a href="../logout.php">Log Out</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="jumbotron">
      <div class="container">
        <h1>SteamScout</h1>
        <p><strong>FRC 1721 - Tidal Force presents SteamScout.</strong> This is a cloud based scouting software designed to run on a raspberry pi in the stands for competition. It was designed by
          members of the team, and then built by Brennan Macaig.</p>
      </div>
    </div>
    <div class="container">
      <hr>
      <div class="row">
        <table class="Table table-striped table-bordered">
          <?php
            $query = "SELECT * FROM 2017marea";
            $result = mysql_query($query);
            $content = array();

            $num = mysql_num_rows($result);
            if ($num > 0) {
              while($row = mysql_fetch_assoc($result)) {
                $content[$row['Team']] = $row;
              }
            }
            if ($num > 0) {
            ?>
            <thead>
              <tr>
                <th><?php echo implode('</th><th>', array_keys(current($content)));?></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($content as $tablerow): ?>
              <tr>
                <td><?php echo implode('</td><td>', $tablerow);?>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
          <?php } else { ?>
          <div class="alert alert-info" role="alert">
            <p><strong>¯\_(ツ)_/¯</strong> It looks like you haven't entered any data to list yet.</p>
          </div>
          <?php } ?>
        </div>
        <hr>
        <footer>
          <div style="display:table-cell;vertical-align:bottom;">
            <div style="margin-left:auto;margin-right:auto;">
              <p>SteamScout <i class="fa fa-copyright"> Concord Robotics and Brennan Macaig 2017. All Rights Reserved. &bull; <a href="../license.html">License</a> &bull; <a href="http://www.frc1721.org">FRC 1721 Home</a>'
            </div>
          </div>
        </footer>
      </div>
      <?php
    } else {
      echo "<meta http-equiv='refresh' content='/' />";
      echo "<script> window.location.replace('/')</script>";
      // Whoops! Not logged in.
    } ?>
    <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>
