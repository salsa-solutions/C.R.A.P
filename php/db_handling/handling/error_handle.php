<?php
require_once('/config.php');
// Get the error message from the query parameter

$message = $_GET['message'];


// Log the error message to a SQL database
$stmt = $db->prepare('INSERT INTO error_log (message) VALUES (?)');
$stmt->execute([$message]);

// Send a success response to the client
echo 'Error message sent to SQL database.';

?>