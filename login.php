<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login | WarungQu</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">

	<!-- Icon -->
	<link rel="icon" href="/img/icons.png" type="image/x-icon" />
</head>

<body id="bg-login">
	<div class="box-login">
		<h2>Login</h2>
		<form action="" method="POST">
			<input type="text" name="user" placeholder="Username" class="input-control">
			<input type="password" name="pass" placeholder="Password" class="input-control">
			<input type="submit" name="submit" value="Login" class="btn">
		</form>
		<?php
		session_start();
		if (isset($_POST['submit'])) {
			include 'db.php';

			$user = mysqli_real_escape_string($conn, $_POST['user']);
			$pass = mysqli_real_escape_string($conn, $_POST['pass']);

			$query = "SELECT * FROM tb_admin WHERE username = '$user' AND password = '" . md5($pass) . "'";
			$result = mysqli_query($conn, $query);

			if (mysqli_num_rows($result) > 0) {
				$data = mysqli_fetch_assoc($result);

				$_SESSION['status_login'] = true;
				$_SESSION['a_global'] = $data;
				$_SESSION['id'] = $data['admin_id'];

				header("Location: dashboard.php");
				exit;
			} else {
				echo '<script>alert("Username atau password Anda salah!")</script>';
			}
		}
		?>
		<div class="container">
			<small>Copyright &copy; 2024 - <b>Bayu Nur Indra Jati Irawan & Badriatun Nabila.</b></small>
		</div>
	</div>
</body>

</html>