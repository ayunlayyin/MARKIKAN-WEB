<?php
session_start();
include 'config.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $message_text = $conn->real_escape_string($_POST['message']);

    $sql = "INSERT INTO contacts (name, email, message) VALUES ('$name', '$email', '$message_text')";
    if ($conn->query($sql) === TRUE) {
        $message = "Pesan berhasil dikirim!";
    } else {
        $message = "Terjadi kesalahan: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Kontak - Markikan</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
<header>
    <nav>
        <a href="index.php">Home</a> |
        <a href="produk.php">Produk</a> |
        <a href="kontak.php">Kontak</a> |
        <?php if(isset($_SESSION['username'])): ?>
            <a href="logout.php">Logout (<?=htmlspecialchars($_SESSION['username'])?>)</a>
        <?php else: ?>
            <a href="login.php">Login</a> |
            <a href="register.php">Register</a>
        <?php endif; ?>
    </nav>
</header>

<h2>Kontak Kami</h2>

<?php if($message) echo "<p style='color:green;'>$message</p>"; ?>

<form method="post" action="kontak.php">
    <label>Nama:</label><br />
    <input type="text" name="name" required /><br />
    <label>Email:</label><br />
    <input type="email" name="email" required /><br />
    <label>Pesan:</label><br />
    <textarea name="message" rows="5" required></textarea><br /><br />
    <button type="submit">Kirim</button>
</form>
</body>
</html>
