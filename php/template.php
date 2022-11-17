
<?php

$header = <<<HEADER

<body>



<!-- The navigation menu -->
<div class="navbar-d">
    <a href="/index.php">Home</a>
    <a href="/schedule.php">Schedule</a>
    <div class="subnav-d">
        <button class="subnavbtn-d"> $managment </button>
        <div class="subnav-content-d">
            $admin_page $scheduling_page $approval
        </div>
    </div>
    <button type="button" name="button" id="logOut" class="btn btn_logout">Log Out</button>
</div>

HEADER;

$footer = <<<FOOTER
<script>
        $(function() {
            $('#logOut').click(function() {
                window.location.href = "logout.php?logout=true";
            })
        });
    </script>
    <div class="footer">
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