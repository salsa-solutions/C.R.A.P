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
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/backround.css">
    <link rel="stylesheet" href="css/home.css">
    <title>Home | Capriotti's Regional Attendance Program</title>
</head>

<body>
    <div class="nav">
        <ul>
            <div class="nav-links">
                <li><a href="/index.php">Home</a></li>
                <li><a href="/schedule.php">Schedule</a></li>
                <li><a href="/test.php">Test</a></li>
            </div>
            <div class="mt-2 ">
                <button type="button" name="button" id="logOut" class="btn btn_logout">Log Out</button>
            </div>
        </ul>
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
                            <input type="text" placeholder="9am-4pm" name="monday-avil" id="monday-avil" class="form-control form-control-sm input_user " required>
                        </div>
                        <div class="input-group mb-1">
                            <div class="input-group-append text">
                                <p>Tuesday</p>
                            </div>
                            <input type="text" placeholder="9am-4pm" name="tuesday-avil" id="tuesday-avil" class="form-control form-control-sm input_user " required>
                        </div>
                        <div class="input-group mb-1">
                            <div class="input-group-append text">
                                <p>Wednesday</p>
                            </div>
                            <input type="text" placeholder="9am-4pm" name="wednesday-avil" id="wednesday-avil" class="form-control form-control-sm input_user " required>
                        </div>
                        <div class="input-group mb-1">
                            <div class="input-group-append text">
                                <p>Thursday</p>
                            </div>
                            <input type="text" placeholder="9am-4pm" name="thursday-avil" id="thursday-avil" class="form-control form-control-sm input_user " required>
                        </div>
                        <div class="input-group mb-1">
                            <div class="input-group-append text">
                                <p>Friday</p>
                            </div>
                            <input type="text" placeholder="9am-4pm" name="friday-avil" id="friday-avil" class="form-control form-control-sm input_user " required>
                        </div>
                        <div class="input-group mb-1">
                            <div class="input-group-append text">
                                <p>Saturday</p>
                            </div>
                            <input type="text" placeholder="9am-4pm" name="saturday-avil" id="saturday-avil" class="form-control form-control-sm input_user " required>
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
                            <input type="text" placeholder="9am-4pm" name="monday-pref" id="monday-pref" class="form-control form-control-sm input_user " required>
                        </div>
                        <div class="input-group mb-1">
                            <div class="input-group-append text">
                                <p>Tuesday</p>
                            </div>
                            <input type="text" placeholder="9am-4pm" name="tuesday-pref" id="tuesday-pref" class="form-control form-control-sm input_user " required>
                        </div>
                        <div class="input-group mb-1">
                            <div class="input-group-append text">
                                <p>Wednesday</p>
                            </div>
                            <input type="text" placeholder="9am-4pm" name="wednesday-pref" id="wednesday-pref" class="form-control form-control-sm input_user " required>
                        </div>
                        <div class="input-group mb-1">
                            <div class="input-group-append text">
                                <p>Thursday</p>
                            </div>
                            <input type="text" placeholder="9am-4pm" name="thursday-pref" id="thursday-pref" class="form-control form-control-sm input_user " required>
                        </div>
                        <div class="input-group mb-1">
                            <div class="input-group-append text">
                                <p>Friday</p>
                            </div>
                            <input type="text" placeholder="9am-4pm" name="friday-pref" id="friday-pref" class="form-control form-control-sm input_user " required>
                        </div>
                        <div class="input-group mb-1">
                            <div class="input-group-append text">
                                <p>Saturday</p>
                            </div>
                            <input type="text" placeholder="9am-4pm" name="saturday" id="saturday-pref" class="form-control form-control-sm input_user " required>
                        </div>
                        <div class="input-group mb-1">
                            <input type="number" placeholder="Hours" name="hours" id="hours" class="form-control form-control-sm input_user" min=1 max=40 required>
                        </div>
                        <div class="d-flex justify-content-center mt-3 sumbit-container">
                            <button type="button" name="button" id="sumbit-pref" class="btn submit_btn">sumbit</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>

    <script>
        $(function() {
            $('#submit_avil').click(function(e) {

                var valid = this.form.checkValidity();

                if (valid) {
                    var name = "<?php echo $_SESSION['userlogin']; ?>";
                    var monday_avil = $('#monday-avil').val();
                    var tuesday_avil = $('#tuesday-avil').val();
                    var wednesday_avil = $('#wednesday-avil').val();
                    var thursday_avil = $('#thursday-avil').val();
                    var friday_avil = $('#friday-avil').val();
                    var saturday_avil = $('#saturday-avil').val();
                    $.ajax({
                        url: 'add_avil.php',
                        type: 'POST',
                        data: {
                            name: name,
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
                                '<a href="login.php" class="ml-2">Log in</a>',
                                'success'
                            )
                        },
                        error: function(data) {
                            Swal.fire(
                                'Errors',
                                'how did you fuck up this bad',
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
                    var name = "<?php echo $_SESSION['userlogin']; ?>";
                    var monday_pref = $('#monday-pref').val();
                    var tuesday_pref = $('#tuesday-pref').val();
                    var wednesday_pref = $('#wednesday-pref').val();
                    var thursday_pref = $('#thursday-pref').val();
                    var friday_pref = $('#friday-pref').val();
                    var saturday_pref = $('#saturday-pref').val();
                    var hours = $('#hours').val();
                    // console.log(hours);
                    $.ajax({
                        url: 'add_pref.php',
                        type: 'POST',
                        data: {
                            name: name,
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
                                '<a href="login.php" class="ml-2">Log in</a>',
                                'success'
                            )
                        },
                        error: function(data) {
                            Swal.fire(
                                'Errors',
                                'how did you fuck up this bad',
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
            $('#logOut').click(function() {
                window.location.href = "logout.php?logout=true";
            })
        });
    </script>
    <div class="footer">
        <footer>
            <p>you are logged in as: <?php echo $_SESSION['userlogin']; ?> </p>
        </footer>
    </div>
</body>

</html>