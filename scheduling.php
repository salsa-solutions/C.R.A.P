<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['userlogin'])) {
    header('Location: login.php');
}

$name = $_SESSION['userlogin'][0];
$role = $_SESSION['userlogin'][1];
$username = $_SESSION['userlogin'][2];
$status = $_SESSION['userlogin'][3];
$WEB_TITLE = 'Scheduling';
// to turn off a site uncomment the following line:
// $_DEV = true;
if (($role == 'Admin')) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}
if (($role == 'Admin') || ($role == 'Manager')) {
    $managment = 'Management';
    $Admin_page = '<a href="/admin.php">Admin</a>';
    $scheduling_page = '<a href="/scheduling.php">Scheduling</a>';
    $approval = '<a href="/approval.php">Approval</a>';
} else {
    $Admin_page = null;
    $scheduling_page = null;
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
    <link rel="stylesheet" href="css/scheduling.css">
    <link rel="stylesheet" href="css/nav.css">
    <title><?php echo $WEB_TITLE ?> | <?php echo $WEBSITE_NAME; ?></title>

</head>

<body>
    <?php require 'php/template.php';
    echo $header; ?>
    <?php if (($_DEV) && (($role == 'Server') || ($role == 'Manager') || ($role == 'Cook')) == '1') {
        echo $out_of_service;
    } elseif (($role == 'Server')) {
        echo $fourohthree;
    } elseif (($status == 'pending')) {
        echo $pending;
    } else {
    ?>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Scheduling</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Monday</th>
                                    <th scope="col">Tuesday</th>
                                    <th scope="col">Wednesday</th>
                                    <th scope="col">Thursday</th>
                                    <th scope="col">Friday</th>
                                    <th scope="col">Saturday</th>
                                    <!-- <th scope="col">hours</th> -->
                                </tr>
                            </thead>


                            <?php
                            include('config.php');
                            $result = $db->prepare("SELECT * FROM avil_day ORDER BY name ASC");
                            $result->execute();
                            for ($i = 0; $row = $result->fetch(); $i++) {
                                if ($row['approved'] == 'pending') {



                            ?>
                                    <tbody>
                                        <form action="">
                                            <td><?php echo $row['name']; ?></td>
                                            <td><input style="width: 90px ;" id="<?php echo $row['id']?>_monday-sched" placeholder="<?php echo $row['monday']; ?>"></td>
                                            <td><input style="width: 90px ;" id="<?php echo $row['id']?>_tuesday-sched" placeholder="<?php echo $row['tuesday']; ?>"></td>
                                            <td><input style="width: 90px ;" id="<?php echo $row['id']?>_wednesday-sched" placeholder="<?php echo $row['wednesday']; ?>"></td>
                                            <td><input style="width: 90px ;" id="<?php echo $row['id']?>_thursday-sched" placeholder="<?php echo $row['thursday']; ?>"></td>
                                            <td><input style="width: 90px ;" id="<?php echo $row['id']?>_friday-sched" placeholder="<?php echo $row['friday']; ?>"></td>
                                            <td><input style="width: 90px ;" id="<?php echo $row['id']?>_saturday-sched" placeholder="<?php echo $row['saturday']; ?>"></td>
                                            <!-- <td><input style="width: 90px ;" id="hours" placeholder="<?php echo $row['username']; ?>"></td> -->
                                            <td><button type="button" name="button" id="<?php echo $row['id']?>_sumbit_approved_sched" class="btn">sumbit</button></td>
                                        </form>
                                        <script>
                                            $(function() {
                                                $('#<?php echo $row['id']?>_sumbit_approved_sched').click(function(e) {

                                                    var valid = this.form.checkValidity();

                                                    if (valid) {
                                                        var id = '<?php echo $row['id']?>';
                                                        var approved = '<?php echo $name; ?>';
                                                        var name = "<?php echo $row['name']; ?>";
                                                        var username = "<?php echo $row['username']; ?>";
                                                        var monday_sched = $(
                                                                '#<?php echo $row['id']?>_monday-sched')
                                                            .val();
                                                        var tuesday_sched = $(
                                                                '#<?php echo $row['id']?>_tuesday-sched')
                                                            .val();
                                                        var wednesday_sched = $(
                                                                '#<?php echo $row['id']?>_wednesday-sched')
                                                            .val();
                                                        var thursday_sched = $(
                                                                '#<?php echo $row['id']?>_thursday-sched')
                                                            .val();
                                                        var friday_sched = $(
                                                                '#<?php echo $row['id']?>_friday-sched')
                                                            .val();
                                                        var saturday_sched = $(
                                                                '#<?php echo $row['id']?>_saturday-sched')
                                                            .val();
                                                        // var hours = $('#hours-sched').val();
                                                        // console.log(hours);
                                                        e.preventDefault();
                                                        $.ajax({
                                                            url: '/php/db_handling/add_current.php',
                                                            type: 'POST',
                                                            data: {
                                                                id: id,
                                                                approved: approved,
                                                                name: name,
                                                                username: username,
                                                                monday: monday_sched,
                                                                tuesday: tuesday_sched,
                                                                wednesday: wednesday_sched,
                                                                thursday: thursday_sched,
                                                                friday: friday_sched,
                                                                saturday: saturday_sched
                                                            },
                                                            success: function(data) {
                                                                
                                                            },
                                                            error: function(data) {
                                                                Swal.fire(
                                                                    'Errors',
                                                                    'huh... well that didnt happen',
                                                                    data,
                                                                    'error'
                                                                )

                                                            }
                                                        });
                                                    }
                                                });
                                            });
                                        </script>
                                    </tbody>


                        <?php
                                }
                                

                            
                            }
                            if ($i == 0) {
								echo '<td colspan="8">No schedules have been posted yet.</td>';
							}
                        }
                        ?>

                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- <input class="input-group input-group-append " type="text" placeholder="<?php echo $monday; ?>"> -->





        </div>

        <?php

        require 'php/template.php';
        echo $footer; ?>