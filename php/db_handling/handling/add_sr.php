<?php
require_once('/var/www/html/config.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>


<?php  
    $currentDate = new DateTime();
    
    if(isset($_POST)){
        $date              = $currentDate->format('Y-m-d H:i');
        $name              = $_POST['name'];
        $message           = $_POST['message'];

        $sql = "INSERT INTO sr (date, name, message ) VALUES(?,?,?)";
        $stmtinsert = $db->prepare($sql);
        $result = $stmtinsert->execute([$date, $name, $message]);
        if ($result) {
            echo 'Successfully saved.';
        } else {
            echo 'There were erros while saving the data.';
        }
    }else{
        echo "No data";
    }
?>