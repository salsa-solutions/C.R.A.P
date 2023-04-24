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

$WEB_TITLE = 'Approval';


setAccessPages($role);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="wuuidth=device-wuuidth, initial-scale=1.0">
    <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
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
                                                $user['username'] = $row['username'];
                                                $user['name'] = $row['name'];
                                                $user['registration_date'] = $row['registration_date'];
                                                $user['active'] = $row['active'];
                                                $user['uuid'] = $row['uuid'];
                                                if ($row['role'] == 'pending') {
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
                                                echo '<form action="">';
                                                echo '<tr>';
                                                echo '<td id="username">' . $user['username'] . '</td>';
                                                echo '<td id="name">' . $user['name'] . '</td>';
                                                echo '<td id="date">' . $user['registration_date'] . '</td>';
                                                echo '<td id="status">' . $user['active'] . '</td>';
                                                echo '<td id="role_selection">';
                                                echo '<label for="role"></label>';
                                                echo '<select id="role" name="role">';
                                                if (isset($user['roles'])) {
                                                    foreach ($user['roles'] as $role) {
                                                        echo '<option value="' . $role['value'] . '">' . $role['name'] . '</option>';
                                                    }
                                                }
                                                echo '</select>';
                                                echo '</td>';
                                                echo '<td>';
                                                echo '<button class="btn btn-success" id="' . $user['uuid'] . '_approved">Approve</button>';
                                                echo '<button class="btn btn-danger" id="' . $user['uuid'] . '_deny">Deny</button>';
                                                echo '</td>';
                                                echo '</tr>';
                                                echo '</form>';
                                            }
                                            ?>
                                        <script>
                                        $(function() {
                                            $('[id$="_approved"]').click(function(e) {
                                                e.preventDefault();
                                                var valuuid = this.form.checkValuuidity();
                                                if (valuuid) {
                                                    var uuid = $(this).attr('uuid').split('_')[0];
                                                    var role = $(this).closest('tr').find(
                                                        'select[name=role]').val();
                                                    console.info(role);
                                                    $.ajax({
                                                        url: '/php/db_handling/handling/approved.php',
                                                        type: 'POST',
                                                        data: {
                                                            uuid: uuid,
                                                            role: role
                                                        },
                                                        success: function(data) {
                                                            if ($.trim(data) === "100") {
                                                                Notiflix.Notify.success('Your request has been submitted');
                                                                                    // Remove the row from the table
                                                                $(this).closest('tr').remove();
                                                            } else if ($.trim(data) === "200") {
                                                                Notiflix.Notify.failure('There were errors while saving the data, Error: ' + data);
                                                            }},
                                                            error: function(data) {
                                                                Notiflix.Notify.failure('Something went wrong, Error: ' + data);
                                                            }
                                                        });
                                                    }
                                                });
                                            });
                                        </script>
                                        <script>
                                           $(function() {
                                            $('[id$="_deny"]').click(function(e) {
                                                e.preventDefault();
                                                var valuuid = this.form.checkValuuidity();
                                                if (valuuid) {
                                                    var uuid = $(this).attr('uuid').split('_')[0];
                                                    var role = $(this).closest('tr').find(
                                                        'select[name=role]').val();
                                                    console.info(role);
                                                    $.ajax({
                                                        url: '/php/db_handling/handling/deny.php',
                                                        type: 'POST',
                                                        data: {
                                                            uuid: uuid,
                                                            role: role
                                                        },
                                                        success: function(data) {
                                                            if ($.trim(data) === "100") {
                                                                Notiflix.Notify.success('Your request has been submitted');
                                                                                    // Remove the row from the table
                                                                $(this).closest('tr').remove();
                                                            } else if ($.trim(data) === "200") {
                                                                Notiflix.Notify.failure('There were errors while saving the data, Error: ' + data);
                                                            }},
                                                            error: function(data) {
                                                                Notiflix.Notify.failure('Something went wrong, Error: ' + data);
                                                            }
                                                        });
                                                    }
                                                });
                                            });
                                        </script>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <?php } ?>
    <?php echo $footer ?>
</body>

</html>