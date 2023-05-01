<?php
require_once('/var/www/html/config.php');
require_once('/var/www/html/pages/page-index.php');
require_once('/var/www/html/php/functions/permissons.php');
require_once('/var/www/html/php/functions/select.php');

// echo $session_id;
session_start();
// print_r($_SESSION);
if (!isset($_SESSION['session_id']) && !isset($_SESSION['name']) && !isset($_SESSION['username']) && !isset($_SESSION['role']) && !isset($_SESSION['role_name']) && !isset($_SESSION['uuid'])) {
    header('Location: ' . $login_page_url . '');
}


$name = $_SESSION['name'];
$username = $_SESSION['username'];
$role = $_SESSION['role'];
$role_name = $_SESSION['role_name'];
$uuid = $_SESSION['uuid'];
$time = generate_time_options('9:00 AM', '5:00 PM');
$WEB_TITLE = 'Home';

// to turn off a site uncomment the following line:
//$_DEV = true;



setAccessPages($role);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="
    https://cdn.jsdelivr.net/npm/notiflix/dist/notiflix-3.2.5.min.js
"></script>
    <link href="
https://cdn.jsdelivr.net/npm/notiflix/dist/notiflix-3.2.5.min.css
" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/css/backround.css">
    <link rel="stylesheet" href="/css/home.css">
    <link rel="stylesheet" href="/css/nav.css">
    <title><?php echo $WEB_TITLE ?> | <?php echo $WEBSITE_NAME; ?></title>

</head>

<?php require("/var/www/html/php/template.php");
echo $header;
if ($_DEV && in_array($role, array('employee', 'manager', 'admin'))) {
    echo $out_of_service;
} elseif ($role == 'pending') {
    echo $pending;
} elseif (!isset($_SESSION['session_id'])) {
    echo $fourohthree;
} elseif (in_array($role, array('employee', 'manager', 'admin', 'dev'))) {


?>




<div class="container h-100 scroll user-input ">
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
                    <input type="text" placeholder="9am-4pm" name="monday-pref" id="monday-pref"
                        class="form-control form-control-sm input_user ">
                </div>
                <div class="input-group mb-1">
                    <div class="input-group-append text">
                        <p>Tuesday</p>
                    </div>
                    <input type="text" placeholder="9am-4pm" name="tuesday-pref" id="tuesday-pref"
                        class="form-control form-control-sm input_user ">
                </div>
                <div class="input-group mb-1">
                    <div class="input-group-append text">
                        <p>Wednesday</p>
                    </div>
                    <input type="text" placeholder="9am-4pm" name="wednesday-pref" id="wednesday-pref"
                        class="form-control form-control-sm input_user ">
                </div>
                <div class="input-group mb-1">
                    <div class="input-group-append text">
                        <p>Thursday</p>
                    </div>
                    <input type="text" placeholder="9am-4pm" name="thursday-pref" id="thursday-pref"
                        class="form-control form-control-sm input_user ">
                </div>
                <div class="input-group mb-1">
                    <div class="input-group-append text">
                        <p>Friday</p>
                    </div>
                    <input type="text" placeholder="9am-4pm" name="friday-pref" id="friday-pref"
                        class="form-control form-control-sm input_user ">
                </div>
                <div class="input-group mb-1">
                    <div class="input-group-append text">
                        <p>Saturday</p>
                    </div>
                    <input type="text" placeholder="9am-4pm" name="saturday" id="saturday-pref"
                        class="form-control form-control-sm input_user ">
                </div>

                <div class="d-flex justify-content-center mt-3 submit-container">
                    <button type="button" name="button" id="submit-pref" class="btn submit_btn">submit</button>
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
                    <textarea type="text" name="textarea" id="message" cols="30" rows="10"
                        placeholder="I need so and so off because... " class="form-control form-control-sm input_user "
                        required></textarea>


                    <!-- <text type="text" placeholder="I need so and so off because... " name="request" id="message"  class="form-control form-control-sm input_user input-size"  > -->
                </div>

            </div>
            <div class="d-flex justify-content-center mt-3 submit-container">
                <button type="button" name="button" id="submit_sr" class="btn submit_btn">submit</button>
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
            var uuid = "<?php echo $uuid; ?>";
            var name = "<?php echo $name; ?>";
            var username = "<?php echo $username; ?>";
            var monday_avil = $('#monday-avil').val();
            var tuesday_avil = $('#tuesday-avil').val();
            var wednesday_avil = $('#wednesday-avil').val();
            var thursday_avil = $('#thursday-avil').val();
            var friday_avil = $('#friday-avil').val();
            var saturday_avil = $('#saturday-avil').val();
            $.ajax({
                url: '/php/db_handling/handling/add_avil.php',
                type: 'POST',
                data: {
                    uuid: uuid,
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
                    Notiflix.Notify.success('Your request has been submited');
                },
                error: function(data) {
                    Notiflix.Notify.failure('Somthings not right, Error code:' + data);
                }
            });
        }
    });
});
</script>
<script>
$(function() {
    $('#submit-pref').click(function(e) {

        var valid = this.form.checkValidity();

        if (valid) {
            var uuid = "<?php echo $uuid; ?>";
            var name = "<?php echo $name; ?>";
            var username = "<?php echo $username; ?>";
            var monday_pref = $('#monday-pref').val();
            var tuesday_pref = $('#tuesday-pref').val();
            var wednesday_pref = $('#wednesday-pref').val();
            var thursday_pref = $('#thursday-pref').val();
            var friday_pref = $('#friday-pref').val();
            var saturday_pref = $('#saturday-pref').val();
            // var hours = $('#hours').val();
            // console.log(hours);
            $.ajax({
                url: '/php/db_handling/handling/add_pref.php',
                type: 'POST',
                data: {
                    uuid: uuid,
                    name: name,
                    username: username,
                    monday: monday_pref,
                    tuesday: tuesday_pref,
                    wednesday: wednesday_pref,
                    thursday: thursday_pref,
                    friday: friday_pref,
                    saturday: saturday_pref,
                    // hours: hours
                },
                success: function(data) {
                    if ($.trim(data) === "100") {

                        Notiflix.Notify.success('Your request has been submited');
                    }
                    if ($.trim(data) === "200") {
                        Notiflix.Notify.failure(
                            'There were erros while saving the data, Error:' + data);
                    }
                },
                error: function(data) {
                    Notiflix.Notify.failure('Somthings not right, Error:' + data);
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
            var uuid = "<?php echo $uuid; ?>";
            var name = "<?php echo $name; ?>";
            var message = $('#message').val();
            $.ajax({
                url: '/php/db_handling/handling/add_sr.php',
                type: 'POST',
                data: {
                    uuid: uuid,
                    name: name,
                    message: message
                },
                success: function(data) {
                    Notiflix.Notify.success('Your request has been submited');
                },
                error: function(data) {
                    Notiflix.Notify.failure('Somthings not right, Error code:' + data);
                }
            });
        }
    });
});
</script>

<?php
} else {
}


include_once("php/template.php");
echo $footer;
?>