<?php
  // whole site debug mode
  // all pages will not work if user isnt Admin 
  $_DEV = true;
  $_DEV_DB = false;
  $WEBSITE_NAME = 'Greek Star Attendance Program';
  $db_user = "tibthink";
  $db_pass = "Halsnewram";
  if($_DEV_DB){
    $db_name = "gs_useraccounts_beta";
  }else{
    $db_name = "gs_useraccounts";
  }
  
  
  $db = new PDO('mysql:host=localhost;dbname=' . $db_name . ';charset=utf8', $db_user, $db_pass);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  



?>
