<?php
//show errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('/var/www/html/config.php');


// $uuid       = $_POST['uuid'];
// $status     = $_POST['status'];
// $date       = $currentDate->format('Y-m-d H:i:s');
// $name       = $_POST['name'];
// $username   = $_POST['username'];
// $day_id     = $_POST['day_id'];


// make test inputs
$uuid = 'test';
$status = 'test';
$date = 'test';

$name = 'test';
$username = 'test';
$day_id = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 'monday-off', 'tuesday-off', 'wednesday-off', 'thursday-off', 'friday-off', 'saturday-off', 'sunday-off'];


// Retrieve shift information from the 'shifts' table


try {

    $pdo = $db;

    $information = [];
    $stmt = $pdo->query("SELECT day, role FROM shifts");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $information[$row['day']] = $row['id'];
    }
} catch (PDOException $e) {
    echo "Error retrieving shift information: " . $e->getMessage();
    exit();
}

function sortShifts($day_id, $information)
{
    global $uuid, $status, $date, $name, $username, $db;
    // Existing code ...

    // SQL insert statements array
    $sqlInserts = [];

    foreach ($day_id as $id) {
        if (strpos($id, '-off') === false) {
            if (isset($information[$id])) {
                $weekDays[$information[$id]][] = $id;

                // Generate SQL insert statement
                $sqlInserts[] = "INSERT INTO your_table (uuid, status, date, name, username, day_id) VALUES (?, ?, ?, ?, ?, ?)";
            }
        }
    }

    // Display the sorted days and corresponding numbers
    foreach ($weekDays as $day => $numbers) {
        // Existing code ...
    }

    // Execute SQL inserts


    try {
        $pdo = $db;

        foreach ($sqlInserts as $sqlInsert) {
            $stmt = $pdo->prepare($sqlInsert);
            $stmt->execute([$uuid, $status, $date, $name, $username, $day_id]);
        }

        echo "SQL inserts executed successfully.";
    } catch (PDOException $e) {
        echo "Error executing SQL inserts: " . $e->getMessage();
    }
}

// Existing code ...

sortShifts($day_id, $information);
