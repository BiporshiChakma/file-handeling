<html>
<body>
    <form action="output.php">
    <p>Sucessfully Save</p>
    <button>See Registred List</button>
    </form>
</body>
</html>
<?php
session_start();

if (isset($_POST['submit'])) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];

	// Validate form inputs
	if (empty($name) || empty($email) || empty($password)) {
		echo "Please fill out all fields.";
		exit();
	} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo "Invalid email format.";
		exit();
	}

	// Save profile picture to server
	$uploads_dir = 'uploads/';
	$profile_picture = $_FILES['profile_picture']['name'];
	$profile_picture_tmp = $_FILES['profile_picture']['tmp_name'];
	$profile_picture_extension = pathinfo($profile_picture, PATHINFO_EXTENSION);
	$profile_picture_filename = uniqid() . '_' . date('Y-m-d_H-i-s') . '.' . $profile_picture_extension;

	move_uploaded_file($profile_picture_tmp, $uploads_dir . $profile_picture_filename);

	// Save user's data to CSV file
	$user_data = [$name, $email, $profile_picture_filename];
	$file = fopen('users.csv', 'a');
	fputcsv($file, $user_data);
	fclose($file);
	// Set cookie with user's name
	setcookie('name', $name, time() + 3600);
	exit();
}
?>
