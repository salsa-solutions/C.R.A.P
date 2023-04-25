<?php
require_once('/var/www/html/config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php
  session_start();
  if(isset($_POST)){
    $uuid              = $_POST['uuid'];
    $role              = $_POST['role'];
    $role_name         = $_POST['role_name'];
    
    $sql = "UPDATE users SET role='$role', role_name='$role_name' WHERE uuid='$uuid'";
    $stmtinsert = $db->prepare($sql);
    $result = $stmtinsert->execute();
    if ($result) {
        echo 100;
    } else {
        echo 200;
    }
  }else{
    echo 300;
  }



?>