<?php

function setAccessPages($role) {
    require_once '/var/www/html/pages/page-index.php';
    global $managment_page, $admin_page, $scheduling_page, $approval_page, $test_page, $test_page_php, $test_page_html ;
    if ($role == 'dev') {
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
    elseif ($role == 'manager' || 'admin') {
        $managment_page = $managment_page;
        $admin_page = $admin_page;
        $scheduling_page = $scheduling_page;
        $approval_page = $approval_page;
        $test_page = NULL;
        $test_page_php = NULL;
        $test_page_html = NULL;
    } elseif ($role == 'employee' || 'pending' || !isset($role)) {
        $managment_page = NULL;
        $admin_page = NULL;
        $scheduling_page = NULL;
        $approval_page = NULL;
        $test_page = NULL;
        $test_page_php = NULL;
        $test_page_html = NULL;
    }
}

function setPagePermissions($role, $mode)
{

    if (($mode == 'admin' && $role == 'admin') || $role == 'dev') {
        return 'admin';
    } elseif (($mode == 'manager' && $role == 'manager') || $role == 'dev' || $role == 'admin') {
        return 'manager';
    } elseif (($mode == 'employee' && $role == 'employee') || $role == 'dev' || $role == 'admin' || $role == 'manager') {
        return 'public';
    } elseif ($role == 'pending') {
        return 'pending';
    } else {
        return 'none';
    }
}
