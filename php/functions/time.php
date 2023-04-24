<?php

function getCurrentWorkWeek()
{
    $today = date('Y-m-d'); // get today's date in Y-m-d format
    $dayOfWeek = date('N', strtotime($today)); // get the numeric day of the week (1 = Monday, 7 = Sunday)
    $startOfWeek = date('m/d', strtotime("-" . ($dayOfWeek - 1) . " days", strtotime($today))); // calculate the start of the current week (Monday) in "MM/DD" format
    $endOfWeek = date('m/d', strtotime("+" . (5 - $dayOfWeek) . " days", strtotime($today))); // calculate the end of the current week (Friday) in "MM/DD" format
    return $startOfWeek . ' - ' . $endOfWeek; // return a string in the format "MM/DD - MM/DD"
}

?>