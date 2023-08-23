<?php
require_once('/var/www/html/config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>


<?php
  if(isset($_POST)){
    $uuid                = $_POST['id'];

    $sql = "DELETE FROM messages WHERE id='$id'";
    $stmtinsert = $db->prepare($sql);
    $result = $stmtinsert->execute();
    if ($result) {
        echo 'Successfully saved.';
    } else {
        echo 'There were erros while deleting the message.';
    }
  }else{
    echo "No data";
  }



?>