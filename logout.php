<?php
session_start(); // Mulai sesi jika belum dimulai
session_destroy(); // Hapus semua data sesi
header("Location: login.php"); // Redirect pengguna ke halaman login (misalnya)
exit();
?>
