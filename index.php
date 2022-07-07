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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/backround.css">
    <link rel="stylesheet" href="css/home.css">
    <title>Home | Capriotti's Regional Attendance Program</title>
</head>

<body>
    <div class="nav">
        <div class="mt-4 ">
            
                <button type="button" name="button" id="logOut" class="btn btn_logout">Log Out</button>
            
        </div>
    </div>
    <div class="container h-50">
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
                                <input type="text" placeholder="Monday" name="monday" id="monday" class="form-control form-control-sm input_user " required>
                            </div>
                            <div class="input-group mb-1">
                                <div class="input-group-append text">
                                    <p>Tuesday</p>
                                </div>
                                <input type="text" placeholder="Tuesday" name="tuesday" id="tuesday" class="form-control form-control-sm input_user " required>
                            </div>
                            <div class="input-group mb-1">
                                <div class="input-group-append text">
                                    <p>Wednesday</p>
                                </div>
                                <input type="text" placeholder="Wednesday" name="wednesday" id="wednesday" class="form-control form-control-sm input_user " required>
                            </div>
                            <div class="input-group mb-1">
                                <div class="input-group-append text">
                                    <p>Thursday</p>
                                </div>
                                <input type="text" placeholder="Thursday" name="thursday" id="thursday" class="form-control form-control-sm input_user " required>
                            </div>
                            <div class="input-group mb-1">
                                <div class="input-group-append text">
                                    <p>Friday</p>
                                </div>
                                <input type="text" placeholder="Friday" name="friday" id="friday" class="form-control form-control-sm input_user " required>
                            </div>
                            <div class="input-group mb-1">
                                <div class="input-group-append text">
                                    <p>Saturday</p>
                                </div>
                                <input type="text" placeholder="Saturday" name="saturday" id="saturday" class="form-control form-control-sm input_user " required>
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
                                <input type="text" placeholder="Monday" name="monday" id="monday" class="form-control form-control-sm input_user " required>
                            </div>
                            <div class="input-group mb-1">
                                <div class="input-group-append text">
                                    <p>Tuesday</p>
                                </div>
                                <input type="text" placeholder="Tuesday" name="tuesday" id="tuesday" class="form-control form-control-sm input_user " required>
                            </div>
                            <div class="input-group mb-1">
                                <div class="input-group-append text">
                                    <p>Wednesday</p>
                                </div>
                                <input type="text" placeholder="Wednesday" name="wednesday" id="wednesday" class="form-control form-control-sm input_user " required>
                            </div>
                            <div class="input-group mb-1">
                                <div class="input-group-append text">
                                    <p>Thursday</p>
                                </div>
                                <input type="text" placeholder="Thursday" name="thursday" id="thursday" class="form-control form-control-sm input_user " required>
                            </div>
                            <div class="input-group mb-1">
                                <div class="input-group-append text">
                                    <p>Friday</p>
                                </div>
                                <input type="text" placeholder="Friday" name="friday" id="friday" class="form-control form-control-sm input_user " required>
                            </div>
                            <div class="input-group mb-1">
                                <div class="input-group-append text">
                                    <p>Saturday</p>
                                </div>
                                <input type="text" placeholder="Saturday" name="saturday" id="saturday" class="form-control form-control-sm input_user " required>
                            </div>
                        </form>
                    </div>
                </div>

        </div>
                        
    </div>



    <script>
        $(function() {
            $('#logOut').click(function() {
                window.location.href = "index.php?logout=true";
            })
        });
    </script>
	<div class="footer">
		<footer>
			<h1></h1>
		</footer>
	</div>
</body>

</html>