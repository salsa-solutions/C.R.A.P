<?php


require_once('/var/www/html/config.php');
require_once('/var/www/html/pages/page-index.php');
require_once('/var/www/html/php/functions/permissons.php');
require_once('/var/www/html/php/functions/userPermissions.php');
require_once('/var/www/html/php/functions/userId.php');
require_once('/var/www/html/php/functions/time.php');
require_once('/var/www/html/php/functions/select.php');
// to turn off a page uncomment the following line:
// $_DEV = true;

session_start();
$session_id = session_id();
if (!isset($session_id) || !isset($_SESSION['name']) && !isset($_SESSION['username']) && !isset($_SESSION['role']) && !isset($_SESSION['role_name']) && !isset($_SESSION['uuid'])) {
    header('Location: ' . $login_page_url . '');
}

$name = $_SESSION['name'];
$username = $_SESSION['username'];
$role = $_SESSION['role'];
$role_name = $_SESSION['role_name'];
$uuid = $_SESSION['uuid'];

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="
    https://cdn.jsdelivr.net/npm/notiflix/dist/notiflix-3.2.5.min.js
"></script>
    <link href="
https://cdn.jsdelivr.net/npm/notiflix/dist/notiflix-3.2.5.min.css
" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/css/home.css">
    <link rel="stylesheet" href="/css/admin/info.css">
    <link rel="stylesheet" href="/css/scrollbar.css">
    <link rel="stylesheet" href="/css/nav.css">
    <title><?php echo $WEB_TITLE ?> | <?php echo $WEBSITE_NAME; ?></title>

</head>

<body>

    <style>

    </style>


    <?php echo $userId = getUserId($db, $username); ?>
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





    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Panel</title>
        <div class="container">
            <!-- Messages Box -->
            <div class="messages">
                <h2>Messages</h2>
                <?php
            // Connect to the database
            $pdo = $db;

            // Retrieve messages from the database
            $stmt = $pdo->query("SELECT * FROM messages ORDER BY id ASC");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='message'><span class='name'>{$row['name']}</span> <span class='timestamp'>[{$row['date']}]</span><p>{$row['message']}</p> <button class='delete-message' id='{$row['id']}' onclick='deleteMessage({$row['id']})'>delete</button></div>";
            }
            if ($stmt->rowCount() == 0) {
                echo "<div class='message'><p>No messages</p></div>";
            }
            ?>

            </div>

            <!-- Add Shift Box -->
            <div class="add-shift">
                <h2>Add Shift</h2>
                <label>Day of the Week:</label>
                <input type="text" />
                <label>Start Time:</label>
                <input type="time" />
                <label>End Time:</label>
                <input type="time" />
                <label>Max Number of Employees:</label>
                <input type="number" />
                <label>Position:</label>
                <select>
                    <option value="Manager">Manager</option>
                    <option value="Cashier">Cashier</option>
                    <!-- Add other positions as required -->
                </select>
            </div>

            <!-- Shifts Box -->
            <!-- Shifts Box -->
            <div class="shifts">
                <style>

                </style>


                <table class="shifts-table">
                    <thead>
                        <tr>
                            <th>Day of the Week</th>
                            <th>Day</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Max Number of Employees</th>
                            <th>Position</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Monday</td>
                            <td>August 23, 2021</td>
                            <td>9:00 AM</td>
                            <td>5:00 PM</td>
                            <td>5</td>
                            <td>Manager</td>
                            <td><button class="edit-btn">Edit</button></td>
                        </tr>
                        <tr>
                            <td>Tuesday</td>
                            <td>August 24, 2021</td>
                            <td>10:00 AM</td>
                            <td>6:00 PM</td>
                            <td>4</td>
                            <td>Cashier</td>
                            <td><button class="edit-btn">Edit</button></td>
                        </tr>
                        <!-- Add other rows as required -->
                    </tbody>
                </table>

            </div>
        </div>

        <script>
        function deleteMessage(id) {
            // Create a new XMLHttpRequest object
            var xhr = new XMLHttpRequest();

            // Set up the request
            xhr.open('POST', '/php/db_handling/handling/delete-message.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            // Set up the data to be sent
            var data = 'id=' + encodeURIComponent(id);

            // Send the request
            xhr.send(data);

            // Handle the response
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Reload the page to update the messages
                    location.reload();
                }
            };
        }
        </script>

</body>


<?php
    }
    require("/var/www/html/php/template.php");
    echo $footer;
    ?>