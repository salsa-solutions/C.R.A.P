<?php

function setAccessPages($role) {
    global $managment_page, $admin_page, $scheduling_page, $approval_page, $test_page, $test_page_php, $test_page_html;
    if ($role == 'Dev') {
        $managment_page = $managment_page;
        $admin_page = $admin_page;
        $scheduling_page = $scheduling_page;
        $approval_page = $approval_page;
        $test_page = $test_page;
        $test_page_php = $test_page_php;
        $test_page_html = $test_page_html;
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    }
    elseif ($role == 'Manager' || $role == 'Admin') {
        $managment_page = $managment_page;
        $admin_page = $admin_page;
        $scheduling_page = $scheduling_page;
        $approval_page = $approval_page;
        $test_page = NULL;
        $test_page_php = NULL;
        $test_page_html = NULL;
    } else {
        $managment_page = NULL;
        $admin_page = NULL;
        $scheduling_page = NULL;
        $approval_page = NULL;
        $test_page = NULL;
        $test_page_php = NULL;
        $test_page_html = NULL;
    }
}
