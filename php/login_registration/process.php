<?php

	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
?>


<?php
    $currentDate = new DateTime();
    // echo '<pre>'; print_r($_POST); echo '</pre>';
    require_once('../../config.php');
    if(isset($_POST)){
        $date              = $currentDate->format('Y-m-d H:i:s');
        $firstname         = $_POST['firstname'];
        $lastname          = $_POST['lastname'];
        $email             = $_POST['email'];
        $username          = $_POST['username'];
        $password          = sha1($_POST['password']);

        $sql = "INSERT INTO users (date, firstname, lastname, email, username, password ) VALUES(?,?,?,?,?,?)";
        $stmtinsert = $db->prepare($sql);
        $result = $stmtinsert->execute([$date, $firstname, $lastname, $email, $username, $password]);
        if ($result) {
            echo 'Successfully saved.';
        } else {
            echo 'There were erros while saving the data.';
        }
    }else{
        echo "No data";
    }
?>