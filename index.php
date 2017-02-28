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
        <form method="post" action="index.php" name="loginform" class="form-signin">
               <fieldset>
               <h2 class="form-signin-heading">Please sign in</h2>
               <label for="username" class="sr-only">Username</label>
               <input type="username" id="username" class="form-control" placeholder="Username" name="username" required autofocus>
               <label for="password" class="sr-only">Password</label>
               <input type="password" id="password" class="form-control" placeholder="P@ssword1" name="password" required>
               <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
               </fieldset>
           </form>
        <?php
                   // Check the database to see if this person exists.
                   if(!empty($_POST['username']) && !empty($_POST['password'])) {
                       $username = mysql_real_escape_string($_POST['username']);
                       $password = md5(mysql_real_escape_string($_POST['password']));

                       // MySQL Query for the database.
                       $checklogin = mysql_query("SELECT * FROM users WHERE Username = '".$username."' AND Password = '".$password."'");

                       // Hurrah! You're logged in, I think.
                       if(mysql_num_rows($checklogin) == 1) {
                           $row = mysql_fetch_array($checklogin);
                           $email = $row['EmailAddress'];

                           // Stored information in the session. The persons username, and their email. This is so we can adress them by email/username if needed.
                           $_SESSION['Username'] = $username;
                           $_SESSION['EmailAddress'] = $email;
                           $_SESSION['LoggedIn'] = 1;

                           echo "<div class='alert alert-success' role='alert'><p><strong>All good!</strong> Logging you in now... please wait.</div>";
                           echo "<script> window.location.replace('/scouting/index.php')</script>";
                       }
                       else {
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
