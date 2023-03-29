<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
function getUserPermissions($db, $userId) {
    // Prepare and execute a SELECT query to get the user's role
    $stmt = $db->prepare('SELECT role FROM users WHERE id = :userId');
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // If the user's role was found, use it to retrieve their permissions from the role table
    if ($result) {
        $role = $result['role'];
        $stmt = $db->prepare('SELECT * FROM roles WHERE name = :role');
        $stmt->bindParam(':role', $role);
        $stmt->execute();
        $permissions = $stmt->fetch(PDO::FETCH_ASSOC);

        // Return the user's role and permissions as an associative array
        return array('role' => $role, 'permissions' => $permissions);
    } else {
        // If the user was not found, return null
        return null;
    }
}
?>