<?php


require_once('/var/www/html/config.php');
require_once('/var/www/html/pages/page-index.php');
require_once('/var/www/html/php/functions/permissons.php');
require_once('/var/www/html/php/functions/userPermissions.php');
require_once('/var/www/html/php/functions/userId.php');
require_once('/var/www/html/php/functions/time.php');
require_once('/var/www/html/php/functions/select.php');
// to turn off a page uncomment the following line:
// $_DEV = true;

session_start();
$session_id = session_id();
if (!isset($session_id) || !isset($_SESSION['name']) && !isset($_SESSION['username']) && !isset($_SESSION['role']) && !isset($_SESSION['role_name']) && !isset($_SESSION['uuid'])) {
    header('Location: ' . $login_page_url . '');
}

$name = $_SESSION['name'];
$username = $_SESSION['username'];
$role = $_SESSION['role'];
$role_name = $_SESSION['role_name'];
$uuid = $_SESSION['uuid'];

$WEB_TITLE = 'Manager Home';


setAccessPages($role);

// if(($role != 'Manager' || $role != 'Admin')){
//     header("Location: /index.php");
// }

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="
    https://cdn.jsdelivr.net/npm/notiflix/dist/notiflix-3.2.5.min.js
"></script>
    <link href="
https://cdn.jsdelivr.net/npm/notiflix/dist/notiflix-3.2.5.min.css
" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/css/home.css">
    <link rel="stylesheet" href="/css/admin/info.css">
    <link rel="stylesheet" href="/css/scrollbar.css">
    <link rel="stylesheet" href="/css/nav.css">
    <title><?php echo $WEB_TITLE ?> | <?php echo $WEBSITE_NAME; ?></title>

</head>

<body>

    <style>

    </style>


    <?php echo $userId = getUserId($db, $username); ?>
    <?php require("/var/www/html/php/template.php");
    echo $header ?>
    <?php if (($_DEV) && (($role == 'employee') || ($role == 'manager')) == '1') {
        echo $out_of_service;
    } elseif (($role == 'employee')) {
        echo $fourohthree;
    } elseif (($role == 'pending')) {
        echo $pending;
    } else {
    ?>

    <h1>Manager Portal</h1>





    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Panel</title>
        <div class="container">
            <!-- Messages Box -->
            <div class="messages">
                <h2>Messages</h2>
                <?php
            // Connect to the database
            $pdo = $db;

            // Retrieve messages from the database
            $stmt = $pdo->query("SELECT * FROM messages ORDER BY id ASC");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='message'><span class='name'>{$row['name']}</span> <span class='timestamp'>[{$row['date']}]</span><p>{$row['message']}</p> <button class='delete-message' id='{$row['id']}' onclick='deleteMessage({$row['id']})'>delete</button></div>";
            }
            if ($stmt->rowCount() == 0) {
                echo "<div class='message'><p>No messages</p></div>";
            }
            ?>

            </div>

            <!-- Add Shift Box
            <div class="add-shift">
                <h2>Add Shift</h2>
                <label>Day of the Week:</label>
                <input type="text" />
                <label>Start Time:</label>
                <input type="time" />
                <label>End Time:</label>
                <input type="time" />
                <label>Max Number of Employees:</label>
                <input type="number" />
                <label>Position:</label>
                <select>
                    <option value="Manager">Manager</option>
                    <option value="Cashier">Cashier</option>
                    
                </select>
            </div> -->
<!-- Add Shift Box -->
<div class="add-shift">
    <h2>Add Shift</h2>
    <form id="add-shift-form">
        <label>Day of the Week:</label>
        <div style="display: none;">
            <input type="text" name="uuid" value="<?php echo $uuid; ?>" />
            <input type="text" name="name" value="<?php echo $name; ?>" />
            <input type="text" name="username" value="<?php echo $username; ?>" />
    </div>
        
        <select name="day_of_week">
            <option value="Monday">Monday</option>
            <option value="Tuesday">Tuesday</option>
            <option value="Wednesday">Wednesday</option>
            <option value="Thursday">Thursday</option>
            <option value="Friday">Friday</option>
            <option value="Saturday">Saturday</option>
            <option value="Sunday">Sunday</option>
        </select>
        <label>Start Time:</label>
        <input type="time" name="start_time" />
        <label>End Time:</label>
        <input type="time" name="end_time" />
        <label>Max Number of Employees:</label>
        <input type="number" name="max_employees" />
        <label>Position:</label>
        <select name="position">
            <?php echo getRolesDropdown($db)
            ?>
        </select>
        <button type="submit">Add Shift</button>
    </form>
</div>

<script>
    const form = document.getElementById("add-shift-form");
    form.addEventListener("submit", function(event) {
        event.preventDefault();
        const formData = new FormData(form);
        const url = "/php/db_handling/handling/add_shift.php";
        const request = new XMLHttpRequest();
        request.open("POST", url);
        request.send(formData);
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                const response = request.responseText;
                if (response == 100) {
                    Notiflix.Notify.Success("Shift added successfully");
                    form.reset();
                } else if (response == 200) {
                    Notiflix.Notify.Failure("Failed to add shift");
                } else if (response == 300) {
                    Notiflix.Notify.Failure("Please fill out all fields");
                }
            }
        };
    });
</script>

            <!-- Shifts Box -->
            <!-- Shifts Box -->
            <div class="shifts">
<link rel="stylesheet" href="/css/admin/info.css">


  <table class="shifts-table">
      <thead>
          <tr> 
              <th>Day of the Week</th>
              <th>Day</th>
              <th>End Time</th>
              <th>Max Number of Employees</th>
              <th>Position</th>
              <th>....</th>
          </tr>
      </thead>
      <tbody>
        <?php 
        $sql = "SELECT * FROM shifts";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
            echo "<tr>";
            echo "<td>{$row['day']}</td>";
            echo "<td>{$row['date']}</td>";
            echo "<td>{$row['start_time']}</td>";
            echo "<td>{$row['end_time']}</td>";
            echo "<td>{$row['max_employees']}</td>";
            echo "<td>{$row['position']}</td>";
            
            echo "<td><button class='edit-btn' onclick='editShift(event)'>Edit</button></td>";
            echo "</tr>";
        }
        // if there are no shifts just display a message
        if (count($result) == 0) {
          echo "<tr><td colspan='6'>No shifts</td></tr>";
        }
        ?>

        

  </table>

</div>
        </div>


        <script>
        function deleteMessage(id) {
            // Create a new XMLHttpRequest object
            var xhr = new XMLHttpRequest();

            // Set up the request
            xhr.open('POST', '/php/db_handling/handling/delete-message.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            // Set up the data to be sent
            var data = 'id=' + encodeURIComponent(id);

            // Send the request
            xhr.send(data);

            // Handle the response
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Reload the page to update the messages
                    location.reload();
                }
            };
        }
        </script>
        <script>
                function editShift(event) {
                  // Get the table row that was clicked
                  const row = event.target.parentNode.parentNode;

                  // Get the cells in the row
                  const cells = row.getElementsByTagName("td");

                  // Loop through the cells and replace the text with input boxes
                  for (let i = 2; i < cells.length - 1; i++) {
                    const cell = cells[i];
                    const text = cell.innerText;
                    const input = document.createElement("input");
                    input.type = "text";
                    input.value = text;
                    cell.innerHTML = "";
                    cell.appendChild(input);
                  }

                  // Change the edit button to a save button
                  const editBtn = row.querySelector(".edit-btn");
                  editBtn.innerText = "Save";
                  editBtn.onclick = function() { saveShift(event); };
                }

                function saveShift(event) {
                  // Get the table row that was clicked
                  const row = event.target.parentNode.parentNode;

                  // Get the cells in the row
                  const cells = row.getElementsByTagName("td");

                  // Get the values from the input boxes
                  const startTime = cells[2].querySelector("input").value;
                  const endTime = cells[3].querySelector("input").value;
                  const maxEmployees = cells[4].querySelector("input").value;
                  const position = cells[5].querySelector("input").value;

                  // make a post request to the server to save the changes
                  const url = "/php/db_handling/editting/save-changes.php";
                  const data = {
                    startTime: startTime,
                    endTime: endTime,
                    maxEmployees: maxEmployees,
                    position: position
                  };
                  const request = new XMLHttpRequest();
                  request.open("POST", url);
                  request.setRequestHeader("Content-Type", "application/json");
                  request.send(JSON.stringify(data));





                  // Loop through the cells and replace the input boxes with text
                  for (let i = 2; i < cells.length - 1; i++) {
                    const cell = cells[i];
                    const input = cell.querySelector("input");
                    const value = input.value;
                    cell.innerHTML = value;
                  }

                  // Change the save button back to an edit button
                  const editBtn = row.querySelector(".edit-btn");
                  editBtn.innerText = "Edit";
                  editBtn.onclick = function() { editShift(event); };
                }
              </script>

</body>


<?php
    }
    require("/var/www/html/php/template.php");
    echo $footer;
    ?>