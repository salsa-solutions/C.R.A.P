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
    $dropdown .= '<option value="' . $id . '">' . $fullname . ' - ' . $role . '</option>';

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
  $query = "SELECT position, role FROM roles";
  $stmt = $db->prepare($query);
  $stmt->execute();
  $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);


  $dropdown = "";
  foreach ($roles as $role) {
    $position = $role['position'];
    // $role_id = $role['role'];

    // Add the fullname to the dropdown menu as an option with the user ID as the value
    $dropdown .= '<option value="' . $position . '">' . $position . '</option>';
  }



  // Return the dropdown menu, roles array, and ids array as an array
  return $dropdown;
}

function get_shift_options($db, $day, $includeRoleName = false, $roleFilter = null, $userName = null)
{
  $options = "";
  $sql = "SELECT id, start_time, end_time, max_employees, position, day_of_week FROM shifts WHERE day_of_week = :day_of_week";

  if (!is_null($roleFilter)) {
    $sql .= " AND position = :position";
  }

  $stmt = $db->prepare($sql);
  $stmt->bindParam(':day_of_week', $day);

  if (!is_null($roleFilter)) {
    $stmt->bindParam(':position', $roleFilter);
  }

  $stmt->execute();

  // Check if there are any shifts
  if ($stmt->rowCount() == 0) {
    $options = "<option value=\"false-{$day}\">No Shifts Found</option>";
  } else {
    $options = "<option value=\"false-{$day}\">Select a shift</option>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $show_option = false;

      // Determine whether to show this shift based on employee max and role name
      if ($row['max_employees'] > 0 && !empty($row['position'])) {
        $start_time = date('h:i A', strtotime($row['start_time']));
        $end_time = date('h:i A', strtotime($row['end_time']));
        $option_value = $row['id'];
        $option_label = "";

        if (!is_null($userName)) {
          $option_label .= $userName . " - ";
        }

        $option_label .= "{$start_time} - {$end_time}";

        if ($includeRoleName) {
          $option_label .= " ({$row['position']})";
        }

        $options .= "<option value=\"{$option_value}\">{$option_label}</option>";
        $show_option = true;
      }

      // Create the option tag if this shift should be shown
      if ($show_option) {
        // Additional processing for each shift if needed
      }
    }
    $options .= "<option value=\"false-{$day}\">OFF</option>";
  }

  return $options;
}





// require_once('/var/www/html/config.php');
// echo '<select>';
// echo Get_shift_options($db, 'Monday');
// echo get_shift_options($db, 'tuesday');
// echo get_shift_options($db, 'wednesday');
// echo get_shift_options($db, 'thursday');
// echo get_shift_options($db, 'friday');
// echo get_shift_options($db, 'saturday');
// echo get_shift_options($db, 'sunday');
// echo '</select>';