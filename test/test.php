<?php
require_once '/var/www/html/config.php';



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
                $options .= "<option value=\"{$option_value}\">{$option_label}</option>";
            }
        }
        if (empty($options)) {
            $options = '<option value="">No shifts available</option>';
        }
        return $options;
    }



?>

<select name="" id="">
    <?php echo get_shift_options($db, 'tuesday'); ?>
</select>