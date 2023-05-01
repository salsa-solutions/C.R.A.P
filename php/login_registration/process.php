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
        echo 'sign up is disabled due to maintenance';
    }else{
        if(isset($_POST)){
            
            $uuid              = uuid_create(UUID_TYPE_RANDOM);
            $date              = $currentDate->format('Y-m-d H:i:s');
            $name              = $_POST['firstname'] . ' ' . $_POST['lastname'];
            $email             = $_POST['email'];
            $phone             = $_POST['phone'];
            $username          = $_POST['username'];
            $password          = password_hash($_POST['password'], PASSWORD_DEFAULT);
            // echo $uuid;
            // if first user is created, make them admin
            $sql_make_admin = "SELECT * FROM users";
            $stmt = $db->prepare($sql_make_admin);
            $stmt->execute();
            $result = $stmt->fetchAll();
            if (count($result) == 0) {
                $role_name         = 'Admin';
                $role              = 'admin';
                $active            = 'true';
            }else{
                $role_name         = 'Pending';
                $role              = 'pending';
                $active            = 'true';
            }

            $sql = "INSERT INTO users (uuid, registration_date, role, role_name, name, email, phone, username, password, active) VALUES(?,?,?,?,?,?,?,?,?,?)";


            $stmtinsert = $db->prepare($sql);
            $result = $stmtinsert->execute([$uuid, $date, $role, $role_name, $name, $email, $phone, $username, $password, $active]);
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