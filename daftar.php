<?php
session_start();
include 'config.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Cek apakah username sudah ada
    $check = $conn->query("SELECT id FROM users WHERE username='$username'");
    if ($check->num_rows > 0) {
        $message = "Username sudah dipakai.";
    } else {
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password_hash')";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['username'] = $username;
            header("Location: index.php");
            exit;
        } else {
            $message = "Error: " . $conn->error;
        }
    }
}
?>



<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Gabung - Mari Makan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="daftar.css">

    <!-- Google Sign-In -->
    <script src="https://accounts.google.com/gsi/client" async defer></script>
</head>
<body class="register-page">

    <!-- Background segitiga -->
    <img src="assets/bgputih" class="triangle top-left" alt="">
    <img src="assets/bg-pattern.jpg" class="triangle bottom-left" alt="">
    <img src="assets/bg-pattern.jpg" class="triangle bottom-right" alt="">

    <div class="register-container">
        <img src="assets/logo.png" alt="Logo" class="register-logo">
        <h2 class="brand-text">mari makan</h2>
        <h1 class="headline"> yuk gabung, sekarang!</h1>

        <!-- Google Sign-In -->
        <div id="g_id_onload"
             data-client_id="YOUR_GOOGLE_CLIENT_ID"
             data-login_uri="proses_google_login.php"
             data-auto_prompt="false">
        </div>

        <div class="g_id_signin"
             data-type="standard"
             data-shape="pill"
             data-theme="filled_blue"
             data-text="continue_with"
             data-size="large"
             data-logo_alignment="left">
        </div>

 <!-- Tombol Buat Akun -->
<a href="form_daftar.php" class="create-btn">Buat Akun</a>


        <p class="login-redirect">sudah punya akun? <a href="login.php">login</a></p>
    </div>

</body>
</html>
