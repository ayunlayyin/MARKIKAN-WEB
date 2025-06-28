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
    echo '<script>window.location.href="makanan.php";</script>';
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Macam-Macam Makanan</title>
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
      background-color: #f9b233;
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
      border: 3px solid #f9b233;
      border-radius: 15px;
      padding: 15px 10px;
      text-align: center;
      position: relative;
      opacity: 0;
      animation: bounceIn 0.6s ease forwards;
      box-shadow: 0 4px 8px rgba(0,0,0,0.08);
      transition: transform 0.2s, box-shadow 0.3s;
    }

    .menu-card:hover {
      animation: floatHover 1s infinite ease-in-out;
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
      animation: shake 0.3s ease-in-out;
    }

    .menu-card .price {
      font-weight: bold;
      font-size: 14px;
      color: #e74c3c;
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
      background-color: #fff3cd;
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
      background-color: #fff8dc;
      cursor: pointer;
    }

    .checkout-item:last-child {
      border-right: none;
    }

    .footer-nav {
      position: fixed;
      bottom: 0;
      width: 100%;
      background-color: #fff8dc;
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

    @keyframes bounceIn {
      0% { transform: scale(0.8); opacity: 0; }
      60% { transform: scale(1.1); opacity: 1; }
      100% { transform: scale(1); }
    }

    @keyframes floatHover {
      0% { transform: translateY(0); }
      50% { transform: translateY(-3px); }
      100% { transform: translateY(0); }
    }

    @keyframes shake {
      0% { transform: translate(0, 0); }
      25% { transform: translate(2px, -2px); }
      50% { transform: translate(-2px, 2px); }
      75% { transform: translate(2px, 2px); }
      100% { transform: translate(0, 0); }
    }
  </style>
</head>
<body>
  <div class="header">MACAM-MACAM MAKANAN</div>

  <div class="menu-section">
    <?php
    $baseMenus = [
      ['nama' => 'Op-Or', 'harga' => 15000, 'gambar' => 'opor.jpg'],
      ['nama' => 'Ketoprak', 'harga' => 15000, 'gambar' => 'ketoprak.jpg'],
      ['nama' => 'Rendang', 'harga' => 25000, 'gambar' => 'rendang.jpg'],
      ['nama' => 'Sate Ayam', 'harga' => 20000, 'gambar' => 'sate_ayam.jpg'],
      ['nama' => 'Cumi Pete', 'harga' => 20000, 'gambar' => 'cumi.jpg'],
      ['nama' => 'Seblax', 'harga' => 15000, 'gambar' => 'seblak.jpg'],
      ['nama' => 'Sayur Lodeh', 'harga' => 15000, 'gambar' => 'lodeh.jpg'],
      ['nama' => 'Ikan Bakar', 'harga' => 30000, 'gambar' => 'ikan_bakar.jpg'],
      ['nama' => 'Bakso Urat', 'harga' => 18000, 'gambar' => 'bakso.jpg'],
      ['nama' => 'Ayam Geprek', 'harga' => 17000, 'gambar' => 'geprek.jpg'],
      ['nama' => 'Tahu Campur', 'harga' => 16000, 'gambar' => 'tahu_campur.jpg'],
      ['nama' => 'Gudeg', 'harga' => 20000, 'gambar' => 'gudeg.jpg']
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

    foreach ($menus as $i => $menu) {
      $delay = $i * 0.05;
      echo '
        <form method="POST" class="menu-card" style="animation-delay: '.$delay.'s;">
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
