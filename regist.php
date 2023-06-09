<?php
require_once('koneksi.php');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8">
	<title>Transparent Login Form UI</title>
	<link rel="stylesheet" href="login.css">
	<script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>

<body>
	<div class="bg-img">
		<div class="content">
			<img src="logo.png" width="100px" height="100px" alt="">
			<header style="color:#87B749">Create Account</header>
			<form method="POST">
				<div class="field">
					<span class="fa fa-user"></span>
					<input type="text" name="email" id="email" required placeholder="Email">
				</div>
				<div class="field space">
					<span class="fa fa-lock"></span>
					<input type="password" class="pass-key" name="password" id="password" required placeholder="Password">
					<span class="show">SHOW</span>
				</div>
				<div class="pass">

				</div>
				<div class="field">
					<input type="submit" value="LOGIN">
				</div>
			</form>
			<div class="signup">Already have account?
				<a href="login.PHP">Signin</a>
			</div>
		</div>
	</div>

	<script>
		const pass_field = document.querySelector('.pass-key');
		const showBtn = document.querySelector('.show');
		showBtn.addEventListener('click', function() {
			if (pass_field.type === "password") {
				pass_field.type = "text";
				showBtn.textContent = "HIDE";
				showBtn.style.color = "#3498db";
			} else {
				pass_field.type = "password";
				showBtn.textContent = "SHOW";
				showBtn.style.color = "#222";
			}
		});
	</script>
	<?php
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		// Ambil nilai dari form registrasi
		$email = $_POST['email'];
		$password = $_POST['password'];

		// Cek validitas input
		$errors = array();

		// Cek apakah password memiliki 10 karakter
		if (strlen($password) < 10) {
			$errors[] = "Password harus memiliki setidaknya 10 karakter!";
		}

		// Cek apakah email telah digunakan
		$query = "SELECT * FROM user WHERE email = '$email'";
		$result = $conn->query($query);
		if ($result->num_rows > 0) {
			$errors[] = "email telah digunakan!";
		}

		if (empty($errors)) {

			// Simpan email dan password ke dalam database
			$stmt = $conn->prepare("INSERT INTO user (email, pass) VALUES (?, ?)");
			$stmt->bind_param("ss", $email, $password);

			// Eksekusi pernyataan yang telah dipersiapkan
			$stmt->execute();

			// Redirect ke halaman login.php
			header("Location: login.php");
			exit();
		}
	}
	?>
</body>

</html>