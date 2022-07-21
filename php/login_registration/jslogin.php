<?php
	// error_reporting(E_ALL);
	// ini_set('display_errors', 1);
	// ini_set('display_startup_errors', 1);
	require_once('../../config.php');
	$username = $_POST['username'];	
	// $username = 'macifoe';

	// selecting name from database by username
	$sql = "SELECT firstname, lastname, roll FROM users WHERE username = ? LIMIT 1";
	$stmtselect  = $db->prepare($sql);
	$result = $stmtselect->execute([$username]);
	$user = $stmtselect->fetch(PDO::FETCH_ASSOC);
	// echo '<pre>'; print_r($user); echo '</pre>';
	$name = $user['firstname'] . ' ' . $user['lastname'];
	$roll = $user['roll'];

	// echo $name;
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
		$_SESSION['userlogin'] = [$name, $roll, $username];
		echo '1';
	}else{
		echo 'Incorrect Login';		
	}
}else{
	echo 'There were errors while connecting to database.';
}
?>


