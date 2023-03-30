<?php
session_start();
require_once('/var/www/html/config.php');
require_once('/var/www/html/pages/page-index.php');


if (!isset($_SESSION['userlogin'])) {
    header('Location: ' . $login_page_url . '');
}


$name = $_SESSION['userlogin'][0];
$role = $_SESSION['userlogin'][1];
$username = $_SESSION['userlogin'][2];
$status = $_SESSION['userlogin'][3];
$WEB_TITLE = 'PUT TITLE HERE';

// to turn off a site uncomment the following line:
//$_DEV = true;
if (($role == 'Admin')) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}
if ( ($role == 'Admin') || ($role == 'Manager')) {
    
    $managment = $managment_page;
    $Admin_page= $admin_page;
    $scheduling_page= $scheduling_page;
	$approval = $approval_page;
}
else {
    $managment = NULL;
    $Admin_page= NULL;
    $scheduling_page= NULL;
    $approval = NULL;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/backround.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/nav.css">
    <title><?php echo $WEB_TITLE ?> | <?php echo $WEBSITE_NAME; ?></title>

</head>



<?php require("/var/www/html/php/template.php"); echo $header ?>
<?php if (($_DEV) && (($role == 'Server') || ($role == 'Manager') || ($role == 'Cook')) == '1') {
        echo $out_of_service;
    }elseif(($status == 'pending')){
        echo $pending;
    }else{

    
    ?>
<!-- put content here -->
    <?php
}

include_once("php/template.php");
echo $footer;
?>

