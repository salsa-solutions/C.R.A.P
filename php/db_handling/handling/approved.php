<?php
require_once('/var/www/html/config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>


<?php
  if(isset($_POST)){
    $id                = $_POST['uuid'];
    
    $sql = "UPDATE users SET active=true WHERE uuid='$id'";
    $stmtinsert = $db->prepare($sql);
    $result = $stmtinsert->execute();
    if ($result) {
        echo 'Successfully saved.';
    } else {
        echo 'There were errors while saving the data.';
    }
  }else{
    echo "No data";
  }
?>

<?php
  if(isset($_POST)){
    $id                = $_POST['uuid'];
    $role              = $_POST['role'];
    
    $sql = "UPDATE users SET role='$role' WHERE uuid='$id'";
    $stmtinsert = $db->prepare($sql);
    $result = $stmtinsert->execute();
    if ($result) {
        echo 'Successfully saved.';
    } else {
        echo 'There were errors while saving the data.';
    }
  }else{
    echo "No data";
  }



?>