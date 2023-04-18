<?php
require_once '/var/www/html/config.php';
require_once '/var/www/html/pages/page-index.php';
session_start();

if (isset($session_id) && isset($_SESSION['name']) && isset($_SESSION['username']) && isset($_SESSION['role']) && isset($_SESSION['role_name']) && isset($_SESSION['uid'])) {
    header('Location: ' . $home_page_url . '');
}
$WEB_TITLE = 'Login';

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

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

    <script src="
    https://cdn.jsdelivr.net/npm/notiflix/dist/notiflix-3.2.5.min.js
"></script>
    <link href="
https://cdn.jsdelivr.net/npm/notiflix/dist/notiflix-3.2.5.min.css
" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/css/backround.css">
    <link rel="stylesheet" href="/css/login-signup.css">
    <title><?php echo $WEB_TITLE ?> | <?php echo $WEBSITE_NAME; ?></title>
</head>

<body>
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
                                <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                            </div>
                            <input type="text" placeholder="Username" name="username" id="username" class="form-control input_user" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" placeholder="Password" name="password" id="password" class="form-control input_pass" required>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="rememberme" class="custom-control-input" id="customControlInline">
                                <label for="customControlInline" class="custom-control-label">Remember Me</label>
                            </div>
                        </div>

                </div>
                <div class="d-flex justify-content-center mt-3 login-container">
                    <button type="button" name="button" id="login" class="btn login_btn">Login</button>
                </div>
                <div class="mt-4 ">
                    <div class="d-flex justify-content-center links">
                        <button type="button" name="button" id="register" class="btn login_btn">Register</button>
                    </div>
                </div>
                </form>

                <div class="d-flex justify-content-center">
                    <a style="color: white; text-decoration: none;" href="sorry.html">Forgot Password?</a>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        $(function() {
            $('#login').click(function(e) {

                var valid = this.form.checkValidity();

                if (valid) {
                    var username = $('#username').val();
                    var password = $('#password').val();


                    e.preventDefault();

                    $.ajax({
                        type: 'POST',
                        url: '/php/login_registration/jslogin.php',
                        data: {
                            username: username,
                            password: password
                        },

                        success: function(data) {
                            if ($.trim(data) === "100") {
                                Notiflix.Report.warning(
                                    'User doesnt exist',
                                    'User not found. Did you sign up?',
                                    'Okay',
                                );
                            }

                            if (data === "200") {
                                Notiflix.Report.warning(
                                    'Mismatched password',
                                    'Wrong password, I really hope you didnt forget it.',
                                    'Okay',
                                );
                            }
                            if (data === "300") {
                                console.log(data);
                                setTimeout(' window.location.href =  <?php echo $home_page_url; ?>/', 1000);
                            }
                            if (data === "400") {
                                Notiflix.Report.failure(
                                    'Critical Error!',
                                    'System error. Please contact support! <br/> Error code: ' + data,
                                    'Okay',
                                );
                            }
                        },
                        error: function(data) {
                            function getStatusCode(url, callback) {
                                var xhr = new XMLHttpRequest();
                                xhr.open('GET', url, true);
                                xhr.onload = function() {
                                    callback(xhr.status);
                                };
                                xhr.send();
                            }

                            // Example usage:
                            getStatusCode('/php/login_registration/jslogin.php', function(statusCode) {
                                var message = 'There was an error while processing your request.';
                                message += '\nURL: ' + '/php/login_registration/jslogin.php';
                                message += '\nStatus code: ' + statusCode;

                                // Send the error message to a SQL database using PHP
                                var xmlhttp = new XMLHttpRequest();
                                xmlhttp.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200) {
                                        console.log('Error message sent to SQL database.');
                                    }
                                };
                                xmlhttp.open('GET', '/php/error_handler.php?message=' + encodeURIComponent(message), true);
                                xmlhttp.send();

                                // Display the error message to the user
                                Notiflix.Report.failure('System error. Contact support!', message, 'Okay');
                            });

                        }


                    });
                }
            });
        });
    </script>
    <script>
        $(function() {
            $('#register').click(function() {
                window.location.href = "/pages/login/registration.php";
            })
        });
    </script>
</body>

</html>