<?php
require_once('/var/www/html/config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php
  if(isset($_POST)){
    $id                = $_POST['uuid'];
    $role              = $_POST['role'];
    
    $sql = "UPDATE users SET role='$role', active=true WHERE uuid='$id'";
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