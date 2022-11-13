<?php
session_start();
require_once('config.php');

if (!isset($_SESSION['userlogin'])) {
    header("Location: login.php");
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION);
    header("Location: login.php");
}
$name = $_SESSION['userlogin'][0];
$role = $_SESSION['userlogin'][1];
$username = $_SESSION['userlogin'][2];
$WEB_TITLE = 'Approval';
$_DEV = false;
if ( ($role == 'admin') || ($role == 'manager')) {
    $managment = 'Management';
    $admin_page='<a href="/admin.php">Admin</a>';
    $scheduling_page='<a href="/scheduling.php">Scheduling</a>';
	$approval = '<a href="/approval.php">Approval</a>';
}
else {
    $admin_page= NULL;
    $scheduling_page= NULL;
}
if ( ($role == 'admin')) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

}elseif ($role == 'manager'){

}else {
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/backround.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/nav.css">
    <title><?php echo $WEB_TITLE; ?> | Capriotti's Regional Attendance Program</title>

</head>
<?php require("php/template.php"); echo $header ?>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center">Approval</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <h3 class="text-center">Pending User Requests</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Username</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php
                                        include('config.php');
                                        $result = $db->prepare("SELECT date, username, firstname, lastname, approved FROM users ORDER BY username ASC");
                                        $result->execute();
                                        for ($i = 0; $row = $result->fetch(); $i++) {
                                            if($row['approved'] == 'pending'){
                                                    
                                        ?>
                                        
                                        
                                        
                                        <form action="">
                                            <tr>
                                                <td><?php echo $row['username']?></td>
                                                <td><?php echo $row['firstname'] . ' ' . $row['lastname'];?></td>
                                                <td><?php echo $row['date'] ?></td>
                                                <td><?php echo $row['approved'] ?></td>
                                                <td><button class="btn btn-success" name="<?php echo $row['username']; ?>" >Approve</button> <button class="btn btn-danger" id="<?php echo $row['username']; ?>" >Deny</button></td>
                                            </tr>
                                        </form>
                                        <?php
                                        if(isset($_POST[$row['username']])){
                                            $sql = "UPDATE users SET approved = 'approved' WHERE username = " . $row['username'];"";
                                            $result = $db->prepare($sql);
                                            $result->execute();
                                        }
                                        
                                        ?>


                                        <?php   
                                            } 
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require("php/template.php"); echo $footer ?>
</html>