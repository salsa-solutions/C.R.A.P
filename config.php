<?php
  $db_user = "tibthink";
  $db_pass = "Halsnewram";
  $db_name = "crap_useraccount";
  
  $db = new PDO('mysql:host=localhost;dbname=' . $db_name . ';charset=utf8', $db_user, $db_pass);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  // whole site debug mode
  // all pages will not work if user isnt admin 
  // $_DEV = TRUE;


?>
