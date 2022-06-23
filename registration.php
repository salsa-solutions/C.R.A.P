<?php



require_once('config.php')
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">

    <title>User Registration | </title>
</head>
<body>
    <div>
        <form action="registration.php" method="POST">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <h1>Registration</h1>
                        <hr class="mb-3">
                        <label for="firstname"><b>First name</b></label>
                        <input class="form-control" type="text" name="firstname" required>

                        <label for="lastname"><b>Last name</b></label>
                        <input class="form-control" type="text" name="lastname" required>
                        
                        <label for="email"><b>Email</b></label>
                        <input class="form-control" type="text" name="email" required>
                    
                        <label for="username"><b>Username</b></label>
                        <input class="form-control" type="text" name="username" required> 

                        <label for="password"><b>Password</b></label>
                        <input class="form-control" type="password" name="password" required>
                        <hr class="mb-3">
                        
                        <input class="btn btn-primary" type="submit" name="create" value="Sign Up">
                    </div>
                </div>

            </div>

        </form>
    </div>
    <div>
        <?php
            $firstname 		= $_POST['firstname'];
            $lastname 		= $_POST['lastname'];
            $email 			= $_POST['email'];
            $username	= $_POST['username'];
            $password 		= sha1($_POST['password']);
        
                $sql = "INSERT INTO users (firstname, lastname, email, username, password ) VALUES(?,?,?,?,?)";
                $stmtinsert = $db->prepare($sql);
                $result = $stmtinsert->execute([$firstname, $lastname, $email, $username, $password]);
                if($result){
                    echo 'Successfully saved.';
                }else{
                    echo 'There were erros while saving the data.';
                }


        ?>
    </div>

</body>
</html>