<?php
require_once('/var/www/html/config.php');
require_once('/var/www/html/pages/page-index.php');
require_once('/var/www/html/php/functions/permissons.php');


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
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Status</th>
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
                                        <?php
                                        function getUserRoles()
                                        {
                                            include('/var/www/html/config.php');
                                            $result = $db->prepare("SELECT * FROM users ORDER BY username ASC");
                                            $result->execute();
                                            $i = 0;
                                            $users = array();
                                            while ($row = $result->fetch()) {
                                                $user = array();
                                                $user['id'] = $row['id'];
                                                $user['username'] = $row['username'];
                                                $user['name'] = $row['name'];
                                                $user['registration_date'] = $row['registration_date'];
                                                $user['active'] = $row['active'];
                                                $user['uuid'] = $row['uuid'];
                                                $user['role'] = $row['role'];
                                                if ($user['role'] == 'pending') {
                                                    $roles = array();
                                                    $result2 = $db->prepare("SELECT * FROM roles ORDER BY role_name ASC");
                                                    $result2->execute();
                                                    while ($row2 = $result2->fetch()) {
                                                        $roles[] = array('value' => $row2['role'], 'name' => $row2['role_name']);
                                                    }
                                                    $user['roles'] = $roles;
                                                }
                                                $users[] = $user;
                                                $i++;
                                            }
                                            if ($i == 0) {
                                                $users[] = array('message' => 'No new users registered');
                                            }
                                            return $users;
                                        }
                                        ?>

                                        <tbody>
                                            <?php
                                            $users = getUserRoles();
                                            foreach ($users as $user) {
                                                if ($user['role'] == 'pending') {
                                                    echo '<form action="">' . "\n";
                                                    echo '<tr>' . "\n";
                                                    echo '<td id="username">' . $user['username'] . '</td>' . "\n";
                                                    echo '<td id="name">' . $user['name'] . '</td>' . "\n";
                                                    echo '<td id="date">' . $user['registration_date'] . '</td>' . "\n";
                                                    echo '<td id="status">' . $user['active'] . '</td>' . "\n";
                                                    echo '<td id="role_selection">' . "\n";
                                                    echo '<label for="role"></label>' . "\n";
                                                    echo '<select id="role" name="role">' . "\n";
                                                    if (isset($user['roles'])) {
                                                        foreach ($user['roles'] as $role) {
                                                            echo '<option value="' . $role['name'] . '">' . $role['name'] . '</option>' . "\n";
                                                        }
                                                    }
                                                    echo '</select>' . "\n";
                                                    echo '</td>' . "\n";
                                                    echo '<td>' . "\n";
                                                    if (isset($user['roles'])) {
                                                        echo '<button class="btn btn-success" value="' . $user['uuid'] . '" id="approved-' . $user['id'] . '">Approve</button>' . "\n";
                                                    }
                                                    // echo '<button class="btn btn-success" id="approved-' . $user['id'] . '">Approve</button>';
                                                    // echo '<button class="btn btn-danger" id="denyied">Deny</button>';
                                                    echo '</td>' . "\n";
                                                    echo '</tr>' . "\n";
                                                    echo '</form>';
                                                }
                                            }
                                            ?>
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
                                                            url: '/php/db_handling/handling/approved.php',
                                                            type: 'POST',
                                                            data: {
                                                                uuid: uuid,
                                                                role_name: role_name,

                                                            },
                                                            success: function(data) {
                                                                console.log(data);
                                                                if ($.trim(data) === "100") {
                                                                    Notiflix.Notify.success(
                                                                        'Your role has been submitted'
                                                                    );
                                                                }
                                                                if ($.trim(data) === "200") {
                                                                    Notiflix.Notify.failure(
                                                                        'There were errors while saving the data, Error: ' +
                                                                        data);
                                                                }
                                                                if ($.trim(data) === "300") {
                                                                    Notiflix.Notify.failure(
                                                                        'No Data, Error: ' +
                                                                        data);
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










            <?php require("/var/www/html/php/template.php");
            echo $footer ?>