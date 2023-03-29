<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function getUserID($db, $username) {
    // Connect to the database
    $mysqli = $db;
    $userID = 0;

    // Check for connection errors
    if ($mysqli->connect_error) {
        die('Connection Error: ' . $mysqli->connect_error);
    }

    // Prepare the SQL statement
    $sql = "SELECT id FROM users WHERE username = ?";

    // Bind the parameter to the statement
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('s', $username);

    // Execute the statement
    $stmt->execute();

    // Bind the result to a variable
    $stmt->bind_result($userID);

    // Fetch the result
    $stmt->fetch();

    // Close the statement and database connection
    $stmt->close();
    $mysqli->close();

    // Return the user ID
    return $userID;
}
?>
