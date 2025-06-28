<?php
session_start();

// Ambil data dari form
$email = $_POST['email'];
$password = $_POST['password'];

// Simulasi validasi login (GANTI dengan validasi database asli)
$akunBenar = "admin@contoh.com";
$passwordBenar = "123456";

// Cek kecocokan
if ($email === $akunBenar && $password === $passwordBenar) {
    $_SESSION['user'] = $email;
    header("Location: beranda.php"); // Redirect ke halaman beranda
    exit();
} else {
    echo "<script>alert('Email atau password salah'); window.location='login.php';</script>";
}
?>
