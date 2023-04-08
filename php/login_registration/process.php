<?php

	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
?>


<?php
    $currentDate = new DateTime();
    // echo '<pre>'; print_r($_POST); echo '</pre>';
    require_once('/var/www/html/config.php');
    if($_DEV_DB){
        echo 'Logging in and sign up are disabled due to maintenance';
    }else{
        if(isset($_POST)){
            $date              = $currentDate->format('Y-m-d H:i:s');
            $firstname         = $_POST['firstname'];
            $lastname          = $_POST['lastname'];
            $email             = $_POST['email'];
            $phone             = $_POST['phone'];
            $username          = $_POST['username'];
            $password          = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $role              = 'pending';
            $active            = 'false';

            $sql = "INSERT INTO users (date, role, firstname, lastname, email, phone, username, password, active) VALUES(?,?,?,?,?,?,?,?,?)";


            $stmtinsert = $db->prepare($sql);
            $result = $stmtinsert->execute([$date, $role, $firstname, $lastname, $email, $phone, $username, $password, $active]);
            if ($result) {
                echo 'Successfully saved.';
            } else {
                echo 'There were errors while saving the data.';
            }
        }else{
            echo "No data";
        }
}
?>