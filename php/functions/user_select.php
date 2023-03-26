<?php
function getUsers($db, $role) {
    
    $result = $db->prepare("SELECT id, firstname, lastname, username, role FROM users ORDER BY lastname ASC");
    $result->execute();
    $options = '';
    for ($i = 0; $row = $result->fetch(); $i++) {
      if ($row['role'] != 'Admin') {
        $options .= '<option value="' . $row['id'] . '">' . $row['firstname'] . ' ' . $row['lastname'] . ' - ' . $row['role'] . '</option>';
      } elseif ($row['role'] == 'Admin' && $role == 'Admin') {
        $options .= '<option value="' . $row['id'] . '">' . $row['firstname'] . ' ' . $row['lastname'] . ' - ' . $row['role'] . '</option>';
      } else {
        $options .= '<option value="' . $row['id'] . '" disabled>' . $row['firstname'] . ' ' . $row['lastname'] . ' - ' . $row['role'] . '</option>';
      }
    }

    return $options;
}

?>