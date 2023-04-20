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
