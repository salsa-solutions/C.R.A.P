<?php

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

?>

<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	require_once('../../config.php');
	$username = $_POST['username'];	
//	$username = 'macifoe';

	// selecting name from database by username
	$sql = "SELECT firstname, lastname, roll, approved FROM users WHERE username = ? LIMIT 1";
	$stmtselect  = $db->prepare($sql);
	$result = $stmtselect->execute([$username]);
	$user = $stmtselect->fetch(PDO::FETCH_ASSOC);
//	echo '<pre>'; print_r($user); echo '</pre>';
	if($user){
		$name = $user['firstname'] . ' ' . $user['lastname'];
		$roll = $user['roll'];
		$status = $user['approved'];
	}else{
		$name = 'Guest';
		$roll = 'Guest';
	}
?>


<?php

session_start();
require_once('../../config.php');

$username = $_POST['username'];
$password = sha1($_POST['password']);
// echo $password;
$sql = "SELECT * FROM users WHERE username = ? AND password = ? LIMIT 1";
$stmtselect  = $db->prepare($sql);

$result = $stmtselect->execute([$username, $password]);
// echo $result;

if($result){
	// $user = $stmtselect->fetch(PDO::FETCH_ASSOC);
	if($stmtselect->rowCount() > 0){
		$_SESSION['userlogin'] = [$name, $roll, $username, $status];
		echo '1';
		$currentDate = new DateTime();
		$date = $currentDate->format('Y-m-d H:i:s');
		$ip = getUserIpAddr();
		$sql = "INSERT INTO succesful_logins (date, username, name, ip ) VALUES(?,?,? ,?)";
        $stmtinsert = $db->prepare($sql);
		$result = $stmtinsert->execute([ $date, $username, $name, $ip]);

        

	}else{
		echo 'Ha, I really hope you didnt forget your password';
		$currentDate = new DateTime();
		$date = $currentDate->format('Y-m-d H:i:s');
		$ip = getUserIpAddr();
		$sql = "INSERT INTO unsuccesful_logins (date, username, name, ip ) VALUES(?,?,? ,?)";
		$stmtinsert = $db->prepare($sql);
		$result = $stmtinsert->execute([ $date, $username, $name, $ip]);
	}
}else{
	echo 'There were errors while connecting to database.';
}
?>