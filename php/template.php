
<?php

$header = <<<HEADER

<body>

<div class="nav">
    <ul>
        <div class="nav-links">
            <li><a href="/index.php">Home</a></li>
            <li><a href="/schedule.php">Schedule</a></li>
            $admin_page
            $scheduling_page
            <li><button type="button" name="button" id="logOut" class="btn btn_logout">Log Out</button></li>
            
        </div>      
        
    </ul>
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



?>