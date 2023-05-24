<?php
require_once('/var/www/html/config.php');
require_once('/var/www/html/pages/page-index.php');
require_once('/var/www/html/php/functions/permissons.php');
require_once('/var/www/html/php/functions/select.php');


session_start();
$session_uuid = session_id();



if (!isset($session_uuid) || !isset($_SESSION['name']) && !isset($_SESSION['username']) && !isset($_SESSION['role']) && !isset($_SESSION['role_name']) && !isset($_SESSION['uuuuid'])) {
    header('Location: ' . $login_page_url . '');
}

$name = $_SESSION['name'];
$username = $_SESSION['username'];
$role = $_SESSION['role'];
$role_name = $_SESSION['role_name'];
$uuid = $_SESSION['uuid'];

$WEB_TITLE = 'Scheduling';


setAccessPages($role);

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
    <link rel="stylesheet" href="/css/home.css">
    <link rel="stylesheet" href="/css/nav.css">
    <link rel="stylesheet" href="/css/scheduling.css">
    <title><?php echo $WEB_TITLE ?> | <?php echo $WEBSITE_NAME; ?></title>

</head>
<style>
    .container {
        max-width: fit-content !important;
    }
</style>

<body>
    <?php require '/var/www/html/php/template.php';
    echo $header; ?>
    <?php if (($_DEV) && (($role == 'Server') || ($role == 'Manager') || ($role == 'Cook')) == '1') {
        echo $out_of_service;
    } elseif (($role == 'Server')) {
        echo $fourohthree;
    } elseif (($role == 'pending')) {
        echo $pending;
    } else {
    ?>

        <div class="container h-100 scroll">
            <div class="row">
                <div class="col-12">
                    <h1 class="text-center"><?php echo $WEB_TITLE; ?></h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h3 class="text-center">Pending Schedules</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>

                                                <th scope="col">Monday</th>
                                                <th scope="col">Tuesday</th>
                                                <th scope="col">Wednesday</th>
                                                <th scope="col">Thursday</th>
                                                <th scope="col">Friday</th>
                                                <th scope="col">Saturday</th>
                                                <th scope="col">Sunday</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            include('/var/www/html/config.php');
                                            $result = $db->prepare("SELECT * FROM pending_shifts ORDER BY name ASC");
                                            $result->execute();
                                            for ($i = 0; $row = $result->fetch(); $i++) {
                                                $userName = $row['name'];
                                            ?>

                                                <!-- <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['status']; ?></td> -->
                                                <td>
                                                    <select name="monday" style="font-size: small;" id="">
                                                        <option value=""><?php echo $row['name'] . " - ";
                                                                            echo $row['monday']; ?></option>
                                                        <?php echo get_shift_options($db, 'Monday', false, null, $userName); ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="tuesday" style="font-size: small;" id="">
                                                        <option value=""><?php echo $row['name'] . " - ";
                                                                            echo $row['tuesday']; ?></option>
                                                        <?php echo Get_shift_options($db, 'Tuesday', false); ?>
                                                    </select>
                                                </td>


                                                <td>
                                                    <select name="wednesday" style="font-size: small;" id="">
                                                        <option value=""><?php echo $row['name'] . " - ";
                                                                            echo $row['wednesday']; ?></option>
                                                        <?php echo Get_shift_options($db, 'Wednesday', false); ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="thursday" style="font-size: small;" id="">
                                                        <option value=""><?php echo $row['name'] . " - ";
                                                                            echo $row['thursday']; ?></option>
                                                        <?php echo Get_shift_options($db, 'Thursday', false); ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="friday" style="font-size: small;" id="">
                                                        <option value="<?php echo $row['friday']; ?>">
                                                            <?php echo $row['name'] . " - ";
                                                            echo $row['friday']; ?></option>
                                                        <?php echo Get_shift_options($db, 'Friday', false); ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="saturday" style="font-size: small;" id="">
                                                        <option value="<?php echo $row['saturday']; ?>">
                                                            <?php echo $row['name'] . " - ";
                                                            echo $row['saturday']; ?></option>
                                                        <?php echo Get_shift_options($db, 'Saturday', false); ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="sunday" style="font-size: small;" id="">
                                                        <option value="<?php echo $row['saturday']; ?>">
                                                            <?php echo $row['name'] . " - ";
                                                            echo $row['sunday']; ?></option>
                                                        <?php echo Get_shift_options($db, 'Sunday', false); ?>
                                                    </select>
                                                </td>

                                                <td>
                                                    <button class="btn btn-success" value="<?php echo $row['uuid']  ?>" id="approved-<?php echo $row['uuid']  ?>">Approve</button>
                                                </td>

                                        </tbody>
                                    <?php
                                            }
                                            if ($i == 0) {
                                                echo '<td colspan="8">Schedule has not been posted yet</td>';
                                            }
                                    ?>
                                    </table>
                                    <script>
                                        var buttons = document.querySelectorAll(".btn-success");

                                        // Loop through the buttons and add a click event listener to each one
                                        buttons.forEach(function(button) {
                                            button.addEventListener("click", function() {
                                                // Get the value of the button that was clicked
                                                var uuid = this.value;

                                                var role_name = $('#role').val();
                                                console.log(role);

                                                $.ajax({
                                                    url: '/php/db_handling/handling/add_current.php',
                                                    type: 'POST',
                                                    data: {
                                                        uuid: uuid,
                                                        role_name: role_name,

                                                    },
                                                    success: function(data) {
                                                        console.log(data);
                                                        if ($.trim(data) === "100") {
                                                            Notiflix.Notify.success(
                                                                'Your role has been submitted');
                                                        }
                                                        if ($.trim(data) === "200") {
                                                            Notiflix.Notify.failure(
                                                                'There were errors while saving the data, Error: ' +
                                                                data);
                                                        }
                                                        if ($.trim(data) === "300") {
                                                            Notiflix.Notify.failure(
                                                                'No Data, Error: ' + data);
                                                        }
                                                    },
                                                    error: function(data) {
                                                        Notiflix.Notify.failure(
                                                            'Something is not right, Error: ' +
                                                            data);
                                                    }
                                                });
                                            });
                                        });
                                    </script>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                </div>
            </div>
        </div>











        <?php require("/var/www/html/php/template.php");
        echo $footer ?>