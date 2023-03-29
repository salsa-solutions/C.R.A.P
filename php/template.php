
<?php
// set_include_path(get_include_path() . PATH_SEPARATOR . '/pages/page-index.php');
// // include_path('/pages/page-index.php');

$header = <<<HEADER


<!-- The navigation menu -->
<div class="navbar-d">
    $home_page $schedule_page $settings_page
    <div class="subnav-d">
        <button class="subnavbtn-d"> $managment_page </button>
        <div class="subnav-content-d">
            $admin_page $scheduling_page $approval_page
        </div>
    </div>
    <div class="subnav-d">
    <button class="subnavbtn-d"> $test_page </button>
    <div class="subnav-content-d">
        $test_page_php $test_page_html
    </div>
        </div>
    <button type="button" name="button" id="logOut" class="btn btn_logout">Log Out</button>
</div>

HEADER;

$footer = <<<FOOTER
<script>
        $(function() {
            $('#logOut').click(function() {
                window.location.href = "$logout_page";
            })
        });
    </script>
    <div class="f-container">
    <footer>
        <p>You are logged in as: $name </p>
        <p>Role: $role </p>
    </footer>
</div>
</div>

</body>

</html>
FOOTER;

// Out of Service text
$out_of_service = <<<OOS
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Out of Service</h1>
        </div>
    </div>
    
        <p>The website is under maintenance.</p>
</div>
OOS;

$fourohthree = <<<FOT
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>403</h1>
        </div>
    </div>
    
        <p>Whoa their buckeroo, what do you think you are doing</p>
</div>

FOT;

$pending = <<<PED
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Account Pending</h1>
        </div>
    </div>
    
        <p>Your account is still pending for approval</p>
        
</div>

PED;

?>