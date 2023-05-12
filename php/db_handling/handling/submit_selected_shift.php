<?php
require_once('/var/www/html/config.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<?php  
    $currentDate = new DateTime();
    
    if(isset($_POST)){
        $uuid              = $_POST['uuid'];
        $approved          = $_POST['approved'];
        $date              = $currentDate->format('Y-m-d H:i:s');
        $name              = $_POST['name'];
        $username          = $_POST['username'];
        $shift_id          = $_POST['shift_id'];

        


        
        $sql = "INSERT INTO availability (uuid, date, name, username, monday, tuesday, wednesday, thursday, friday, saturday ) VALUES(?,?,?,?,?,?,?,?,?,?)";
        $stmtinsert = $db->prepare($sql);
        $result = $stmtinsert->execute([$uuid, $date, $name, $username, $monday, $tuesday, $wednesday, $thursday, $friday, $saturday]);
        if ($result) {
            echo 'Successfully saved.';
        } else {
            echo 'There were erros while saving the data.';
        }
    }else{
        echo "No data";
    }
?>