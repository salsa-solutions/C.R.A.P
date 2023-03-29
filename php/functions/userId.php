<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function getUserId($db, $username) {
    $db_host = "localhost";  // Replace with your database host
    $db_name = "your_database_name"; // Replace with your database name
    $db_user = "your_database_username"; // Replace with your database username
    $db_pass = "your_database_password"; // Replace with your database password

    // Create a new PDO object
    
    $stmt = $db->prepare("SELECT username FROM users WHERE id = :id");

    // Bind the ID parameter to the prepared statement
    $stmt->bindParam(':id', $username);

    // Execute the prepared statement
    $stmt->execute();

    // Fetch the result
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the result is an array
    if (is_array($result)) {
        // Return the user ID
        return $result['id'];
}
}
