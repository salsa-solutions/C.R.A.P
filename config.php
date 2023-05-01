<?php

//show errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// whole site debug mode
// all pages will not work if user isnt Admin 
$_DEV = false;
$_DEV_DB = false;
$WEBSITE_NAME = 'Greek Star Attendance Program';
$db_user = "tibthink";
$db_pass = "Halsnewram";
if($_DEV_DB){
  $db_name = "beta_churro_useraccounts";
  $log_db_name = "beta_churro_useraccounts_logs";
}else{
  $db_name = "churro_useraccounts";
  $log_db_name = "churro_useraccounts_logs";
}


$db = new PDO('mysql:host=localhost;dbname=' . $db_name . ';charset=utf8', $db_user, $db_pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$log_db = new PDO('mysql:host=localhost;dbname=' . $log_db_name . ';charset=utf8', $db_user, $db_pass);
$log_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);