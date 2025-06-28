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
    echo '<script>window.location.href="cemilan.php";</script>';
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Macam-Macam Cemilan</title>
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
      padding: 12px 20px;
      font-family: 'Fredoka One', cursive;
      font-size: 1.5rem;
      letter-spacing: 1px;
      border-radius: 0 0 20px 20px;
    }

    .menu-wrapper {
      display: flex;
      overflow-x: auto;
      padding: 20px 0 120px;
      justify-content: center;
      gap: 20px;
    }

    .menu-column {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .menu-card {
      width: 140px;
      background: #70bebe;
      border: 4px solid #f9b233;
      border-radius: 15px;
      padding: 10px;
      text-align: center;
      position: relative;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      scroll-snap-align: start;
      animation: slideIn 0.5s ease forwards;
      opacity: 0;
    }

    @keyframes slideIn {
      from {
        transform: translateY(30px);
        opacity: 0;
      }
      to {
        transform: translateY(0);
        opacity: 1;
      }
    }

    .menu-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }

    .menu-card img {
      width: 100px;
      height: 100px;
      object-fit: cover;
      border-radius: 50%;
    }

    .plus-icon {
      position: absolute;
      top: 5px;
      left: 5px;
      background: #333;
      color: white;
      border-radius: 50%;
      padding: 5px 8px;
      font-size: 14px;
      cursor: pointer;
      transition: transform 0.2s ease;
    }

    .plus-icon:hover {
      animation: pulse 0.4s ease-in-out;
    }

    @keyframes pulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.2); }
      100% { transform: scale(1); }
    }

    .menu-card .price {
      font-weight: bold;
      margin-top: 8px;
    }

    .menu-card .name {
      margin-top: 4px;
      font-size: 0.9rem;
      text-transform: uppercase;
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
      font-size: 26px;
      text-decoration: none;
      color: #333;
      transition: transform 0.2s ease;
    }

    .footer-nav a:hover {
      transform: scale(1.1);
    }
  </style>
</head>
<body>
  <div class="header">MACAM-MACAM CEMILAN</div>

  <div class="menu-wrapper">
    <?php
    $baseMenus = [
      ['nama' => 'Pisang Goreng', 'harga' => 7000, 'gambar' => 'pisang.jpg'],
      ['nama' => 'Tahu Isi', 'harga' => 8000, 'gambar' => 'tahuisi.jpg'],
      ['nama' => 'Cireng ayam barudak', 'harga' => 7000, 'gambar' => 'cireng.jpg'],
      ['nama' => 'Klepon heboh', 'harga' => 6000, 'gambar' => 'klepon.jpg'],
      ['nama' => 'Risoles', 'harga' => 7000, 'gambar' => 'risoles.jpg'],
      ['nama' => 'Lumpia AA', 'harga' => 8000, 'gambar' => 'lumpiaboom.jpg'],
      ['nama' => 'Martabak Mini', 'harga' => 9000, 'gambar' => 'martabak_mini.jpg'],
      ['nama' => 'Dimsum teh ayun', 'harga' => 6000, 'gambar' => 'dimsum.jpg'],
      ['nama' => 'basreng teteh', 'harga' => 7000, 'gambar' => 'basreng.jpg'],
      ['nama' => 'Pentol gila', 'harga' => 5000, 'gambar' => 'pentol.jpg']
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

    $chunks = array_chunk($menus, ceil(count($menus)/2));
    foreach ($chunks as $column) {
      echo '<div class="menu-column">';
      foreach ($column as $index => $menu) {
        $delay = $index * 0.1;
        echo '
          <form method="POST" class="menu-card" style="animation-delay: ' . $delay . 's;">
            <button type="submit" class="plus-icon"><i class="fas fa-plus"></i></button>
            <img src="assets/' . $menu['gambar'] . '" alt="' . htmlspecialchars($menu['nama']) . '">
            <div class="price">Rp ' . number_format($menu['harga'], 0, ',', '.') . '</div>
            <div class="name">' . htmlspecialchars($menu['nama']) . '</div>
            <input type="hidden" name="item" value="' . htmlspecialchars($menu['nama']) . '">
            <input type="hidden" name="price" value="' . $menu['harga'] . '">
          </form>';
      }
      echo '</div>';
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
