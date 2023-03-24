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
$status = $_SESSION['userlogin'][3];
$WEB_TITLE = 'Home';

// to turn off a site uncomment the following line:
//$_DEV = true;
if (($role == 'Admin')) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}
if ( ($role == 'Admin') || ($role == 'Manager')) {
    $managment = 'Management';
    $Admin_page='<a href="/admin.php">Admin</a>';
    $scheduling_page='<a href="/scheduling.php">Scheduling</a>';
	$approval = '<a href="/approval.php">Approval</a>';
}
else {
    $managment = NULL;
    $Admin_page= NULL;
    $scheduling_page= NULL;
    $approval = NULL;
}
// echo '<pre>'; print_r($_SESSION['userlogin']); echo '</pre>';
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
    <title><?php echo $WEB_TITLE ?> | <?php echo $WEBSITE_NAME; ?></title>

</head>



<?php require("php/template.php"); echo $header ?>
<?php if (($_DEV) && (($role == 'Server') || ($role == 'Manager')) == '1') {
        echo $out_of_service;
    }elseif(($status == 'pending')){
        echo $pending;
    }else{

    
    ?>
    <div class="container h-50 scroll">
        <div class="d-flex justify-content-left form-container">
            <div class="user_card">
                <div class="d-flex justify-content-center p-5">
                    <h3>Availability</h3>
                </div>
                <div class="d-flex justify-content-center form-container">
                    <form action="">
                        <div class="input-group mb-1">
                            <div class="input-group-append text">
                                <p>Monday</p>
                            </div>
                            <input type="text" placeholder="9am-4pm" name="monday-avil" id="monday-avil" class="form-control form-control-sm input_user " >
                        </div>
                        <div class="input-group mb-1">
                            <div class="input-group-append text">
                                <p>Tuesday</p>
                            </div>
                            <input type="text" placeholder="9am-4pm" name="tuesday-avil" id="tuesday-avil" class="form-control form-control-sm input_user " >
                        </div>
                        <div class="input-group mb-1">
                            <div class="input-group-append text">
                                <p>Wednesday</p>
                            </div>
                            <input type="text" placeholder="9am-4pm" name="wednesday-avil" id="wednesday-avil" class="form-control form-control-sm input_user " >
                        </div>
                        <div class="input-group mb-1">
                            <div class="input-group-append text">
                                <p>Thursday</p>
                            </div>
                            <input type="text" placeholder="9am-4pm" name="thursday-avil" id="thursday-avil" class="form-control form-control-sm input_user " >
                        </div>
                        <div class="input-group mb-1">
                            <div class="input-group-append text">
                                <p>Friday</p>
                            </div>
                            <input type="text" placeholder="9am-4pm" name="friday-avil" id="friday-avil" class="form-control form-control-sm input_user " >
                        </div>
                        <div class="input-group mb-1">
                            <div class="input-group-append text">
                                <p>Saturday</p>
                            </div>
                            <input type="text" placeholder="9am-4pm" name="saturday-avil" id="saturday-avil" class="form-control form-control-sm input_user " >
                        </div>
                        <div class="d-flex justify-content-center mt-3 submit-container">
                            <button type="button" name="button" id="submit_avil" class="btn submit_btn">submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="user_card">
                <div class="d-flex justify-content-center p-5">
                    <h3>Wanted days</h3>
                </div>
                <div class="d-flex justify-content-center form-container">
                    <form action="">
                        <div class="input-group mb-1">
                            <div class="input-group-append text">
                                <p>Monday</p>
                            </div>
                            <input type="text" placeholder="9am-4pm" name="monday-pref" id="monday-pref" class="form-control form-control-sm input_user " >
                        </div>
                        <div class="input-group mb-1">
                            <div class="input-group-append text">
                                <p>Tuesday</p>
                            </div>
                            <input type="text" placeholder="9am-4pm" name="tuesday-pref" id="tuesday-pref" class="form-control form-control-sm input_user " >
                        </div>
                        <div class="input-group mb-1">
                            <div class="input-group-append text">
                                <p>Wednesday</p>
                            </div>
                            <input type="text" placeholder="9am-4pm" name="wednesday-pref" id="wednesday-pref" class="form-control form-control-sm input_user " >
                        </div>
                        <div class="input-group mb-1">
                            <div class="input-group-append text">
                                <p>Thursday</p>
                            </div>
                            <input type="text" placeholder="9am-4pm" name="thursday-pref" id="thursday-pref" class="form-control form-control-sm input_user " >
                        </div>
                        <div class="input-group mb-1">
                            <div class="input-group-append text">
                                <p>Friday</p>
                            </div>
                            <input type="text" placeholder="9am-4pm" name="friday-pref" id="friday-pref" class="form-control form-control-sm input_user " >
                        </div>
                        <div class="input-group mb-1">
                            <div class="input-group-append text">
                                <p>Saturday</p>
                            </div>
                            <input type="text" placeholder="9am-4pm" name="saturday" id="saturday-pref" class="form-control form-control-sm input_user " >
                        </div>
                        <!-- <div class="input-group mb-1">
                            <input type="number" placeholder="Hours" name="hours" id="hours" class="form-control form-control-sm input_user" min=1 max=40 >
                        </div> -->
                        <div class="d-flex justify-content-center mt-3 sumbit-container">
                            <button type="button" name="button" id="sumbit-pref" class="btn submit_btn">sumbit</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="user_card">
                <div class="d-flex justify-content-center p-5">
                    <h3>Special request</h3>
                </div>
                <form action="">
                    <div class="d-flex justify-content-center form-container">
                        <div class=" mb-1">
                            <textarea type="text" name="textarea" id="message" cols="30" rows="10" placeholder="I need so and so off because... "   class="form-control form-control-sm input_user " required ></textarea>    
                        
                        
                        <!-- <text type="text" placeholder="I need so and so off because... " name="request" id="message"  class="form-control form-control-sm input_user input-size"  > -->
                        </div>
                        
                    </div>
                    <div class="d-flex justify-content-center mt-3 sumbit-container">
                        <button type="button" name="button" id="submit_sr" class="btn submit_btn">sumbit</button>
                    </div>
                </form>
            </div>

        </div>

    </div>
    <script>
        document.getElementById('message').style.height = '322px';
        document.getElementById('message').style.width = '250px';
    </script>

    <script>
        $(function() {
            $('#submit_avil').click(function(e) {

                var valid = this.form.checkValidity();

                if (valid) {
                    var name = "<?php echo $name; ?>";
                    var username = "<?php echo $username; ?>";
                    var monday_avil = $('#monday-avil').val();
                    var tuesday_avil = $('#tuesday-avil').val();
                    var wednesday_avil = $('#wednesday-avil').val();
                    var thursday_avil = $('#thursday-avil').val();
                    var friday_avil = $('#friday-avil').val();
                    var saturday_avil = $('#saturday-avil').val();
                    $.ajax({
                        url: '/php/db_handling/add_avil.php',
                        type: 'POST',
                        data: {
                            name: name,
                            username: username,
                            monday: monday_avil,
                            tuesday: tuesday_avil,
                            wednesday: wednesday_avil,
                            thursday: thursday_avil,
                            friday: friday_avil,
                            saturday: saturday_avil
                        },
                        success: function(data) {
                            Swal.fire(
                                'Successful',
                                'Your request has been submited',
                                'success'
                            )
                        },
                        error: function(data) {
                            Swal.fire(
                                'Errors',
                                'Whoops!',
                                'error'
                            )

                        }
                    });
                }
            });
        });
    </script>
    <script>
        $(function() {
            $('#sumbit-pref').click(function(e) {

                var valid = this.form.checkValidity();

                if (valid) {
                    var name = "<?php echo $name; ?>";
                    var username = "<?php echo $username; ?>";
                    var monday_pref = $('#monday-pref').val();
                    var tuesday_pref = $('#tuesday-pref').val();
                    var wednesday_pref = $('#wednesday-pref').val();
                    var thursday_pref = $('#thursday-pref').val();
                    var friday_pref = $('#friday-pref').val();
                    var saturday_pref = $('#saturday-pref').val();
                    var hours = $('#hours').val();
                    // console.log(hours);
                    $.ajax({
                        url: '/php/db_handling/add_pref.php',
                        type: 'POST',
                        data: {
                            name: name,
                            username: username,
                            monday: monday_pref,
                            tuesday: tuesday_pref,
                            wednesday: wednesday_pref,
                            thursday: thursday_pref,
                            friday: friday_pref,
                            saturday: saturday_pref,
                            hours: hours
                        },
                        success: function(data) {
                            Swal.fire(
                                'Successful',
                                'Your request has been submited',
                                'success'
                            )
                        },
                        error: function(data) {
                            Swal.fire(
                                'Errors',
                                'Whoops!',
                                'error'
                            )
                        }
                    });
                }
            });
        });
    </script>
    <script>
        $(function() {
            $('#submit_sr').click(function(e) {

                var valid = this.form.checkValidity();

                if (valid) { 
                    var name = "<?php echo $name; ?>";
                    var message = $('#message').val();
                    $.ajax({
                        url: '/php/db_handling/add_sr.php',
                        type: 'POST',
                        data: {
                            name: name,
                            message: message
                        },
                        success: function(data) {
                            Swal.fire(
                                'Successful',
                                'Your request has been submited',
                                'success'
                            )
                        },
                        error: function(data) {
                            Swal.fire(
                                'Errors',
                                'Whoops!',
                                'error'
                            )
                        }
                    });
                }
            });
        });

    </script>
    <?php
}

include_once("php/template.php");
echo $footer;
?>

