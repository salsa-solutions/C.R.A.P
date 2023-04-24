<?php


require_once('/var/www/html/config.php');
require_once('/var/www/html/pages/page-index.php');
require_once('/var/www/html/php/functions/permissons.php');
require_once('/var/www/html/php/functions/userPermissions.php');
require_once('/var/www/html/php/functions/userId.php');
require_once('/var/www/html/php/functions/time.php');
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="
    https://cdn.jsdelivr.net/npm/notiflix/dist/notiflix-3.2.5.min.js
"></script>
    <link href="
https://cdn.jsdelivr.net/npm/notiflix/dist/notiflix-3.2.5.min.css
" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

        <div class="messages-container">
            <h2>Messages</h2>
            <?php
            // Connect to the database
            $pdo = $db;

            // Retrieve messages from the database
            $stmt = $pdo->query("SELECT * FROM messages ORDER BY id ASC");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='message-box'><strong>{$row['name']}</strong> <small>({$row['date']})</small>:<br> {$row['message']}</div>";
            }
            if ($stmt->rowCount() == 0) {
                echo "<p>No messages</p>";
            }
            ?>
        </div>
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
                $stmt = $pdo->query("SELECT * FROM availability ORDER BY id ASC");
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
        <br>
        <br>
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
                $stmt = $pdo->query("SELECT * FROM wanted_days ORDER BY id ASC");
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
        </div>
        <br>
        <div class="shift-container">
            <h2>Add Shifts</h2>
            <form>
                <div class="form-group row">
                    <label for="day" class="col-sm-2 col-form-label">Day:</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="day" id="day">
                            <option value="monday">Monday</option>
                            <option value="tuesday">Tuesday</option>
                            <option value="wednesday">Wednesday</option>
                            <option value="thursday">Thursday</option>
                            <option value="friday">Friday</option>
                            <option value="saturday">Saturday</option>
                            <option value="sunday">Sunday</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="start_time" class="col-sm-2 col-form-label">Start Time:</label>
                    <div class="col-sm-10">
                        <input type="time" class="form-control" id="start-time" name="start-time">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="end_time" class="col-sm-2 col-form-label">End Time:</label>
                    <div class="col-sm-10">
                        <input type="time" class="form-control" id="end-time" name="end-time">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="employee_max" class="col-sm-2 col-form-label">Max Employees:</label>
                    <div class="col-sm-4">
                        <input type="number" class="form-control" id="employee-max" name="employee-max">
                    </div>
                    <label for="employee_type" class="col-sm-2 col-form-label">Employee Type:</label>
                    <div class="col-sm-4">
                        <select class="form-control" id="role-name" name="role-name">
                            <option value="full-time">Full Time</option>
                            <option value="part-time">Part Time</option>
                            <option value="contractor">Contractor</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" id="submit-shifts" class="btn btn-primary">Add Shift</button>
                    </div>
                </div>
            </form>
        </div>

        <script>
            $(function() {
                $('#submit-shifts').click(function(e) {

                    var valid = this.form.checkValidity();

                    if (valid) {


                        var uuid = "<?php echo $uuid; ?>";
                        var name = "<?php echo $name; ?>";
                        var username = "<?php echo $username; ?>";
                        var start_time = $('#start-time').val();
                        var end_time = $('#end-time').val();
                        var employee_max = $('#employee-max').val();
                        var role_name = $('#role-name').val();
                        var day = $('#day').val();
                        // var hours = $('#hours').val();
                        // console.log(hours);
                        $.ajax({
                            url: '/php/db_handling/handling/add_shift.php',
                            type: 'POST',
                            data: {
                                uuid: uuid,
                                name: name,
                                username: username,
                                start_time: start_time,
                                end_time: end_time,
                                employee_max: employee_max,
                                role_name: role_name,
                                day: day
                                // hours: hours
                            },
                            success: function(data) {
                                if (data === "100") {

                                    Notiflix.Notify.success('Your request has been submited');
                                }
                                if (data === "200") {
                                    Notiflix.Notify.failure(
                                        'There were erros while saving the data, Error:' + data);
                                }
                                if (data === "300") {
                                    Notiflix.Notify.failure(
                                        'No Data, Error:' + data);
                                }
                            },
                            error: function(data) {
                                Notiflix.Notify.failure('Somthings not right, Error:' + data);
                            }
                        });
                    }
                });
            });
        </script>


    <?php
    }
    require("/var/www/html/php/template.php");
    echo $footer;
    ?>