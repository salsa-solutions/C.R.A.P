<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function getUserId($db, $username) {
    require_once('/var/www/html/config.php');
    // Create a new PDO object
    
    $stmt = $db->prepare("SELECT username FROM users WHERE uid = :id");

    // Bind the ID parameter to the prepared statement
    $stmt->bindParam(':id', $username);

    // Execute the prepared statement
    $stmt->execute();

    // Fetch the result
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the result is an array
    if (is_array($result)) {
        // Return the user ID
        return $result['uid'];
}
}
