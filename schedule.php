<table border="1" cellspacing="0" cellpadding="2" >
<thead>
	<tr>
		<th> First Name </th>
		<th> Last Name </th>
		<th> Age </th>
	</tr>
</thead>
<tbody>
	<?php
		include('config.php');
		$result = $db->prepare("SELECT * FROM pref_day ORDER BY id DESC");
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
	?>
	<tr class="record">
		<td><?php echo $row['date']; ?></td>
		<td><?php echo $row['lname']; ?></td>
		<td><?php echo $row['age']; ?></td>
	</tr>
	<?php
		}
	?>
</tbody>
</table>