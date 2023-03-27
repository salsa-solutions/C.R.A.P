<?php

session_start();
require_once('/var/www/html/config.php');
require_once('/var/www/html/pages/page-index.php');
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


if ( ($role == 'Admin') || ($role == 'Manager')) {
    
    $managment = $managment_page;
    $Admin_page= $admin_page;
    $scheduling_page= $scheduling_page;
	$approval = $approval_page;
}
else {
    $managment = NULL;
    $Admin_page= NULL;
    $scheduling_page= NULL;
    $approval = NULL;
}
if (($role == 'Admin')) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
} elseif ($role == 'Manager') {
} else {
    header("Location: index.php");
}

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
    <!-- <link rel="stylesheet" href="/css/admin.css"> -->
    <link rel="stylesheet" href="/css/scrollbar.css">
    <link rel="stylesheet" href="/css/nav.css">
    <link rel="stylesheet" href="css/test.css">
    <title><?php echo $WEB_TITLE ?> | <?php echo $WEBSITE_NAME; ?></title>

</head>

<body>
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

<body>
<style>
        /* Set default font and color */
        body {
            font-family: Arial, sans-serif;
            color: #333;
        }
        /* Create container for messages and availability */
        .container {
            display: flex;
            align-items: flex-start;
        }
        /* Style for messages section */
        .messages {
            width: 30%;
            margin-right: 20px;
        }
        .messages h2 {
            margin-top: 0;
        }
        .messages ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .messages li {
            margin-bottom: 10px;
            padding: 10px;
            background-color: #f2f2f2;
        }
        /* Style for availability section */
        .availability {
            flex: 1;
        }
        .availability h2 {
            margin-top: 0;
        }
        .availability table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }
        .availability th, .availability td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .availability th {
            background-color: #f2f2f2;
        }
    </style>
    <div class="container">
        <div class="messages">
            <h2>Messages</h2>
            <ul>
                <li>Message 1</li>
                <li>Message 2</li>
                <li>Message 3</li>
            </ul>
        </div>
        <div class="availability">
            <h2>Availability</h2>
            <table>
                <thead>
                    <tr>
                        <th>Day</th>
                        <th>Wanted</th>
                        <th>Availability</th>
                    </tr>
                </thead>
                <thead>
                    <tr>
                        <th>Day</th>
                        <th>Wanted</th>
                        <th>Availability</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Monday</td>
                        <td>8am - 5pm</td>
                        <td>Available</td>
                    </tr>
                    <tr>
                        <td>Tuesday</td>
                        <td>8am - 5pm</td>
                        <td>Available</td>
                    </tr>
                    <tr>
                        <td>Wednesday</td>
                        <td>8am - 5pm</td>
                        <td>Not Available</td>
                    </tr>
                    <tr>
                        <td>Thursday</td>
                        <td>8am - 5pm</td>
                        <td>Available</td>
                    </tr>
                    <tr>
                        <td>Friday</td>
                        <td>8am - 5pm</td>
                        <td>Available</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

    <?php
    }
    require("/var/www/html/php/template.php");
    echo $footer;
    ?>