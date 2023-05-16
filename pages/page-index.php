<?php

// page urls

// manager
$admin_page_url= '/pages/manager/admin.php';
$scheduling_page_url= '/pages/manager/scheduling.php';
$approval_page_url = '/pages/manager/approval.php';

// regular user 
$home_page_url = '/index.php';
$home_page_full_url = '/var/www/html/index.php';
$schedule_page_url = '/pages/general/schedule.php';
$settings_page_url = '/pages/user/settings.php';

//  login pages
$login_page_url = '/pages/login/login.php';
$register_page_url = '/pages/login/registration.php';
$logout_page_url = '/pages/login/logout.php?logout=true';

//  login pages
$login_page = '/pages/login/login.php';
$register_page = '/pages/login/registration.php';
$logout_page = '/pages/login/logout.php?logout=true';

// test pages
$test_page_php_url = '/test/test.php';
$test_page_html_url = '/test/test.html';
$info = '/test/info.php';


// page links
// manager
$managment_page = 'Management';
$admin_page= '<a href="' . $admin_page_url .'">Manager</a>';
$scheduling_page= '<a href="' . $scheduling_page_url .'">Scheduling</a>';
$approval_page = '<a href="' . $approval_page_url .'">Approval</a>';

// regular user 
$home_page = '<a href="' . $home_page_url .'">Home</a>';
$schedule_page = '<a href="' . $schedule_page_url .'">Schedule</a>';
$settings_page = '<a href="' . $settings_page_url .'">Settings</a>';

// test pages
$test_page = '/Testing/';
$test_page_php = '<a href="' . $test_page_php_url .'">php</a>';
$test_page_html = '<a href="' . $test_page_html_url .'">html</a>';
$info_page = '<a href="' . $info .'">info</a>';
?>