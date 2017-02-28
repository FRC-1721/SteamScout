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
            <li class="active">Home</li>
            <li><a href="../logout">Log Out</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="jumbotron">
      <div class="container">
        <h1>SteamScout<i class="fa fa-cloud"></i></h1>
        <p><strong>Tidal Force - Scouting Software.</strong> This is a cloud based scouting software designed to run on a raspberry pi in the stands for competition. It was designed by
          members of the team, and then built by Brennan Macaig. This is the main screen, where you can create an event, or work with one of the events already created.</p>
        <div class="btn-group" role="group" aria-label="Actions">
          <a class="btn btn-primary" role="button" href="addEvent">Add an Event</a>
        </div>
      </div>
    </div>
    <div class="container">
      <hr />
      <div class="row">
        <table class="table table-striped table-bordered">
          <?php
            $query = "SELECT * FROM events";
            $result = mysql_query($query);
            $content = array();

            $num = mysql_num_rows($result);
            if ($num > 0) {
              while ($row = mysql_fetch_assoc($result)) {
                $content[$row['ID']] = $row;
              }
            }
            if ($num > 0) {
          ?>
            <thead>
              <tr>
                <th><?php echo implode('</th><th>', array_keys(current($content)));?></th></th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($content as $tablerow): ?>
                <tr>
                  <td><?php echo implode('</td><td>', $tablerow);?></td>
                  <td><div class="btn-group" role="group" aria-label="Actions"><?php
                  echo "<a class='btn btn-success' role='button' href='../scouting/scout?id=".$tablerow['ID']."'>Work</a>'";
                  echo "<a class='btn btn-warning' role='button' href='../scouting/editEventSettings?id=".$tablerow['ID']."'>Settings</a>'";
                  echo "<button type='button' class='btn btn-danger' data-toggle='modal' data-target='#mdlid".$tablerow['ID']."'>Delete</button><div class='modal fade' id='mdlid".$tablerow['ID']."' tabindex='-1' role='dialog' aria-labelledby='Delete Modal' aria-hidden='true'><div class='modal-dialog'><div class='modal-content'><div class='modal-header'><button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button><h4 class='modal-title' id='modalLabel'>Are you sure?</h4></div><div class='modal-body'><p><strong>Are you sure?</strong> By pressing \"DELETE\" below you understand that there are risks to what you're about to do. Things may unexpectedly break and data may be lost. <strong>This is not able to be undone</strong>. Please proceede with caution.</p></div><div class='modal-footer'><button type='button' class='btn btn-success' data-dismiss='modal'>Return to Safety</button><a class='btn btn-danger' role='button' href='../scouting/deleteEvent?id=".$tablerow['ID']."'>I understand the risks, continue anyways.</a></div></div></div></div>";
                ?>
                </div></tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        <?php } else { ?>
        <div class="alert alert-info" role="alert">
          <p><strong>This is embarrassing...</strong> It doesn't look like you've created any events to scout yet. Look at the button above this message and create an event to scout first.</p>
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
    }
  ?>
</body>
</html>
