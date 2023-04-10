<?php
//show errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('/var/www/html/config.php');


/**
 * Function to check a SQL database for a user who is logging in and check to see if the password is correct or not, using username.
 * Successful and unsuccessful logins are logged into separate SQL databases with date, username used, name if user is found but password incorrect, IP address, and reason why user didn't login of either wrong password, user not found or if neither then system error.
 *
 * @param string $username The username of the user logging in
 * @param string $password The password of the user logging in
 * @param PDO $db The PDO object connected to the SQL database
 *
 * @return boolean True if the user successfully logged in, false otherwise
 */
function checkLogin($username, $password, $db)
{
  // Check if the username exists in the database
  $query = $db->prepare("SELECT * FROM users WHERE username = ?");
  $query->execute([$username]);
  $user = $query->fetch();
  $passwordCorrect = password_verify($password, $user['password']);
  if (!$user) {
    logUnsuccessfulLogin($username, 'Guest', 'User not found', $db);
    return 1;
  } elseif (!$passwordCorrect) {
    logUnsuccessfulLogin($username, $user['name'], 'Wrong password', $db);
    return 2;
  } elseif ($passwordCorrect) {
    logSuccessfulLogin($username, $user['name'], $db);
    return 3;
  } else {
    if ($query->errorCode() != "00000") {
      $errorInfo = $query->errorInfo();
    }
    logUnsuccessfulLogin($username, $user['name'], "System error. Error executing statement: {$errorInfo[2]}", $db);
    return 4;
  }

  // If the user doesn't exist, log the unsuccessful login and return false


  // Check if the password is correct


  // If the password is correct, log the successful login and return true

}

/**
 * Logs an unsuccessful login attempt to the database.
 *
 * @param string $username The username of the user logging in
 * @param string $name The name of the user (if found)
 * @param string $reason The reason for the unsuccessful login
 * @param PDO $db The PDO object connected to the SQL database
 */
function logUnsuccessfulLogin($username, $name, $reason, $db)
{
  $query = $db->prepare("INSERT INTO unsuccessful_logins (date, username, name, ip_address, reason) VALUES (?, ?, ?, ?, ?)");
  $query->execute([date('Y-m-d H:i:s'), $username, $name, $_SERVER['REMOTE_ADDR'], $reason]);
}

/**
 * Logs a successful login attempt to the database.
 *
 * @param string $username The username of the user logging in
 * @param string $name The name of the user
 * @param PDO $db The PDO object connected to the SQL database
 */
function logSuccessfulLogin($username, $name, $db)
{

  $query = $db->prepare("INSERT INTO successful_logins (date, username, name, ip_address) VALUES (?, ?, ?, ?)");
  $query->execute([date('Y-m-d H:i:s'), $username, $name, $_SERVER['REMOTE_ADDR']]);
  return true;
}


session_start();
require_once('/var/www/html/config.php');

$username = $_POST['username'];
$user_password = $_POST['password'];
// echo $user_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
// echo $password;
// $_DEV_DB = true;
// echo $result;
if ($_DEV_DB) {
  echo 'Logging in and sign up are disabled due to maintenance';
} else {
  if ($_POST || $username || $password) {
    $login_code = checkLogin($username, $user_password, $db);

    if ($login_code == 1) {
      echo '1';
    } elseif ($login_code == 2) {
      echo '2';
    } elseif ($login_code == 3) {
      $query = $db->prepare("SELECT * FROM users WHERE username = ?");
      $query->execute([$username]);
      $user = $query->fetch();
      $_SESSION['name'] = $user['name'];
      $_SESSION['username'] = $username;
      $_SESSION['role'] = $user['role'];
      $_SESSION['role_name'] = $user['role_name'];
      $_SESSION['uid'] = $user['uid'];
      echo '3';
    } elseif ($login_code == 4) {
      echo '4';
    } else {
      echo '5';
    }
  }
}
