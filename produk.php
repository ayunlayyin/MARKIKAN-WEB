<?php
session_start();
include 'config.php';

$result = $conn->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Produk - Markikan</title>
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

<h1>Daftar Produk</h1>
<div class="produk-list">
    <?php while($row = $result->fetch_assoc()): ?>
        <div class="produk-item">
            <img src="assets/<?=htmlspecialchars($row['image'])?>" alt="<?=htmlspecialchars($row['name'])?>" />
            <h3><?=htmlspecialchars($row['name'])?></h3>
            <p><?=htmlspecialchars($row['description'])?></p>
            <p>Harga: Rp <?=number_format($row['price'], 0, ',', '.')?></p>
        </div>
    <?php endwhile; ?>
</div>
</body>
</html>
