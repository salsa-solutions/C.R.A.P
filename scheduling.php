<?php
session_start();
require_once('config.php');

if (!isset($_SESSION['userlogin'])) {
    header("Location: login.php");
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION);
    header("Location: login.php");
}
$user = $_SESSION['userlogin'][0];
$role = $_SESSION['userlogin'][1];
if ($role == 'admin') {
} else {
    header("Location: index.php");
}
$WEB_TITLE = 'Scheduling';


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
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="/css/scheduling.css">
    <title><?php echo $WEB_TITLE ?> | Capriotti's Regional Attendance Program</title>

</head>

<body>
    <div class="nav">
        <ul>
            <div class="nav-links">
                <li><a href="/index.php">Home</a></li>
                <li><a href="/schedule.php">Schedule</a></li>
                <?php
                if ($role == 'admin') {
                    echo '<li><a href="/admin.php">Admin</a></li>';
                    echo '<li><a href="/scheduling.php">Scheduling</a></li>';
                }
                ?>

            </div>
            <div class="mt-2 ">
                <button type="button" name="button" id="logOut" class="btn btn_logout">Log Out</button>
            </div>
        </ul>
    </div>
    <div class="container">

        <?php
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
                
	    	include('config.php');
	    	$result = $db->prepare("SELECT name FROM avil_day ORDER BY date DESC");
	    	$result->execute();
	    	for ($i = 0; $row = $result->fetch(); $i++) {
                $name = $row['name'];
		?>

        <div class="grid">
            <div class="content">
                <p><?php echo $name; ?></p>
            </div>
            <div class="content">
                <input class="input-group input-group-append " type="text" placeholder="One">
            </div>
            <div class="content">
                <input class="input-group input-group-append " type="text" placeholder="One">
            </div>
            <div class="content">
                <input class="input-group input-group-append " type="text" placeholder="One">
            </div>
            <div class="content">
                <input class="input-group input-group-append " type="text" placeholder="One">
            </div>
            <div class="content">
                <input class="input-group input-group-append " type="text" placeholder="One">
            </div>
            <div class="content">
                <input class="input-group input-group-append " type="text" placeholder="One">
            </div>
            <div class="content">
                <input class="input-group input-group-append " type="text" placeholder="One">
            </div>

        </div>
        <?php
			}
							if ($i == 0) {
								echo '<td colspan="8">No new messages</td>';
							}
        ?>




        
    </div>

    <script>
        $(function() {
            $('#logOut').click(function() {
                window.location.href = "logout.php?logout=true";
            })
        });
    </script>
    <div class="footer">
        <footer>
            <p>You are logged in as: <?php echo $user; ?> </p>
        <p>Role: <?php echo $role; ?> </p>
        </footer>
    </div>
</body>

</html>