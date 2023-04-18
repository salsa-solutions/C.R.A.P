<?php

function setAccessPages($role) {
    require_once '/var/www/html/pages/page_index.php';
    // global $managment_page, $admin_page, $scheduling_page, $approval_page, $test_page, $test_page_php, $test_page_html ;
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

function setPagePermissions($role, $mode){
    
    if($mode == 'admin' && ($role == 'admin' || 'dev')){
        return 'admin';
    }elseif($mode == 'admin' && ($role == 'employee' || 'pending' || !isset($role))){
        return 'denied';
    }elseif($mode == 'employee' && ($role == 'employee' )){
        return 'employee';
    }elseif($mode == 'employee' && ($role == 'admin' || 'dev')){
        return 'denied';
    }elseif($mode == 'employee' || 'admin' && ($role == 'pending' || !isset($role))){
        return 'denied';
    }

}