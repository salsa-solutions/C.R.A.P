<?php
require_once('/var/www/html/config.php');
require_once('/var/www/html/pages/page-index.php');
require_once('/var/www/html/php/functions/permissons.php');
require_once('/var/www/html/php/functions/select.php');
$times = generate_time_options('9:00 AM', '5:00 PM');

?>
<div class="card">
    <div class="card-header">
        Work Hours for Every Day
    </div>
    <div class="card-body">
        <form>
            <?php $days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'); ?>
            <?php foreach ($days as $day) { ?>
                <div class="form-group">
                    <label for="work-hours-<?php echo strtolower($day); ?>"><?php echo $day; ?>:</label>
                    <?php echo $times('work-hours-' . strtolower($day), 'required'); ?>
                </div>
            <?php } ?>
            <div class="form-group">
                <label for="break-time">Break Time:</label>
                <input type="number" id="break-time" name="break-time" min="0" max="240" step="15" required> minutes
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>



        <style>
            .card {
                width: 400px;
                background-color: #fff;
                border: 1px solid #ccc;
                border-radius: 5px;
                box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
                margin: 20px auto;
            }

            .card-header {
                font-size: 24px;
                font-weight: bold;
                padding: 10px 20px;
                border-bottom: 1px solid #ccc;
                background-color: #f7f7f7;
            }

            .card-body {
                padding: 20px;
            }

            .form-group {
                margin-bottom: 20px;
            }

            label {
                display: block;
                font-weight: bold;
                margin-bottom: 5px;
            }

            input[type="time"],
            input[type="number"] {
                width: 100%;
                padding: 10px;
                border-radius: 5px;
                border: 1px solid #ccc;
                font-size: 16px;
            }

            input[type="number"]::-webkit-inner-spin-button,
            input[type="number"]::-webkit-outer-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }

            input[type="number"] {
                -moz-appearance: textfield;
            }

            button {
                display: block;
                width: 100%;
                padding: 10px;
                background-color: #007bff;
                color: #fff;
                border: none;
                border-radius: 5px;
                font-size: 16px;
                cursor: pointer;
            }

            button:hover {
                background-color: #0069d9;
            }
        </style>