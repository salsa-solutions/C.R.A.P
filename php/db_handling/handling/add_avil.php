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
        $monday            = empty($_POST['monday']) ? 'OFF' : $_POST['monday'];
        $tuesday           = empty($_POST['tuesday']) ? 'OFF' : $_POST['tuesday'];
        $wednesday         = empty($_POST['wednesday']) ? 'OFF' : $_POST['wednesday'];
        $thursday          = empty($_POST['thursday']) ? 'OFF' : $_POST['thursday'];
        $friday            = empty($_POST['friday']) ? 'OFF' : $_POST['friday'];
        $saturday          = empty($_POST['saturday']) ? 'OFF' : $_POST['saturday'];
        
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