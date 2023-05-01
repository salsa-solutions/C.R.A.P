<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Include the config file


function getRoleFromName($rolename)
{
    require('/var/www/html/config.php');

    // Prepare and execute SQL query
    $stmt = $db->prepare("SELECT role FROM roles WHERE role_name = ?");
    $stmt->execute([$rolename]);

    // Fetch the result
    $result = $stmt->fetch();

    // Return the result
    return $result['role'];
}
// print_r(getRoleFromName('Admin'));

?>