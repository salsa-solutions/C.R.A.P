<?php

// show errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// function getRoles($db, $role)
// {
//   require_once('/var/www/html/config.php');
//   $result = $db->prepare("SELECT id, role FROM role ORDER BY role ASC");
//   $result->execute();
//   $options = '';
//   for ($i = 0; $row = $result->fetch(); $i++) {
//     if ($row['role'] != 'Admin') {
//       $options .= '<option value="' . $row['id'] . '">'  . $row['role'] . '</option>';
//     } elseif ($row['role'] == 'Admin' && $role == 'Admin') {
//       $options .= '<option value="' . $row['id'] . '">'  . $row['role'] . '</option>';
//     } else {
//       $options .= '<option value="' . $row['id'] . '" disabled>' . $row['role'] . '</option>';
//     }
//   }

//   return $options;
// }


function getUsersDropdown($db)
{
  $query = "SELECT CONCAT(firstname, ' ', lastname) AS fullname, role, id FROM users";
  $stmt = $db->prepare($query);
  $stmt->execute();
  $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $dropdown = '<select name="user_id">';
  $roles = array();
  $ids = array();

  foreach ($users as $user) {
    $fullname = $user['fullname'];
    $role = $user['role'];
    $id = $user['id'];

    // Add the fullname to the dropdown menu as an option with the user ID as the value
    $dropdown .= '<option value="' . $id . '">' . $fullname . ' - '. $role . '</option>';

    // Save the role and user ID to the roles and ids arrays
    $roles[$id] = $role;
    $ids[$id] = $fullname;
  }

  $dropdown .= '</select>';

  // Return the dropdown menu, roles array, and ids array as an array
  return array('dropdown' => $dropdown, 'role' => $roles, 'id' => $ids);
}

