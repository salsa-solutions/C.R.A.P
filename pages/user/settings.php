<?php
session_start();
require_once('/var/www/html/config.php');
require_once('/var/www/html/pages/page-index.php');
require_once('/var/www/html/php/functions/select.php');
require_once('/var/www/html/php/functions/permissons.php');

if (!isset($_SESSION['name']) || !isset($_SESSION['username']) || !isset($_SESSION['role']) || !isset($_SESSION['role_name']) || !isset($_SESSION['uuid'])) {
  header('Location: ' . $login_page_url . '');
}

if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION);
  header("Location: /pages/login/login.php");
}
$name = $_SESSION['name'];
$username = $_SESSION['username'];
$role = $_SESSION['role'];
$role_name = $_SESSION['role_name'];
$uuid = $_SESSION['uuid'];

$WEB_TITLE = 'Settings';
$account = getUsersDropdown($db)['dropdown'];
$account_id = getUsersDropdown($db)['uuid'];
$account_role = getUsersDropdown($db)['role'];

// to turn off a site uncomment the following line:
//$_DEV = true;
setAccessPages($role);

// echo '<pre>'; print_r($_SESSION['userlogin']); echo '</pre>';
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
  <script src="https://cdn.jsdelivr.net/npm/notiflix/dist/notiflix-3.2.5.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/notiflix/dist/notiflix-3.2.5.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="/css/home.css">
  <link rel="stylesheet" href="/css/nav.css">
  <link rel="stylesheet" href="/css/settings.css">
  <title><?php echo $WEB_TITLE; ?> | <?php echo $WEBSITE_NAME ?></title>

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


  <body>
    <br>
    <div class="settings container scroll">
      <h2>User Settings</h2>

      <h3>Change Password</h3>
      <form>
        <label for="current-password">Current Password:</label>
        <input type="password" id="current-password" name="current-password">
        <br>
        <label for="new-password">New Password:</label>
        <input type="password" id="new-password" name="new-password">
        <br>
        <label for="confirm-password">Confirm Password:</label>
        <input type="password" id="confirm-password" name="confirm-password">
        <br>
        <button type="submit">Change Password</button>
      </form>
      <br>
    </div>
    <?php
    if ($role == 'admin' || $role == 'manager' || $role == 'dev') {

    ?>
      <br>
      <div class="settings container scroll">
        <h2>Manage Users</h2>
        <h3>Update User Information</h3>
        <?php $user_dropdown = getUsersDropdown($db)['dropdown']; ?>
        <form>
          <label for="user">Select User:</label>
          <td id="user_selection">
            <label for="user"></label>
            <?php echo $user_dropdown; ?>
          </td>
          <label for="username">Username:</label>
          <input type="text" id="username" name="username">
          <br>
          <label for="email">Email:</label>
          <input type="email" id="email" name="email">
          <br>
          <label for="role">Role:</label>
          <td id="role_selection">
            <label for="role"></label>
            <select id="role" name="role">
              <?php //echo getRoles($db, $role); 
              ?>
            </select>
          </td>
          <br>
          <label for="status">Status:</label>
          <select id="status" name="status">
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
          </select>
          <br>
          <button class="button" type="submit" id="update_user">Save Changes</button>
        </form>
        <script>
          $(document).ready(function() {
            // When the user selection changes
            $('select[name="user_id"]').on('change', function() {
              // Get the selected user ID
              var userId = $(this).val();
              // Get the selected user's full name from the $ids array
              var userName = "<?php echo json_encode(getUsersDropdown($db)['uuid']); ?>";
              userName = JSON.parse(userName)[userId];
              // Set the ID of the submit button to the selected user's full name
              $('#update_user').attr('id', userName + '_update_user');
            });
          });
        </script>
      </div>
      <br>
      <div class="settings container scroll">
        <h3>Add New User</h3>
        <form>
          <label for="firstname">First Name:</label>
          <input type="text" id="firstname" name="firstname">
          <br>
          <label for="lastname">Last Name:</label>
          <input type="text" id="lastname" name="lastname">
          <br>
          <label for="username">Username:</label>
          <input type="text" id="username" name="username">
          <br>
          <label for="email">Email:</label>
          <input type="email" id="email" name="email">
          <br>
          <label for="role">Role:</label>
          <td id="role_selection">
            <label for="role"></label>
            <select id="role" name="role">
              <?php //echo getRoles($db, $role); 
              ?>
            </select>
          </td>
          <br>
          <label for="status">Status:</label>
          <select id="status" name="status">
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
          </select>
          <br>
          <button class="button" type="submit" id="add_user">Add User</button>
        </form>
      </div>
      <br>
      <div class="settings container scroll">
        <h3>Add New Role</h3>
        <form>
          <label>Role:</label>
          <input type="text" id="role-name">
          <br>
          <label>Role Description:</label>
          <input type="text" id="role-description">
          <br>
          <label>Role Permissions:</label>
          <select id="role-permisions">
            <option value="employee">Employee</option>
            <option value="manager">Manager</option>
            <option value="admin">Admin</option>
          </select>

          <br>
          <button class="button" type="submit" id="submit-role">Add Role</button>
        </form>
        <br>
        <br>
        <h4>Role cheat sheet</h4>
        <div class="role_cheat_sheet">
          <div class="role_cheat_sheet_item">
            <h5>Admin</h5>
            <p>Full access to everything</p>
          </div>
          <div class="role_cheat_sheet_item">
            <h5>Manager</h5>
            <p>Full access to Manager pages </p>
          </div>
          <div class="role_cheat_sheet_item">
            <h5>Employee</h5>
            <p>Full access to user features (i.e home page, schedule and settings )</p>
          </div>

        </div>
      </div>

    <?php
    }
    ?>

    <script>
      $(function() {
        $('#submit-role').click(function(e) {

          var valid = this.form.checkValidity();

          if (valid) {


            var created_by_uuid = "<?php echo $uuid; ?>";
            var created_by = "<?php echo $name; ?>";
            var role_name = $('#role-name').val();
            var role = $('#role-permisions').val();
            var role_description = $('#role-description').val();
            e.preventDefault();
            $.ajax({
              url: '/php/db_handling/handling/add_role.php',
              type: 'POST',
              data: {
                created_by_uuid: created_by_uuid,
                created_by: created_by,
                role_name: role_name,
                role: role,
                role_description: role_description

                // hours: hours
              },

              success: function(data) {
                console.log(data);
                if ($.trim(data) === "100") {

                  Notiflix.Notify.success('Your role has been submited');
                }
                if ($.trim(data) === "200") {
                  Notiflix.Notify.failure(
                    'There were erros while saving the data, Error:' + data);
                }
                if ($.trim(data) === "300") {
                  Notiflix.Notify.failure(
                    'No Data, Error:' + data);
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
  </body>


<?php
}



require("/var/www/html/php/template.php");
echo $footer ?>

</html>