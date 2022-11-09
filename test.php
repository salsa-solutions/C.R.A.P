<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['userlogin'])) {
    header('Location: login.php');
}

$name = $_SESSION['userlogin'][0];
$role = $_SESSION['userlogin'][1];
$username = $_SESSION['userlogin'][2];
$WEB_TITLE = 'Scheduling';
// to turn off a site uncomment the following line:
// $_DEV = true;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (($role == 'admin') || ($role == 'manager')) {
    $admin_page = '<li><a href="/admin.php">Admin</a></li>';
    $scheduling_page = '<li><a href="/scheduling.php">Scheduling</a></li>';
} else {
    $admin_page = null;
    $scheduling_page = null;
}

?>


<?php

    include('config.php');
    $result = $db->prepare("SELECT * FROM avil_day ORDER BY name ASC");
    $avil_day = $result->execute();
    $avil_day = $result->fetchAll(PDO::FETCH_ASSOC);

    $result = $db->prepare("SELECT * FROM current_schedule ORDER BY name ASC");
    $current_sched = $result->execute();
    $current_sched = $result->fetchAll(PDO::FETCH_ASSOC);
    
    function removedups ($MasterArray, $CompareArray) {
        $items = array();
        $dups = array();
        $MasterArray = array_merge($MasterArray, $CompareArray);
        foreach ($MasterArray as $item) {
            $lowercased_item = strtolower($item);
            if (isset($items[$lowercased_item])) {
                unset($items[$lowercased_item]);
                $dups[] = $lowercased_item;
            }
            elseif (!in_array($lowercased_item,$dups)) {
                $items[$lowercased_item] = $item;
            }
        }
        return array_values($items);
    }
    $avil_day = removedups($avil_day, $current_sched);




    // for ($i = 0;  $avil_day = $avil_day->fetch(); $current_sched = $current_sched->fetch() $i++) {
    // $UniqueArray = array_unique( array_merge($avil_day, $current_sched) );

    // delete entry of multidimensional array if valule matches a given value
    // function delete_entry($array, $key, $value) {
    //     foreach($array as $subKey => $subArray){
    //         if($subArray[$key] == $value){
    //              unset($array[$subKey]);
    //         }
    //    }
    //    return $array;
    // }
    // for ($i = 0; $row = $result->fetch(); $i++) {
    //     $avil_day = delete_entry($avil_day, 'name' , $current_sched[$i]);
    // }
    // // $avil_day = $avil_day_temp;
    // echo '<pre>'; print_r($avil_day); echo '</pre>';



 


?>