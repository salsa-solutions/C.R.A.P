<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
function getRoles($db, $role) {
    require_once('/var/www/html/config.php');
    $result = $db->prepare("SELECT id, role FROM role ORDER BY role ASC");
    $result->execute();
    $options = '';
    for ($i = 0; $row = $result->fetch(); $i++) {
      if ($row['role'] != 'Admin') {
        $options .= '<option value="' . $row['id'] . '">'  . $row['role'] . '</option>';
      } elseif ($row['role'] == 'Admin' && $role == 'Admin') {
        $options .= '<option value="' . $row['id'] . '">'  . $row['role'] . '</option>';
      } else {
        $options .= '<option value="' . $row['id'] . '" disabled>' . $row['role'] . '</option>';
      }
    }
  
    return $options;
  }
  
?>
