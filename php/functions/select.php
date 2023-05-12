<?php

// show errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



function getUsersDropdown($db)
{
  $query = "SELECT name, role, uuid FROM users";
  $stmt = $db->prepare($query);
  $stmt->execute();
  $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $dropdown = '<select name="user_id">';
  $roles = array();
  $ids = array();

  foreach ($users as $user) {
    $fullname = $user['name'];
    $role = $user['role'];
    $id = $user['uuid'];

    // Add the fullname to the dropdown menu as an option with the user ID as the value
    $dropdown .= '<option value="' . $id . '">' . $fullname . ' - '. $role . '</option>';

    // Save the role and user ID to the roles and ids arrays
    $roles[$id] = $role;
    $ids[$id] = $fullname;
  }

  $dropdown .= '</select>';

  // Return the dropdown menu, roles array, and ids array as an array
  return array('dropdown' => $dropdown, 'role' => $roles, 'uuid' => $ids);
}

function generate_time_options($start_time, $end_time, $interval = 15)
{
  $times = array();
  $current_time = strtotime($start_time);
  $end_time = strtotime($end_time);

  while ($current_time <= $end_time) {
    $times[] = date('h:i A', $current_time);
    $current_time += $interval * 60;
  }

  $html = '';
  foreach ($times as $time) {
    $html .= '<option value="' . $time . '"> ' . $time . '</option>';
  }
  

  return $html;
}

// get all the roles from roles table

function getRolesDropdown($db)
{
  $query = "SELECT role_name, role FROM roles";
  $stmt = $db->prepare($query);
  $stmt->execute();
  $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);


  $dropdown = "";
  foreach ($roles as $role) {
    $role_name = $role['role_name'];
    $role_id = $role['role'];

    // Add the fullname to the dropdown menu as an option with the user ID as the value
    $dropdown .= '<option value="' . $role_id . '">' . $role_name . '</option>';
  }



  // Return the dropdown menu, roles array, and ids array as an array
  return $dropdown;
}

function get_shift_options($db, $day)
{
  $options = '';
  $sql = "SELECT id, start_time, end_time, employee_max, role_name, day FROM shifts WHERE day = :day";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':day', $day);
  $stmt->execute();
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $show_option = false;
    // Determine whether to show this shift based on employee max and role name
    if ($row['employee_max'] > 0 && !empty($row['role_name'])) {
      $show_option = true;
    }
    // Create the option tag if this shift should be shown
    if ($show_option) {
      $start_time = date('h:i A', strtotime($row['start_time']));
      $end_time = date('h:i A', strtotime($row['end_time']));
      $option_value = $row['id'];
      $option_label = "{$start_time} - {$end_time} ({$row['employee_max']})";
      $options .= "<option  value=\"{$option_value}\">{$option_label}</option> \r\n";
    }
  }
  if (empty($options)) {
    $options = '<option value="">No shifts available</option>';
  }
  return $options;
}
// require_once('/var/www/html/config.php');
// echo Get_shift_options($db, 'Monday');
// echo get_shift_options($db, 'tuesday');
// echo get_shift_options($db, 'wednesday');
// echo get_shift_options($db, 'thursday');
// echo get_shift_options($db, 'friday');
// echo get_shift_options($db, 'saturday');
// echo get_shift_options($db, 'sunday');
