<?php
require_once('/var/www/html/config.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('/var/www/html/config.php');
$pdo = $db;



?>

<?php
$currentDate = new DateTime();

if (isset($_POST)) {
    $uuid              = $_POST['uuid'];
    $status            = $_POST['status'];
    $date              = $currentDate->format('Y-m-d H:i:s');
    $name              = $_POST['name'];
    $username          = $_POST['username'];
    $day_id            = $_POST['day_id'];

    function insertPendingShifts($uuid, $status, $date, $name, $username, $day_id, $pdo)
    {
        // Check if there is an existing entry for the UUID
        $existingStmt = $pdo->prepare("SELECT COUNT(*) FROM pending_shifts WHERE uuid = ?");
        $existingStmt->execute([$uuid]);
        $existingCount = $existingStmt->fetchColumn();

        if ($existingCount > 0) {
            // Update the existing entry in the pending_shifts table

            // Prepare a statement to update the shift information
            $stmt = $pdo->prepare("UPDATE pending_shifts SET status = ?, date = ?, name = ?, username = ?, monday = ?, tuesday = ?, wednesday = ?, thursday = ?, friday = ?, saturday = ?, sunday = ? WHERE uuid = ?");

            // Create an array to hold the values for each day of the week
            $shiftValues = [$status, $date, $name, $username];

            // Iterate over the 7 days of the week
            for ($i = 0; $i < 7; $i++) {
                $currentDay = date('l', strtotime('Sunday +' . $i . ' days'));

                // Get the index for the current day in the day_id array
                $dayIndex = $i % count($day_id);

                // Check if the dayId starts with "false-"
                if (strpos($day_id[$dayIndex], 'false-') === 0) {
                    // Set the day to 'off'
                    $shiftValues[] = 'off';
                } else {
                    // Get the shift ID for the current day
                    $shiftId = $day_id[$dayIndex];

                    // Fetch the shift information from the shifts table
                    $shiftStmt = $pdo->prepare("SELECT * FROM shifts WHERE id = ?");
                    $shiftStmt->execute([$shiftId]);
                    $shiftData = $shiftStmt->fetch(PDO::FETCH_ASSOC);

                    // Decrease the employee_max value by one
                    $maxEmployees = $shiftData['employee_max'] - 1;

                    // Update the shifts table with the decreased employee_max value
                    $updateShiftStmt = $pdo->prepare("UPDATE shifts SET employee_max = ? WHERE id = ?");
                    $updateShiftStmt->execute([$maxEmployees, $shiftId]);

                    // Combine the start and end time into one string
                    $shiftTime = $shiftData['start_time'] . ' - ' . $shiftData['end_time'];

                    // Store the shift time for the current day
                    $shiftValues[] = $shiftTime;
                }
            }

            // Add the UUID at the end of the shift values array
            $shiftValues[] = $uuid;

            // Update the shift information in the pending_shifts table
            $stmt->execute($shiftValues);
        } else {
            // Insert a new entry into the pending_shifts table

            // Prepare a statement to insert into pending_shifts table
            $stmt = $pdo->prepare("INSERT INTO pending_shifts (uuid, status, date, name, username, monday, tuesday, wednesday, thursday, friday, saturday, sunday) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            // Create an array to hold the values for each day of the week
            $shiftValues = [$uuid, $status, $date, $name, $username];

            // Iterate over the 7 days of the week
            for (
                $i = 0;
                $i < 7;
                $i++
            ) {
                // Get the index for the current day in the day_id array
                $dayIndex = $i % count($day_id);

                // Check if the dayId starts with "false-"
                if (strpos($day_id[$dayIndex], 'false-') === 0) {
                    // Set the day to 'off'
                    $shiftValues[] = 'off';
                } else {
                    // Get the shift ID for the current day
                    $shiftId = $day_id[$dayIndex];

                    // Fetch the shift information from the shifts table
                    $shiftStmt = $pdo->prepare("SELECT * FROM shifts WHERE id = ?");
                    $shiftStmt->execute([$shiftId]);
                    $shiftData = $shiftStmt->fetch(PDO::FETCH_ASSOC);

                    // Decrease the employee_max value by one
                    $maxEmployees = $shiftData['employee_max'] - 1;


                    // Update the shifts table with the decreased employee_max value
                    $updateShiftStmt = $pdo->prepare("UPDATE shifts SET employee_max = ? WHERE id = ?");
                    $updateShiftStmt->execute([$maxEmployees, $shiftId]);

                    // Combine the start and end time into one string
                    $shiftTime = $shiftData['start_time'] . ' - ' . $shiftData['end_time'];

                    // Store the shift time for the current day
                    $shiftValues[] = $shiftTime;
                }
            }

            // Add the UUID at the end of the shift values array
            // $shiftValues[] = $uuid;
            // print_r($shiftValues);

            // Update the shift information in the pending_shifts table
            $stmt->execute($shiftValues);
        }
    }
    // Example usage


    InsertPendingShifts($uuid, $status, $date, $name, $username, $day_id, $pdo);
}

?>