<?php
require_once('../../config.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// echo '<pre>'; print_r($_POST); echo '</pre>';
?>

<?php
$currentDate = new DateTime();

if (isset($_POST)) {

    $status            = "approved";
    $approved          = $_POST['approved']; # tells who approved the schedual
    $date              = $currentDate->format('Y-m-d H:i:s');
    $name              = $_POST['name'];
    $username          = $_POST['username'];
    $monday            = $_POST['monday'];
    $tuesday           = $_POST['tuesday'];
    $wednesday         = $_POST['wednesday'];
    $thursday          = $_POST['thursday'];
    $friday            = $_POST['friday'];
    $saturday          = $_POST['saturday'];
    // $hours             = $_POST['hours'];
    $sql = "INSERT INTO current_schedule (approved, status, date, name, username, monday, tuesday, wednesday, thursday, friday, saturday) VALUES(  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    // $stmtinsert = $db->prepare($sql);
    // print_r($stmtinsert) ;
    $result = $stmtinsert->execute([ $approved, $status, $date, $name, $username, $monday, $tuesday, $wednesday, $thursday, $friday, $saturday]);
    if ($result) {
        echo 'Successfully saved.';
    } else {
        echo 'There were erros while saving the data.';
    }
} else {
    echo "No data";
}
?>