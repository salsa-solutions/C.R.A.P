<?php
session_start();
require_once('config.php');

if (!isset($_SESSION['userlogin'])) {
    header("Location: login.php");
}

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION);
    header("Location: login.php");
}
$name = $_SESSION['userlogin'][0];
$role = $_SESSION['userlogin'][1];
$username = $_SESSION['userlogin'][2];
$WEB_TITLE = 'Admin';
$_DEV = false;
if ( ($role == 'admin') || ($role == 'manager')) {
    $admin_page='<li><a href="/admin.php">Admin</a></li>';
    $scheduling_page='<li><a href="/scheduling.php">Scheduling</a></li>';
}
else {
    $admin_page= NULL;
    $scheduling_page= NULL;
}
if ($role == 'admin') {
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
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/scrollbar.css">
    <title><?php echo $WEB_TITLE ?> | Capriotti's Regional Attendance Program</title>

</head>

<body>

    <?php
    include('php/template.php');
    echo $header


    ?>

    <div class="message_container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Messages</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Message</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // ini_set('display_errors', 1);
                                // ini_set('display_startup_errors', 1);
                                // error_reporting(E_ALL);
                                
								include('config.php');
								$result = $db->prepare("SELECT date, name, message FROM sp ORDER BY date DESC");
								$result->execute();
								for ($i = 0; $row = $result->fetch(); $i++) {
							?>

                                <td><?php echo $row['date']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['message']; ?></td>
                            </tbody>
                            <?php
							}
							if ($i == 0) {
								echo '<td colspan="8">No new messages</td>';
							}
					?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="avil_schedule_container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Availability</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Monday</th>
                                    <th scope="col">Tuesday</th>
                                    <th scope="col">Wednesday</th>
                                    <th scope="col">Thursday</th>
                                    <th scope="col">Friday</th>
                                    <th scope="col">Saturday</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // ini_set('display_errors', 1);
                                // ini_set('display_startup_errors', 1);
                                // error_reporting(E_ALL);
                                
								include('config.php');
								$result = $db->prepare("SELECT date, name, monday, tuesday, wednesday, thursday, friday, saturday FROM avil_day ORDER BY date DESC");
								$result->execute();
								for ($i = 0; $row = $result->fetch(); $i++) {
							?>

                                <td><?php echo $row['date']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['monday']; ?></td>
                                <td><?php echo $row['tuesday']; ?></td>
                                <td><?php echo $row['wednesday']; ?></td>
                                <td><?php echo $row['thursday']; ?></td>
                                <td><?php echo $row['friday']; ?></td>
                                <td><?php echo $row['saturday']; ?></td>
                            </tbody>
                            <?php
							}
							if ($i == 0) {
								echo '<td colspan="8">No schedules</td>';
							}
					?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pref_schedule_container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Wanted days</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Monday</th>
                                    <th scope="col">Tuesday</th>
                                    <th scope="col">Wednesday</th>
                                    <th scope="col">Thursday</th>
                                    <th scope="col">Friday</th>
                                    <th scope="col">Saturday</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // ini_set('display_errors', 1);
                                // ini_set('display_startup_errors', 1);
                                // error_reporting(E_ALL);
                                
								include('config.php');
								$result = $db->prepare("SELECT date, name, monday, tuesday, wednesday, thursday, friday, saturday FROM pref_day ORDER BY date DESC");
								$result->execute();
								for ($i = 0; $row = $result->fetch(); $i++) {
							?>

                                <td><?php echo $row['date']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['monday']; ?></td>
                                <td><?php echo $row['tuesday']; ?></td>
                                <td><?php echo $row['wednesday']; ?></td>
                                <td><?php echo $row['thursday']; ?></td>
                                <td><?php echo $row['friday']; ?></td>
                                <td><?php echo $row['saturday']; ?></td>
                            </tbody>
                            <?php
							}
							if ($i == 0) {
								echo '<td colspan="8">No schedules</td>';
							}
					?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php
include('php/template.php');
echo $footer;
?>