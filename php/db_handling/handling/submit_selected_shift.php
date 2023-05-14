<?php
require_once('/var/www/html/config.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function sort_shifts_by_week($db, $tableId)
{
    // Define the days of the week in the desired order
    $weekDays = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');

    // Initialize an empty array to hold the sorted shifts
    $sortedShifts = array();

    // Get the shifts for the given table ID from the database
    $sql = "SELECT shifts.start_time, shifts.end_time, shifts.day FROM shifts INNER JOIN tables ON shifts.id = shifts WHERE tables.id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $tableId);
    $stmt->execute();

    // Initialize an array to hold shifts for each day of the week
    $shiftsByDay = array();
    foreach ($weekDays as $day) {
        $shiftsByDay[$day] = array();
    }

    // Fetch shifts and group them by day
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $day = $row['day'];
        $shiftsByDay[$day][] = array('start_time' => $row['start_time'], 'end_time' => $row['end_time']);
    }

    // Sort shifts within each day by start time
    foreach ($weekDays as $day) {
        usort($shiftsByDay[$day], function ($a, $b) {
            return strtotime($a['start_time']) - strtotime($b['start_time']);
        });
    }

    // Build the sorted shifts array in the desired order
    foreach ($weekDays as $day) {
        $sortedShifts[$day] = $shiftsByDay[$day];
    }

    return $sortedShifts;
}


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

        echo sort_shifts_by_week($db, $day_id);

        


        
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