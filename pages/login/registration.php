<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once('/var/www/html/config.php');

$WEB_TITLE = 'User Registration';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/css/backround.css">
    <link rel="stylesheet" href="/css/login-signup.css">


    <title><?php echo $WEB_TITLE ?> | <?php echo $WEBSITE_NAME; ?></title>
</head>

<body>
    <style>
        .user_card {
            height: 530px;
            width: 350px;
            margin-top: auto;
            margin-bottom: auto;
            background: #19138d;
            position: relative;
            display: flex;
            justify-content: center;
            flex-direction: column;
            padding: 10px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            -webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            -moz-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            border-radius: 5px;
        }
    </style>

    <!-- <script>
        $(document).ready(function() {
            var numInputs = $('.input-group').length;
            var userCardHeight = 40 + (numInputs * 50);
            var brandLogoTop = -75 - (numInputs * 25);

            $('.user_card').height(userCardHeight);
            $('.brand_logo_container').css('top', brandLogoTop);
        });
    </script> -->

    <div class="bg"></div>
    <div class="bg bg2"></div>
    <div class="bg bg3"></div>

    <div class="header">
        <h1>
            <?php echo $WEBSITE_NAME; ?>
        </h1>
    </div>


    <div class="container h-100">
        <div class="d-flex justify-content-center h-100">
            <div class="user_card">
                <div class="d-flex justify-content-center p-5">
                    <div class="brand_logo_container">
                    <img src="/img/logo.jpg" class="brand_logo" alt="Logo">
                    </div>
                </div>
                <div class="d-flex justify-content-center form-container">
                    <form action="">
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" placeholder="Jane" name="firstname" id="firstname" class="form-control input_user" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" placeholder="Doe" name="lastname" id="lastname" class="form-control input_user" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            <input type="text" placeholder="1234567890" name="phone" id="phone" class="form-control input_user" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-at"></i></span>
                            </div>
                            <input type="text" placeholder="johndoe@example.com" name="email" id="email" class="form-control input_user" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            </div>
                            <input type="text" placeholder="Username" name="username" id="username" class="form-control input_user" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" placeholder="Password" name="password" id="password" class="form-control input_pass" required>
                        </div>
                        <div class="d-flex justify-content-center mt-3 login-container">
                            <button type="button" name="button" id="register" class="btn login_btn">Register</button>
                        </div>
                        <div class="mt-4 ">
                            <div class="d-flex justify-content-center links">
                                <button type="button" name="button" id="login" class="btn login_btn">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        $(function() {
            $('#register').click(function(e) {

                var valid = this.form.checkValidity();

                if (valid) {


                    var firstname = $('#firstname').val();
                    var lastname = $('#lastname').val();
                    var email = $('#email').val();
                    var phone = $('#phone').val();
                    var username = $('#username').val();
                    var password = $('#password').val();


                    e.preventDefault();

                    $.ajax({
                        type: 'POST',
                        url: '/php/login_registration/process.php',
                        data: {
                            firstname: firstname,
                            lastname: lastname,
                            email: email,
                            phone: phone,
                            username: username,
                            password: password
                        },
                        success: function(data) {
                            Swal.fire(
                                'Successful',
                                '<a href="login.php" class="ml-2">Log in</a>',
                                'success'
                            )

                        },
                        error: function(data) {
                            Swal.fire(
                                'Errors',
                                'There were errors while saving the data.',
                                'error'
                            )
                        }
                    });


                } else {

                }

            });


        });
    </script>

    <script>
        $(function() {
            $('#login').click(function() {
                window.location.href = "login.php";
            })
        });
    </script>

</body>

</html>