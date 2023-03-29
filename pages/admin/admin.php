<?php

session_start();
require_once('/var/www/html/config.php');
require_once('/var/www/html/pages/page-index.php');
require_once('/var/www/html/php/functions/navPage.php');
require_once('/var/www/html/php/functions/userPermissions.php');
require_once('/var/www/html/php/functions/userId.php');
// to turn off a page uncomment the following line:
// $_DEV = true;

if (!isset($_SESSION['userlogin'])) {
    header('Location: login.php');
}

$name = $_SESSION['userlogin'][0];
$role = $_SESSION['userlogin'][1];
$username = $_SESSION['userlogin'][2];
$status = $_SESSION['userlogin'][3];
$WEB_TITLE = 'Manager Home';


setAccessPages($role);

echo $userId = getUserId($db, $username);
print_r(getUserPermissions($db, $userId)) ;

// if(($role != 'Manager' || $role != 'Admin')){
//     header("Location: /index.php");
// }

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/css/home.css">
    <link rel="stylesheet" href="/css/admin.css">
    <link rel="stylesheet" href="/css/scrollbar.css">
    <link rel="stylesheet" href="/css/nav.css">
    <title><?php echo $WEB_TITLE ?> | <?php echo $WEBSITE_NAME; ?></title>

</head>

<body>
    <!-- <?php echo $userId = getUserId($db, $username); ?> -->
    <?php require("/var/www/html/php/template.php");
    echo $header ?>
    <?php if (($_DEV) && (($role == 'Server') || ($role == 'Manager') || ($role == 'Cook')) == '1') {
        echo $out_of_service;
    } elseif (($role == 'Server')) {
        echo $fourohthree;
    } elseif (($status == 'pending')) {
        echo $pending;
    } else {
    ?>

<div class="container">
    <div class="row">
      <div class="col-md-8">
        <h2>Message Board</h2>
        <?php
          // Create a new PDO object
          $pdo = $db;

          // Prepare a SQL statement to retrieve messages from the message board
          $stmt = $pdo->prepare("SELECT name, date, message FROM sr ORDER BY date DESC");

          // Execute the prepared statement
          $stmt->execute();

          // Display the messages in a table
          echo "<table class='table'>";
          echo "<thead><tr><th>Name</th><th>Date</th><th>Message</th></tr></thead>";
          echo "<tbody>";
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr><td>" . $row['name'] . "</td><td>" . $row['date'] . "</td><td>" . $row['message'] . "</td></tr>";
          }
          echo "</tbody></table>";
        ?>
      </div>
      <div class="col-md-4">
        <h2>Availability</h2>
        <div class="availability-box">
          <?php
            // Retrieve availability information from the database
            $stmt = $pdo->prepare("SELECT * FROM avil_day");

            // Execute the prepared statement
            $stmt->execute();

            // Display the availability information
            echo "<ul>";
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              echo "<li>" . $row['monday'] . ": " . $row['tuesday'] . "</li>";
            }
            echo "</ul>";
          ?>
        </div>
        <h2>Wanted Days</h2>
        <div class="wanted-days-box">
          <?php
            // Retrieve wanted days information from the database
            $stmt = $pdo->prepare("SELECT * FROM wanted_days");

            // Execute the prepared statement
            $stmt->execute();

            // Display the wanted days information
            echo "<ul>";
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              echo "<li>" . $row['day'] . "</li>";
            }
            echo "</ul>";
          ?>
        </div>
      </div>
    </div>
  </div>
        
        <!-- menu that approves users -->

    <?php
    }
    require("/var/www/html/php/template.php");
    echo $footer;
    ?>