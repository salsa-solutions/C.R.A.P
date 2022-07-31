
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
                
        </div>
            <div class="mt-2 ">
                <button type="button" name="button" id="logOut" class="btn btn_logout">Log Out</button>
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

// Out of Service
$oos = <<< OOS
<h1 class="">t</h1>
OOS;
?>