<?php


  include "base.php";
?>

<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="SteamScout">
      <meta name="author" content="Brennan Macaig, FRC-1721">

      <title>SteamScout - Log In</title>

      <!-- Bootstrap 4.0.0-alpha.6 core CSS -->
      <link href="https://v4-alpha.getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">

      <!-- Custom Style -->
      <link href="css/index.css">
    </head>
    <body>
      <?php
        if (!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Email'])) {
          echo "<script> window.location.replace('/scouting/')</script>";
        }
      ?>
      <div class="container">
        <form class="form-signin">
          <h2 class="form-signin-heading">Login to Steam Scout</h2>
          <label for="inputEmail" class="sr-only">Email Address</label>
          <input type="email" id="inputEmail" class="form-control" placeholder="foo@bar.com" name="username" required autofocus>
          <label for="inputPassword" class="sr-only">Password</label>
          <input type="password" id="inputPassword" class="form-control" placeholder="P@ssword1" name="password" required>
          <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
        </form>
        <?php
          if (!empty($_POST['username']) && !empty($_POST['password'])) {
            $email = mysql_real_escape_string($_POST['username']);
            $password = md5(mysql_real_escape_string($_POST['password']));

            $checklogin - mysql_query("SELECT * FROM users WHERE Username = '".$username."' AND Password = '".$password."'");
            if(mysql_num_rows($checklogin) == 1) {

              $_SESSION['Email'] = $email;
              $_SESSION['LoggedIn'] = 1;

              echo "<div class='alert alert-success' role='alert'><p><strong>All good!</strong> Redirecting you now... please wait.</div>";
              echo "<script> window.location.replace('/scouting/')</script>";
            } else {
              echo "<div class='alert alert-danger' role='alert'><p><strong>Uh oh.</strong> I can't log you in. Please, try re-typing your username and password. If you continue to see this message, contact the system administrator(s).</div>";
            }
          }
        ?>
      </div>
    <!-- Bootstrap Core JS -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
  </body>
</html>
