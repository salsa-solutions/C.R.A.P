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
        $day_id            = $_POST['day_id'];
        $shift_id          = $_POST['shift_id'];

        if($day_id == 1){
            $monday = $_POST['shift_id'];
        }else{
            $monday = NULL;
        }
        if($day_id == 2){
            $tuesday = $_POST['shift_id'];
        }else{
            $tuesday = NULL;
        }
        if($day_id == 3){
            $wednesday = $_POST['shift_id'];
        }else{
            $wednesday = NULL;
        }
        if($day_id == 4){
            $thursday = $_POST['shift_id'];
        }else{
            $thursday = NULL;
        }
        if($day_id == 5){
            $friday = $_POST['shift_id'];
        }else{
            $friday = NULL;
        }
        if($day_id == 6){
            $saturday = $_POST['shift_id'];
        }else{
            $saturday = NULL;
        }
        if($day_id == 7){
            $sunday = $_POST['shift_id'];
        }else{
            $sunday = NULL;
        }


        
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