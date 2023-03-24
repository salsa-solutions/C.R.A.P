<?php
require_once('../../config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>


<?php  
    $currentDate = new DateTime();
    
    if(isset($_POST)){
        $date              = $currentDate->format('Y-m-d H:i:s');
        $name              = $_POST['name'];
        $username          = $_POST['username'];
        $monday            = $_POST['monday'];
        $tuesday           = $_POST['tuesday'];
        $wednesday         = $_POST['wednesday'];
        $thursday          = $_POST['thursday'];
        $friday            = $_POST['friday'];
        $saturday          = $_POST['saturday'];
        // $hours             = $_POST['hours']; add them back to $sql var if wanted
        $sql = "INSERT INTO pref_day (date, name, username, monday, tuesday, wednesday, thursday, friday, saturday ) VALUES(?,?,?,?,?,?,?,?,?)";
        $stmtinsert = $db->prepare($sql);
        $result = $stmtinsert->execute([$date, $name, $username, $monday, $tuesday, $wednesday, $thursday, $friday, $saturday]);
        if ($result) {
            echo 'Successfully saved.';
        } else {
            echo 'There were erros while saving the data.';
        }
    }else{
        echo "No data";
    }
?>