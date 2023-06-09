<?php
require_once('koneksi.php');

session_start();
if (isset($_SESSION['username'])) {
  header("Location: home.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Transparent Login Form UI</title>
  <link rel="stylesheet" href="login.css">
  <link rel="icon" href="logo.png" type="image/x-icon">
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>

<body>
  <div class="bg-img">
    <div class="content">
      <img src="logo.png" width="100px" height="100px" alt="">
      <header style="color: #87B749;">Login</header>
      <form method="POST">
        <div class="field">
          <span class="fa fa-user"></span>
          <input type="text" name="email" id="email" required placeholder="Email">
        </div>
        <div class="field space">
          <span class="fa fa-lock"></span>
          <input type="password" class="pass-key" name="password" id="passsword" required placeholder="Password">
          <span class="show">SHOW</span>
        </div>
        <div class="pass">
          <p></p>
        </div>
        <div class="field">
          <input type="submit" value="LOGIN">
        </div>
      </form>
      <div class="signup">Don't have account?
        <a href="regist.php">Signup Now</a>
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
    // Ambil nilai dari form login
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Cek email dan password di database
    $query = "SELECT * FROM user WHERE email = '$email' AND pass = '$password'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
      // Login berhasil, redirect ke halaman home.php
      $_SESSION['email'] = $email; // Set session email
      header("Location: home.php");
      exit();
    } else {
      // email atau password salah, tampilkan notifikasi
      $errorMessage = "email atau password salah!";
    }
  }
  ?>

</body>

</html>