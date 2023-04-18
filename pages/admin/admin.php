<?php


require_once('/var/www/html/config.php');
require_once('/var/www/html/pages/page-index.php');
require_once('/var/www/html/php/functions/permissons.php');
require_once('/var/www/html/php/functions/userPermissions.php');
require_once('/var/www/html/php/functions/userId.php');
// to turn off a page uncomment the following line:
// $_DEV = true;

session_start();
$session_id = session_id();
if (!isset($session_id) || !isset($_SESSION['name']) && !isset($_SESSION['username']) && !isset($_SESSION['role']) && !isset($_SESSION['role_name']) && !isset($_SESSION['uid'])) {
    header('Location: ' . $login_page_url . '');
}

$name = $_SESSION['name'];
$username = $_SESSION['username'];
$role = $_SESSION['role'];
$role_name = $_SESSION['role_name'];
$uid = $_SESSION['uid'];

$WEB_TITLE = 'Manager Home';


setAccessPages($role);

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

    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        .availability-box {
            float: left;
            width: 48%;
            margin-right: 2%;
        }

        .wanted-days-box {
            float: right;
            width: 48%;
        }
    </style>


    <!-- <?php echo $userId = getUserId($db, $username); ?> -->
    <?php require("/var/www/html/php/template.php");
    echo $header ?>
    <?php if (($_DEV) && (($role == 'employee') || ($role == 'manager')) == '1') {
        echo $out_of_service;
    } elseif (($role == 'employee')) {
        echo $fourohthree;
    } elseif (($role == 'pending')) {
        echo $pending;
    } else {
    ?>

        <h1>Manager Portal</h1>

        <h2>Messages</h2>
        <?php
        // Connect to the database
        $pdo = $db;

        // Retrieve messages from the database
        $stmt = $pdo->query("SELECT * FROM messages ORDER BY date DESC");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<p><strong>{$row['name']}</strong> ({$row['date']}): {$row['message']}</p>";
        }
        if ($stmt->rowCount() == 0) {
            echo "<p>No messages</p>";
        }
        ?>
        <br>
        <br>
        <br>
        <div class="availability-box">
            <h2>Availability</h2>
            <table>
                <tr>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Monday</th>
                    <th>Tuesday</th>
                    <th>Wednesday</th>
                    <th>Thursday</th>
                    <th>Friday</th>
                    <th>Saturday</th>
                </tr>
                <?php
                // Retrieve availability from the database
                $stmt = $pdo->query("SELECT * FROM availability ORDER BY date DESC");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>{$row['date']}</td>";
                    echo "<td>{$row['name']}</td>";
                    echo "<td>{$row['monday']}</td>";
                    echo "<td>{$row['tuesday']}</td>";
                    echo "<td>{$row['wednesday']}</td>";
                    echo "<td>{$row['thursday']}</td>";
                    echo "<td>{$row['friday']}</td>";
                    echo "<td>{$row['saturday']}</td>";
                    echo "</tr>";
                }
                if ($stmt->rowCount() == 0) {
                    echo "<tr><td colspan=\"8\">No availability found</td></tr>";
                }
                ?>
            </table>
        </div>

        <div class="wanted-days-box">
            <h2>Wanted Days</h2>
            <table>
                <tr>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Monday</th>
                    <th>Tuesday</th>
                    <th>Wednesday</th>
                    <th>Thursday</th>
                    <th>Friday</th>
                    <th>Saturday</th>
                </tr>
                <?php
                // Retrieve availability from the database
                $stmt = $pdo->query("SELECT * FROM wanted_days ORDER BY date DESC");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>{$row['date']}</td>";
                    echo "<td>{$row['name']}</td>";
                    echo "<td>{$row['monday']}</td>";
                    echo "<td>{$row['tuesday']}</td>";
                    echo "<td>{$row['wednesday']}</td>";
                    echo "<td>{$row['thursday']}</td>";
                    echo "<td>{$row['friday']}</td>";
                    echo "<td>{$row['saturday']}</td>";
                    echo "</tr>";
                }
                if ($stmt->rowCount() == 0) {
                    echo "<tr><td colspan=\"8\">No prefered days found</td></tr>";
                }
                ?>
            </table>

        <?php
    }
    require("/var/www/html/php/template.php");
    echo $footer;
        ?>