<?php
require_once('/var/www/html/config.php');
require_once('/var/www/html/pages/page-index.php');
require_once('/var/www/html/php/functions/permissons.php');


session_start();
$session_id = session_id();



if (!isset($session_id) || !isset($_SESSION['name']) && !isset($_SESSION['username']) && !isset($_SESSION['role']) && !isset($_SESSION['role_name']) && !isset($_SESSION['uuid'])) {
    header('Location: ' . $login_page_url . '');
}

$name = $_SESSION['name'];
$username = $_SESSION['username'];
$role = $_SESSION['role'];
$role_name = $_SESSION['role_name'];
$uid = $_SESSION['uuid'];

$WEB_TITLE = 'Approval';


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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="
    https://cdn.jsdelivr.net/npm/notiflix/dist/notiflix-3.2.5.min.js
"></script>
    <link href="
https://cdn.jsdelivr.net/npm/notiflix/dist/notiflix-3.2.5.min.css
" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/css/home.css">
    <link rel="stylesheet" href="/css/nav.css">
    <title><?php echo $WEB_TITLE ?> | <?php echo $WEBSITE_NAME; ?></title>
</head>

<?php require("/var/www/html/php/template.php");
echo $header ?>
<?php if (($_DEV) && (($role == 'employee') || ($role == 'manager')) == '1') {
    echo $out_of_service;
} elseif (($role == 'employee')) {
    echo $fourohthree;
} elseif (($role == 'pending')) {
    echo $pending;
} else {
?>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="text-center">Approval</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h3 class="text-center">Pending User Requests</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">Username</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Role</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            include('/var/www/html/config.php');
                                            $result = $db->prepare("SELECT * FROM users ORDER BY username ASC");
                                            $result->execute();
                                            for ($i = 0; $row = $result->fetch(); $i++) {
                                                if ($row['role'] == 'pending') {


                                            ?>
                                                    <form action="">
                                                        <tr>
                                                            <td id="username"><?php echo $row['username'] ?></td>
                                                            <td id="name"><?php echo $row['name']; ?></td>
                                                            <td id="date"><?php echo $row['registration_date'] ?></td>
                                                            <td id="status"><?php echo $row['active'] ?></td>
                                                            <td id="role_selection">
                                                                <label for="role"></label>
                                                                <select id="role" name="role">
                                                                    <?php

                                                                    $result = $db->prepare("SELECT * FROM role_name ORDER BY role_name ASC");
                                                                    $result->execute();
                                                                    for ($i = 0; $row = $result->fetch(); $i++) {
                                                                        echo '<option value="' . $row['role'] . '">' . $row['role_name'] . '</option>';
                                                                    }
                                                                    ?>
                                                                    <!-- <option value="Server">Server</option>
                                                                    <option value="Cook">Cook</option>
                                                                    <option value="Manager">Manager</option>
                                                                    <option value="Admin">Admin</option> -->
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-success" id="<?php echo $row['uuid']; ?>_approved">Approve</button>
                                                                <button class="btn btn-danger" id="<?php echo $row['uuid']; ?>_deny">Deny</button>
                                                            </td>
                                                        </tr>
                                                    </form>
                                                    <script>
                                                        $(function() {
                                                            $('#<?php echo $row['uuid']; ?>_approved').click(function(e) {
                                                                var valid = this.form.checkValidity();
                                                                if (valid) {
                                                                    var id = '<?php echo $row['uid']; ?>';
                                                                    var role = $('#role').val();
                                                                    console.info(role);
                                                                    $.ajax({
                                                                        url: '/php/db_handling/handling/approved.php',
                                                                        type: 'POST',
                                                                        data: {
                                                                            id: id,
                                                                            role: role
                                                                        },
                                                                        success: function(data) {

                                                                        },
                                                                        error: function(data) {}
                                                                    });
                                                                }
                                                            });
                                                        });
                                                    </script>

                                                    <script>
                                                        $(function() {
                                                            $('#<?php echo $row['uid']; ?>_deny').click(function(e) {
                                                                var valid = this.form.checkValidity();
                                                                if (valid) {
                                                                    var id = '<?php echo $row['uid']; ?>';
                                                                    $.ajax({
                                                                        url: '/php/db/handling/denied.php',
                                                                        type: 'POST',
                                                                        data: {
                                                                            id: id
                                                                        },
                                                                        success: function(data) {
                                                                            if ($.trim(data) === "100") {

                                                                                Notiflix.Notify.success('Your request has been submited');
                                                                            }
                                                                            if ($.trim(data) === "200") {
                                                                                Notiflix.Notify.failure('There were erros while saving the data, Error:' + data);
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
                                        <?php
                                                } elseif ($i == 0) {
                                                    echo '<td colspan="8">No new users registered</td>';
                                                }

                                                // echo $i;

                                            }
                                        }


                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    </div>
    <?php require("/var/www/html/php/template.php");
    echo $footer ?>

</html>