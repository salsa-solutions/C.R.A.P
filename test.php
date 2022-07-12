<?php
session_start();
require_once('config.php');

if (!isset($_SESSION['userlogin'])) {
	header("Location: login.php");
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION);
	header("Location: login.php");
}
echo $_SESSION['userlogin'];
?>

<table border="1" cellspacing="0" cellpadding="2" >
<thead>
	<tr>
		<th>date</th>
		<th>Monday</th>
		<th>Tuesday</th>
		<th>Wednesday</th>
		<th>Thursday</th>
		<th>Friday</th>
		<th>Saturday</th>
	</tr>
</thead>
<tbody>
	<?php
		include('config.php');
		$result = $db->prepare("SELECT * FROM pref_day   DESC");
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
	?>
	<tr class="record">
		<td><?php echo $row['date']; ?></td>
		<td><?php echo $row['monday']; ?></td>
		<td><?php echo $row['tuesday']; ?></td>
		<td><?php echo $row['wednesday']; ?></td>
		<td><?php echo $row['thursday']; ?></td>
		<td><?php echo $row['friday']; ?></td>
		<td><?php echo $row['saturday']; ?></td>
	</tr>
	<?php
		}
	?>
</tbody>
</table>