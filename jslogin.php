<?php
session_start();
require_once('config.php');

$username = $_POST['username'];
$password = sha1($_POST['password']);
// echo $password;
$sql = "SELECT * FROM users WHERE username = ? AND password = ? LIMIT 1";
$stmtselect  = $db->prepare($sql);

$result = $stmtselect->execute([$username, $password]);
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