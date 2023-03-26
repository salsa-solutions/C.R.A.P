<?php
session_start();
require_once('/var/www/html/config.php');

if (!isset($_SESSION['userlogin'])) {
    header("Location: /pages/login/login.php");
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION);
    header("Location: /pages/login/login.php");
}
$name = $_SESSION['userlogin'][0];
$role = $_SESSION['userlogin'][1];
$username = $_SESSION['userlogin'][2];
$status = $_SESSION['userlogin'][3];
$WEB_TITLE = 'PLACE TITLE HERE';

// to turn off a site uncomment the following line:
//$_DEV = true;
if (($role == 'Admin')) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}
if (($role == 'Admin') || ($role == 'Manager')) {
    $managment = 'Management';
    $Admin_page = '<a href="/admin.php">Admin</a>';
    $scheduling_page = '<a href="/scheduling.php">Scheduling</a>';
    $approval = '<a href="/approval.php">Approval</a>';
} else {
    $managment = NULL;
    $Admin_page = NULL;
    $scheduling_page = NULL;
    $approval = NULL;
}
// echo '<pre>'; print_r($_SESSION['userlogin']); echo '</pre>';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/backround.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/test.css">
    <link rel="stylesheet" href="css/settings.css">
    <title><?php echo $WEB_TITLE; ?> | Capriotti's Regional Attendance Program</title>

</head>
<?php require("/var/www/html/php/template.php");
echo $header ?>
<?php if (($_DEV) && (($role == 'Server') || ($role == 'Manager') || ($role == 'Cook')) == '1') {
    echo $out_of_service;
} elseif (($status == 'pending')) {
    echo $pending;
} else {


?>

    <body>


        <!-- <div class="settings">
  <h1>Settings</h1>
  <form id="change-password-form">
    <h2>Change Password</h2>
    <label for="current-password">Current Password:</label>
    <input type="password" id="current-password" name="current-password">
    <label for="new-password">New Password:</label>
    <input type="password" id="new-password" name="new-password">
    <label for="confirm-password">Confirm New Password:</label>
    <input type="password" id="confirm-password" name="confirm-password">
    <button type="submit">Change Password</button>
  </form>
  <hr>
  <form id="manage-users-form">
    <h2>Manage Users</h2>
    <label for="username">Username:</label>
    <input type="text" id="username" name="username">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email">
    <label for="role">Role:</label>
    <select id="role" name="role">
      <option value="user">User</option>
      <option value="admin">Admin</option>
    </select>
    <label for="status">Status:</label>
    <select id="status" name="status">
      <option value="active">Active</option>
      <option value="inactive">Inactive</option>
    </select>
    <button type="submit">Save Changes</button>
  </form>
</div> -->
<!-- <div class="container"> -->
        <div class="settings">
            <h2>Settings</h2>

            <h3>Change Password</h3>
            <form>
                <label for="current-password">Current Password:</label>
                <input type="password" id="current-password" name="current-password">
                <br>
                <label for="new-password">New Password:</label>
                <input type="password" id="new-password" name="new-password">
                <br>
                <label for="confirm-password">Confirm Password:</label>
                <input type="password" id="confirm-password" name="confirm-password">
                <br>
                <button type="submit">Change Password</button>
            </form>

            <h3>Update User Information</h3>
            <form>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username">
                <br>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email">
                <br>
                <label for="role">Role:</label>
                <select id="role" name="role">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
                <br>
                <label for="status">Status:</label>
                <select id="status" name="status">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
                <br>
                <button type="submit">Update User Information</button>
            </form>
        </div>


    </body>


    <div class="f-container">
        <!-- your page content goes here -->
        <footer>
            <p>You are logged in as: $name </p>
            <p>Role: $role </p>
        </footer>
    </div>


    <!-- <?php
        }



        require("php/template.php");
        echo $footer ?> -->

</html>