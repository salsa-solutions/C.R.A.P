<?php
  $db_user = "tibthink";
  $db_pass = "halsnewram";
  $db_name = "crap_useraccount";
  
  $db = new PDO('mysql:host=localhost;dbname=' . $db_name . ';charset=utf8', $db_user, $db_pass);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>