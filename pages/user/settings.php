<?php
session_start();
require_once('/var/www/html/config.php');
require_once('/var/www/html/pages/page-index.php');
require_once('/var/www/html/php/functions/role_select.php');

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
$WEB_TITLE = 'Home';

// to turn off a site uncomment the following line:
//$_DEV = true;
if (($role == 'Admin')) {
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
}
if (($role == 'Admin') || ($role == 'Manager')) {

  $managment = $managment_page;
  $Admin_page = $admin_page;
  $scheduling_page = $scheduling_page;
  $approval = $approval_page;
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
  <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="/css/home.css">
  <link rel="stylesheet" href="/css/nav.css">
  <link rel="stylesheet" href="/css/settings.css">
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
      <br>
    </div>
    <?php
    if ($role == 'Admin' || $role == 'Manager') {

    ?>
      <div class="settings">
        <h2>Manage Users</h2>
        <h3>Update User Information</h3>
        <form>
          <label for="user">Select User:</label>
          <td id="user_selection">
            <label for="user"></label>
            <select id="user" name="user">
              <?php
              include('/var/www/html/config.php');
              $result = $db->prepare("SELECT id, firstname, lastname, username, role FROM users ORDER BY lastname ASC");
              $result->execute();
              for ($i = 0; $row = $result->fetch(); $i++) {
                if ($row['role'] != 'Admin') {
              ?>
                  <option value="<?php echo $row['id']; ?>"> <?php echo $row['firstname'] . ' ' .  $row['lastname'] . ' - ' . $row['role']; ?> </option>
                <?php

                } elseif ($row['role'] == 'Admin' && $role == 'Admin') {
                ?>
                  <option value="<?php echo $row['id']; ?>"> <?php echo $row['firstname'] . ' ' .  $row['lastname'] . ' - ' . $row['role']; ?> </option>
                <?php
                } else {
                ?>
                  <option value="<?php echo $row['id']; ?>" disabled> <?php echo $row['firstname'] . ' ' .  $row['lastname'] . ' - ' . $row['role']; ?> </option>
              <?php
                }
              }
              ?>
            </select>
          </td>
          <label for="username">Username:</label>
          <input type="text" id="username" name="username">
          <br>
          <label for="email">Email:</label>
          <input type="email" id="email" name="email">
          <br>

          <label for="role">Role:</label>
          <td id="role_selection">
            <label for="role"></label>
            <select id="role" name="role">
              <?php echo getRoles($db, $role); ?>
            </select>
          </td>
          <br>
          <label for="status">Status:</label>
          <select id="status" name="status">
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
          </select>
          <br>
          <button class="button" type="submit" id="<?php echo $row['id']; ?>_update_user">Save Changes</button>
        </form>

        <h3>Add New User</h3>
        <form>
          <label for="firstname">First Name:</label>
          <input type="text" id="firstname" name="firstname">
          <br>
          <label for="lastname">Last Name:</label>
          <input type="text" id="lastname" name="lastname">
          <br>
          <label for="username">Username:</label>
          <input type="text" id="username" name="username">
          <br>
          <label for="email">Email:</label>
          <input type="email" id="email" name="email">
          <br>
          <label for="role">Role:</label>
          <td id="role_selection">
            <label for="role"></label>
            <select id="role" name="role">
              <?php echo getRoles($db, $role); ?>
            </select>
          </td>
          <br>
          <label for="status">Status:</label>
          <select id="status" name="status">
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
          </select>
          <br>
          <button class="button" type="submit" id="add_user">Add User</button>
        </form>
        <!-- create adding role menu -->
        <h3>Add New Role</h3>
        <form>
          <label for="role">Role:</label>
          <input type="text" id="role" name="role">
          <br>
          <label for="role">Role Description:</label>
          <input type="text" id="role_description" name="role_description">
          <br>
          <button class="button" type="submit" id="add_role">Add Role</button>

      </div>
      </div>
    <?php
    }
    ?>


  </body>


<?php
}



require("/var/www/html/php/template.php");
echo $footer ?>

</html>