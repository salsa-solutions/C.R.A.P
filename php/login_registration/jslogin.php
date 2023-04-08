<?php
// show error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

function getUserIpAddr()
{
  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    //ip from share internet
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    //ip pass from proxy
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  } else {
    $ip = $_SERVER['REMOTE_ADDR'];
  }
  return $ip;
}

session_start();
require_once('/var/www/html/config.php');

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username = ? LIMIT 1";
$stmtselect  = $db->prepare($sql);

$result = $stmtselect->execute([$username]);

if ($stmtselect->errorCode() != "00000") {
    $errorInfo = $stmtselect->errorInfo();
    echo "Error executing statement: {$errorInfo[2]}";
    exit;
}

if ($result) {
    $user = $stmtselect->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['userlogin'] = [$user['firstname'] . ' ' . $user['lastname'], $user['role'], $username];
		echo "1";
        $currentDate = new DateTime();
        $date = $currentDate->format('Y-m-d H:i:s');
        $ip = getUserIpAddr();
        $sql = "INSERT INTO succesful_logins (date, username, name, ip) VALUES (?, ?, ?, ?)";
        $stmtinsert = $db->prepare($sql);
        $result = $stmtinsert->execute([$date, $username, $user['firstname'] . ' ' . $user['lastname'], $ip]);

        if (!$result) {
            $errorInfo = $stmtinsert->errorInfo();
            echo "Error inserting successful login: {$errorInfo[2]}";
            exit;
        }
    } else {
        $currentDate = new DateTime();
        $date = $currentDate->format('Y-m-d H:i:s');
        $ip = getUserIpAddr();
        $sql = "INSERT INTO unsuccesful_logins (date, username, name, ip) VALUES (?, ?, ?, ?)";
        $stmtinsert = $db->prepare($sql);
        $result = $stmtinsert->execute([$date, $username, $user['firstname'] . ' ' . $user['lastname'], $ip]);

        if (!$result) {
            $errorInfo = $stmtinsert->errorInfo();
            echo "Error inserting unsuccessful login: {$errorInfo[2]}";
            exit;
        }
    }
} else {
	// handle error for the case where no user is found with the given username
	$currentDate = new DateTime();
	$date = $currentDate->format('Y-m-d H:i:s');
	$ip = getUserIpAddr();
	$sql = "INSERT INTO unsuccesful_logins (date, username, name, ip) VALUES (?, ?, ?, ?)";
	$stmtinsert = $db->prepare($sql);
	$result = $stmtinsert->execute([$date, $username, '', $ip]);
	
	if (!$result) {
	$errorInfo = $stmtinsert->errorInfo();
	echo "Error inserting unsuccessful login: {$errorInfo[2]}";
	exit;
	}
	echo "Invalid login credentials. Please try again.";
	exit;
	}
