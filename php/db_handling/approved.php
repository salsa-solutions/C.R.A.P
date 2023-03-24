<?php
require_once('../../config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>


<?php
  if(isset($_POST)){
    $id                = $_POST['id'];
    
    $sql = "UPDATE users SET approved='approved' WHERE id='$id'";
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
    $id                = $_POST['id'];
    $role              = $_POST['role'];
    
    $sql = "UPDATE users SET role='$role' WHERE id='$id'";
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