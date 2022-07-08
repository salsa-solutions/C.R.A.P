<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

session_start();
require_once('config.php');

$username = $_POST['username'];
$password = sha1($_POST['password']);
// echo $username;
$sql = "SELECT * FROM users WHERE username = ? AND password = ? LIMIT 1";
$stmtselect  = $db->prepare($sql);

// $name_sql = "SELECT `firstname`, `lastname` FROM `crap_useraccount`.`users`";
// echo $name_sql;
// $name_stmtselect  = $db->prepare($name_sql);

// echo $name_stmtselect;
$result = $stmtselect->execute([$username, $password]);
// $name_result = $name_stmtselect->execute();
echo $name_result;
// echo $result;

if($result){
	$user = $stmtselect->fetch(PDO::FETCH_ASSOC);
	if($stmtselect->rowCount() > 0){
		// echo $_SESSION['userlogin'];
		
		$_SESSION['userlogin'] = $username;
		// echo $_SESSION['userlogin'];
		echo '1';
	}else{
		echo 'Incorrect Login';		
	}
}else{
	echo 'There were errors while connecting to database.';
}