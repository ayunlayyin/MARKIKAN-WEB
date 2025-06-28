<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['item'], $_POST['price'])) {
    $item = $_POST['item'];
    $price = (int) $_POST['price'];
    $_SESSION['cart'][] = ['item' => $item, 'price' => $price];
    echo '<script>window.location.href="minuman.php";</script>';
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Minuman Segar</title>
  <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: url('assets/bgputih1.jpg') no-repeat center center fixed;
      background-size: cover;
      overflow-x: hidden;
    }

    .header {
      text-align: center;
      background-color: #4dd0e1;
      padding: 15px 20px;
      font-family: 'Fredoka One', cursive;
      font-size: 1.8rem;
      letter-spacing: 1px;
      border-radius: 0 0 20px 20px;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .menu-section {
      padding: 25px 20px 140px;
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
      gap: 20px;
    }

    .menu-card {
      background: #ffffffcc;
      border: 3px solid #4dd0e1;
      border-radius: 15px;
      padding: 15px 10px;
      text-align: center;
      position: relative;
      transition: transform 0.2s, box-shadow 0.3s;
      box-shadow: 0 4px 8px rgba(0,0,0,0.08);
    }

    .menu-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 10px rgba(0,0,0,0.12);
    }

    .menu-card img {
      width: 100px;
      height: 100px;
      object-fit: cover;
      border-radius: 50%;
      margin-bottom: 8px;
    }

    .plus-icon {
      position: absolute;
      top: 10px;
      left: 10px;
      background: #333;
      color: white;
      border-radius: 50%;
      padding: 6px 8px;
      font-size: 14px;
      cursor: pointer;
      transition: transform 0.2s;
    }

    .plus-icon:active {
      transform: scale(1.2);
    }

    .menu-card .price {
      font-weight: bold;
      font-size: 14px;
      color: #00796b;
    }

    .menu-card .name {
      margin-top: 4px;
      font-size: 13px;
      text-transform: uppercase;
      font-weight: 500;
    }

    .checkout-box {
      position: fixed;
      bottom: 75px;
      left: 50%;
      transform: translateX(-50%);
      background-color: #e0f7fa;
      border-radius: 15px;
      display: flex;
      justify-content: space-between;
      width: 90%;
      max-width: 450px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
      font-family: 'Fredoka One', cursive;
      font-weight: bold;
      z-index: 100;
    }

    .checkout-item {
      flex: 1;
      text-align: center;
      padding: 12px 0;
      font-size: 16px;
      border-right: 2px solid #000;
      background-color: #b2ebf2;
      cursor: pointer;
    }

    .checkout-item:last-child {
      border-right: none;
    }

    .footer-nav {
      position: fixed;
      bottom: 0;
      width: 100%;
      background-color: #b2ebf2;
      display: flex;
      justify-content: space-around;
      padding: 12px 0;
      box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.15);
      z-index: 99;
      border-top-left-radius: 20px;
      border-top-right-radius: 20px;
    }

    .footer-nav a {
      font-size: 24px;
      text-decoration: none;
      color: #333;
    }
  </style>
</head>
<body>
  <div class="header">MACAM-MACAM MINUMAN</div>

  <div class="menu-section">
    <?php
    $baseMenus = [
      ['nama' => 'Es Teh', 'harga' => 5000, 'gambar' => 'esteh.jpg'],
      ['nama' => 'Es Jeruk', 'harga' => 6000, 'gambar' => 'esjeruk.jpg'],
      ['nama' => 'Kopi Hitam', 'harga' => 8000, 'gambar' => 'kopi.jpg'],
      ['nama' => 'Cappuccino', 'harga' => 12000, 'gambar' => 'cappuccino.jpg'],
      ['nama' => 'Es Cokelat', 'harga' => 10000, 'gambar' => 'escoklat.jpg'],
      ['nama' => 'Jus Alpukat', 'harga' => 13000, 'gambar' => 'alpukat.jpg'],
      ['nama' => 'Jus Mangga', 'harga' => 11000, 'gambar' => 'mangga.jpg'],
      ['nama' => 'Lemon Tea', 'harga' => 9000, 'gambar' => 'lemontea.jpg'],
      ['nama' => 'es teler', 'harga' => 10000, 'gambar' => 'teler.jpg'],
      ['nama' => 'matcha', 'harga' => 12000, 'gambar' => 'maca.jpg']
    ];

    $menus = [];
    for ($i = 0; $i < 5; $i++) {
      foreach ($baseMenus as $index => $m) {
        $menus[] = [
          'nama' => $m['nama'] . ' ' . ($i * count($baseMenus) + $index + 1),
          'harga' => $m['harga'],
          'gambar' => $m['gambar']
        ];
        if (count($menus) >= 50) break 2;
      }
    }

    foreach ($menus as $menu) {
      echo '
        <form method="POST" class="menu-card">
          <button type="submit" class="plus-icon"><i class="fas fa-plus"></i></button>
          <img src="assets/' . $menu['gambar'] . '" alt="' . htmlspecialchars($menu['nama']) . '">
          <div class="price">Rp ' . number_format($menu['harga'], 0, ',', '.') . '</div>
          <div class="name">' . htmlspecialchars($menu['nama']) . '</div>
          <input type="hidden" name="item" value="' . htmlspecialchars($menu['nama']) . '">
          <input type="hidden" name="price" value="' . $menu['harga'] . '">
        </form>';
    }
    ?>
  </div>

  <div class="checkout-box">
    <div class="checkout-item" onclick="window.location.href='keranjang.php'">Lihat Keranjang</div>
    <div class="checkout-item" onclick="window.location.href='checkout.php'">Checkout</div>
  </div>

  <footer class="footer-nav">
    <a href="beranda.php">🏠</a>
    <a href="kategori.php">📋</a>
    <a href="keranjang.php">🛒</a>
  </footer>
</body>
</html>
