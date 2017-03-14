<?php


  include "../base.php";

  $done = False;

  function roundUpToAny($n,$x=5) {
      return (round($n)%$x === 0) ? round($n) : round(($n+$x/2)/$x)*$x;
  }

  function eliminateOutliers($list) {
    sort($list);

    $newArr = array();
    $counter = 0;

    foreach ($list as $i) {
      if($counter == 0) {
        $counter++;
        continue;
      } else if ($counter == count($list) - 1) {
        break;
      } else {
        $x = $counter - 1;
        $newArr[x] = $i;
      }
      $counter++;
    }

    if (count($newArr) == 0) {
      // Done
      $done = True;
      return $list;
    }

    $average = array_sum($newArr) / count($newArr);

    $first = $list[0];
    $y = count($list) - 1;
    $last = $list[$y];

    $firstDist = abs($average - $first);
    $lastDist = abs($average - $last);

    $finalArr = array();

    if ($firstDist < $lastDist) {
      $finalArr[0] = $first;
      for ($z = 1; $z < count($newArr) + 1; $z++) {
        $finalArr[$z] = $newArr[$z-1];
      }
    } else if ($lastDist < $firstDist) {
      for($z = 0; $z < (count($list)) - 2; $z++) {
        $finalArr[$z] = $newArr[$z];
      }
      $finalArr[(count($list)) - 2] = $list[count($list)-1];
    } else {
      $finalArr = $list;
      $done = True;
    }

    return $finalArr;
  }
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
            <li class="active"><a href="#">Home</a></li>
            <li><a href="../scouting/viewAllData.php">View All Data</a></li>
            <li><a href="../scouting/print.php">Print Data</a></li>
            <li><a href="../logout">Log Out</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="jumbotron">
      <div class="container">
        <h1>SteamScout - Generating List</h1>
        <p><strong>Please wait...</strong> Generating a pick list is hard work and takes me a few seconds. Please wait.</p>
      </div>
    </div>
    <?php
      // Picklist algorithm.

      $initialQuery = "DROP TABLE ranking";
      $nextQuery = "CREATE TABLE `ranking` (`Team` INT(25) NOT NULL, `ScoutPoints` INT(25) NOT NULL)";
      $result1 = mysql_query($initialQuery);
      $result2 = mysql_query($nextQuery);
      if (($result1) && ($result2)) {
      $teams  = array(58,
                      133,
                      173,
                      246,
                      319,
                      1027,
                      1058,
                      1071,
                      1289,
                      1474,
                      1699,
                      1721,
                      1761,
                      2084,
                      2423,
                      2648,
                      2713,
                      3451,
                      3930,
                      4169,
                      4311,
                      4555,
                      4564,
                      4572,
                      4761,
                      4906,
                      4909,
                      4929,
                      5122,
                      5459,
                      5556,
                      5735,
                      5752,
                      5962,
                      6161,
                      6324,
                      6335,
                      6617,
                      6731,
                      6762);
      foreach ($teams as $team) {
        $query = "SELECT * FROM 2017marea WHERE Team=$team";

        $result = mysql_query($query);

        $auto = array();
        $gear = array();
        $kpa = array();
        $climb = array();

        while($row = mysql_fetch_assoc($result)) {
          array_push($auto, $row["Auto"]);
          array_push($gear, $row["Gear"]);
          array_push($kpa, $row["Kpa"]);
          array_push($climb, $row["Climb"]);
        }

        $auto1 = $auto;
        $auto2 = array();
        $gear1 = $gear;
        $gear2 = array();
        $kpa1 = $kpa;
        $kpa2 = array();
        $climb1 = $climb;
        $climb2 = array();

        $done = False;

        while (!$done) {
          $auto2 = eliminateOutliers($auto1);
          $auto1 = eliminateOutliers($auto2);
        }

        $done = False;

        while (!$done) {
          $gear2 = eliminateOutliers($gear1);
          $gear1 = eliminateOutliers($gear2);
        }

        $done = False;

        while (!$done) {
          $kpa2 = eliminateOutliers($kpa1);
          $kpa1 = eliminateOutliers($kpa2);
        }

        $done = False;

        while (!$done) {
          $climb2 = eliminateOutliers($climb1);
          $climb1 = eliminateOutliers($climb2);
        }

        $auto = $auto1;
        $gear = $gear1;
        $kpa = $kpa1;
        $climb = $climb1;

        // Take the average of all of those values and then ceil it.
        $flAuto = ceil(array_sum($auto) / count($auto));
        $flGear = ceil(array_sum($gear) / count($gear));
        $flKpa = roundUpToAny(ceil(array_sum($kpa) / count($kpa)));
        $flClimb = ceil(array_sum($climb) / count($climb));

        $rpAuto = 0;
        $rpGear = 0;
        $rpKpa = 0
        $rpClimb = 0;

        switch ($flAuto) {
          case 0:
            $rpAuto = 0;
            break;
          case 1:
            $rpAuto = 0;
            break;
          case 2:
            $rpAuto = 45;
            break;
          case 3:
            $rpAuto = 100;
            break;
        }
        switch ($flGear) {
          case 0:
            $rpGear = -35;
            break;
          case 1:
            $rpGear = -25;
            break;
          case 2:
            $pGear = -15;
            break;
          case 3:
            $rpGear = 0;
            break;
          case 4:
            $rpGear = 15;
            break;
          case 5:
            $rpGear = 25;
            break;
          case 6:
            $rpGear = 35;
            break;
          case 7:
            $rpGear = 45;
            break;
          case 8:
            $rpGear = 55;
            break;
          case 9:
            $rpGear = 65;
            break;
          case 10:
            $rpGear = 75;
            break;
          case 11:
            $rpGear = 85;
            break;
          case 12:
            $rpGear = 95;
            break;
          default:
            $rpGear = 35;
            break;
        }
        switch ($flKpa) {
          case 0:
            $rpKpa = -5;
            break;
          case 5:
            $rpKpa = 0;
            break;
          case 10:
            $rpKpa = 5;
            break;
          case 15:
            $rpKpa = 10;
            break;
          case 20:
            $rpKpa = 15;
            break;
          case 25:
            $rpKpa = 20;
            break;
          case 30:
            $rpKpa = 25;
            break;
          case 35:
            $rpKpa = 30;
            break;
          case 40:
            $rpKpa = 35;
            break;
          case 45:
            $rpKpa = 40;
            break;
          default:
            $rpKpa = 15;
            break;
        }
        switch ($flClimb) {
          case 0:
            $rpClimb = -50;
            break;
          case 1:
            $rpClimb = 50;
            break;
          default:
            $rpClimb = 50;
            break;
        }

        $total = $rpAuto + $rpGear + $rpKpa + $rpClimb;
        $finalQuery = "INSERT INTO ranking (Team, ScoutPoints) VALUES ('$team', '$total')"

        $finalResult = mysql_query($finalQuery);
      }
      echo "<meta http-equiv='refresh' content=../scouting/viewRawList.php />";
      echo "<script> window.location.replace('../scouting/viewRawList.php')</script>";
    } else {
      echo "<meta http-equiv='refresh' content=../scouting/genList.php />";
      echo "<script> window.location.replace('../scouting/genList.php')</script>";
    }
    ?>
