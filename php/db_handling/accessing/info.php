<?php
// Get the selected user ID from the AJAX request
$user_id = $_POST['user_id'];

// Retrieve the user information from the database or wherever it's stored
include('/var/www/html/config.php');
$result = $db->prepare("SELECT username, email FROM  ORDER BY name ASC");
$result->execute();
for ($i = 0; $row = $result->fetch(); $i++) {
    $username = $row['username'];
    $email = $row['email'];
    


// Return the user information as HTML

}
?>
