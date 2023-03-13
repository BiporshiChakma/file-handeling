<!DOCTYPE html>
<html>
<head>
	<title>Registered Users</title>
</head>
<body>
	<h2> Registered Users</h2>
	<table border="1">
		<tr>
			<th>Name</th>
			<th>Email</th>
			<th>Profile Picture</th>
		</tr>
		<?php
		$file = fopen('users.csv', 'r');

		while (($row = fgetcsv($file)) !== false) {
			echo "<tr>";
			echo "<td>{$row[0]}</td>";
			echo "<td>{$row[1]}</td>";
			echo "<td><img src=\"uploads/{$row[2]}\" width=\"100\" height=\"100\"></td>";
			echo "</tr>";
		}

		fclose($file);
		?>
	</table>
</body>
</html>