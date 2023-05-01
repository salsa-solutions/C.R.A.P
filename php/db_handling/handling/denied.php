<?php
require_once('/var/www/html/config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>


<?php
  if(isset($_POST)){
    $uuid                = $_POST['uuid'];

    $sql = "DELETE FROM users WHERE uuid='$uuid'";
    $stmtinsert = $db->prepare($sql);
    $result = $stmtinsert->execute();
    if ($result) {
        echo 'Successfully saved.';
    } else {
        echo 'There were erros while saving the data.';
    }
  }else{
    echo "No data";
  }



?>