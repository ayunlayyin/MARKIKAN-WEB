<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $item = $_POST['item'];
    $price = (int) $_POST['price'];
    $_SESSION['cart'][] = ['item' => $item, 'price' => $price];
    header("Location: beranda.php?success=1");
    exit();
}

// Promo otomatis berdasarkan waktu
date_default_timezone_set("Asia/Jakarta");
$hour = date("H");
$promoList = [];

if ($hour >= 5 && $hour < 11) {
    $promoList[] = "☀️ Pagi Hemat - Diskon 10%";
} elseif ($hour >= 11 && $hour < 16) {
    $promoList[] = "🌤️ Makan Siang Promo - Gratis Es Teh";
} elseif ($hour >= 16 && $hour < 21) {
    $promoList[] = "🌇 Sore Ceria - Cashback 5rb";
} else {
    $promoList[] = "🌙 Malam Kenyang - Voucher 15rb";
}

if (isset($_GET['voucher'])) {
    $_SESSION['voucher'] = $_GET['voucher'];
    header("Location: beranda.php?voucher_klaim=1");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Beranda - Mari Makan</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
      background-image: url('assets/bgputih1.jpg');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      background-attachment: fixed;
      color: #333;
    }

    .container {
      padding: 20px;
      padding-bottom: 80px;
      max-width: 480px;
      margin: auto;
      background-color: rgba(255, 255, 255, 0.92);
      border-radius: 16px;
    }

    header {
      text-align: center;
      margin-bottom: 20px;
    }

    header p:first-child {
      font-size: 20px;
      font-weight: 600;
      margin: 0 0 5px;
    }

    header p:last-child {
      font-size: 13px;
      color: #777;
      margin: 0;
    }
.logout-button {
  position: fixed;
  top: 15px;
  right: 20px;
  background-color: #e53935;
  color: #fff;
  padding: 8px 14px;
  font-size: 16px;
  border-radius: 30px;
  text-decoration: none;
  display: flex;
  align-items: center;
  gap: 8px;
  font-weight: bold;
  box-shadow: 0 4px 8px rgba(0,0,0,0.2);
  z-index: 1000;
  transition: background-color 0.3s ease, transform 0.3s ease;
}

.logout-button:hover {
  background-color: #c62828;
  transform: scale(1.05);
}

.logout-button i {
  font-size: 18px;
}


    .search-box {
      margin: 15px auto;
      max-width: 300px;
      position: relative;
    }

    .search-box input {
      width: 100%;
      padding: 10px 35px 10px 15px;
      border-radius: 20px;
      border: 1px solid #ccc;
      font-size: 14px;
    }

    .search-icon {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      font-size: 16px;
    }

    .promo-scroll {
      display: flex;
      overflow-x: auto;
      gap: 12px;
      margin: 20px 0 10px;
      padding-bottom: 5px;
      scrollbar-width: none;
    }

    .promo-scroll::-webkit-scrollbar {
      display: none;
    }

    .promo-card {
      flex: 0 0 auto;
      background: linear-gradient(45deg, #ffe29f, #ffc59f);
      padding: 10px 15px;
      border-radius: 12px;
      color: #333;
      font-size: 13px;
      font-weight: 600;
      white-space: nowrap;
      text-decoration: none;
      box-shadow: 0 2px 5px rgba(0,0,0,0.08);
      transition: transform 0.3s ease, background 0.3s ease;
    }

    .promo-card:hover {
      transform: scale(1.05);
      background: linear-gradient(45deg, #ffd77e, #ffb58a);
    }

    .section-title {
      font-size: 18px;
      margin: 25px 0 10px;
      font-weight: bold;
      text-align: left;
    }

    .success-msg {
      background-color: #dff0d8;
      color: #3c763d;
      padding: 10px;
      margin: 10px 0;
      border-radius: 8px;
      text-align: center;
      font-weight: bold;
      animation: fadeSlide 0.5s ease-in-out;
    }

    @keyframes fadeSlide {
      from {
        opacity: 0;
        transform: translateY(-10px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .menu-scroll {
      display: flex;
      flex-direction: row;
      overflow-x: auto;
      gap: 12px;
      padding: 10px 5px;
      scroll-snap-type: x mandatory;
      -webkit-overflow-scrolling: touch;
      scrollbar-width: none;
    }

    .menu-scroll::-webkit-scrollbar {
      display: none;
    }

    .menu-card {
      flex: 0 0 auto;
      width: 135px;
      background-color: #fff7dc;
      border-radius: 15px;
      padding: 10px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      text-align: center;
      position: relative;
      scroll-snap-align: start;
      animation: slideInUp 0.6s ease both;
    }

    @keyframes slideInUp {
      from {
        transform: translateY(30px);
        opacity: 0;
      }
      to {
        transform: translateY(0);
        opacity: 1;
      }
    }

    .menu-card img {
      width: 100%;
      height: 90px;
      border-radius: 10px;
      object-fit: cover;
    }

    .plus-btn {
      position: absolute;
      top: 8px;
      right: 8px;
      background-color: #ff9800;
      color: white;
      border: none;
      border-radius: 50%;
      width: 25px;
      height: 25px;
      font-size: 16px;
      cursor: pointer;
      transition: transform 0.2s ease;
    }

    .plus-btn:hover {
      animation: pulse 0.4s ease-in-out;
    }

    @keyframes pulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.15); }
      100% { transform: scale(1); }
    }

    .price {
      font-weight: bold;
      margin-top: 5px;
      font-size: 14px;
      color: #e74c3c;
    }

    .name {
      font-size: 13px;
      margin-top: 3px;
    }

    footer {
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      background: #ffe0b2;
      display: flex;
      justify-content: space-around;
      padding: 10px 0;
      box-shadow: 0 -1px 5px rgba(0, 0, 0, 0.1);
    }

    .footer-icon {
      font-size: 22px;
      text-decoration: none;
      color: #999;
      transition: color 0.3s ease, transform 0.2s ease;
    }

    .footer-icon.active {
      color: #ff9800;
      transform: scale(1.2);
    }

    .footer-icon:hover {
      transform: scale(1.1);
    }

    @media (max-width: 480px) {
      .menu-scroll {
        overflow-x: auto;
        flex-wrap: nowrap !important;
        justify-content: flex-start;
        padding: 10px;
      }

      .menu-card {
        width: 125px;
      }

      .search-box input {
        font-size: 13px;
      }
    }
  </style>
  <script>
    function filterMenu() {
      const query = document.getElementById('searchInput').value.toLowerCase();
      const cards = document.querySelectorAll('.menu-card');
      cards.forEach(card => {
        const name = card.querySelector('.name').innerText.toLowerCase();
        card.style.display = name.includes(query) ? 'block' : 'none';
      });
    }
  </script>
</head>
<body>

  <div class="container">
    <header>
      <p>MAU MAKAN APA HARI INI.....</p>
      <p>makanlah, karena pura-pura lupa juga perlu tenaga</p>
    </header>

    <div class="search-box">
      <input type="text" placeholder="golet di sini" id="searchInput" onkeyup="filterMenu()">
      <span class="search-icon">🔍</span>
    </div>

    <!-- Promo -->
    <div class="promo-scroll">
      <?php foreach ($promoList as $promo): ?>
        <a href="beranda.php?voucher=<?= urlencode($promo) ?>" class="promo-card"><?= htmlspecialchars($promo) ?></a>
      <?php endforeach; ?>
    </div>

    <?php if (isset($_GET['voucher_klaim'])): ?>
      <div class="success-msg">🎁 Voucher berhasil diklaim: <?= $_SESSION['voucher'] ?></div>
    <?php endif; ?>

    <?php if (isset($_GET['success'])): ?>
      <div class="success-msg">✅ Ditambahkan ke keranjang!</div>
    <?php endif; ?>

    <h3 class="section-title">Rekomendasi</h3>
    <div class="menu-scroll">
      <?php
        $menus = [
          ["name" => "Lumpia Semarang", "img" => "assets/lumpia.jpg", "price" => 15000],
          ["name" => "Mie Goreng Aceh", "img" => "assets/mie.jpg", "price" => 17000],
          ["name" => "Mendoan Banyumas", "img" => "assets/mendoan.jpg", "price" => 10000],
          ["name" => "Bakso Aci Salem", "img" => "assets/bakso_aci.jpg", "price" => 15000],
          ["name" => "Jelly Poeter", "img" => "assets/jelpot.jpg", "price" => 12000],
          ["name" => "Es Teler Juragan", "img" => "assets/teler.jpg", "price" => 17000],
          ["name" => "Sate Madura", "img" => "assets/sate-ayam.jpg", "price" => 20000],
          ["name" => "Tahu Gejrot", "img" => "assets/gejrot.jpg", "price" => 8000],
          ["name" => "Seblak Bandung", "img" => "assets/seblak.jpg", "price" => 13000],
          ["name" => "Soto Betawi", "img" => "assets/soto.jpg", "price" => 18000],
          ["name" => "Pempek Palembang", "img" => "assets/pempek.jpg", "price" => 16000],
          ["name" => "Karedok Sunda", "img" => "assets/karedok.jpg", "price" => 9000]
        ];

        $i = 0;
        foreach ($menus as $menu) {
          $delay = $i * 0.1;
          echo '<form method="POST" action="beranda.php" class="menu-card" style="animation-delay: '.$delay.'s;">';
          echo '<img src="' . $menu['img'] . '" alt="' . htmlspecialchars($menu['name']) . '">';
          echo '<div class="price">Rp ' . number_format($menu['price'], 0, ',', '.') . '</div>';
          echo '<div class="name">' . htmlspecialchars($menu['name']) . '</div>';
          echo '<input type="hidden" name="item" value="' . htmlspecialchars($menu['name']) . '">';
          echo '<input type="hidden" name="price" value="' . $menu['price'] . '">';
          echo '<input type="hidden" name="add_to_cart" value="1">';
          echo '<button class="plus-btn" type="submit">+</button>';
          echo '</form>';
          $i++;
        }
      ?>
    </div>

    <?php $current = basename($_SERVER['PHP_SELF']); ?>
    <footer>
      <a href="beranda.php" class="footer-icon <?= $current == 'beranda.php' ? 'active' : '' ?>">🏠</a>
      <a href="kategori.php" class="footer-icon <?= $current == 'kategori.php' ? 'active' : '' ?>">📋</a>
      <a href="keranjang.php" class="footer-icon <?= $current == 'keranjang.php' ? 'active' : '' ?>">🛒</a>
    </footer>
  </div>
</body>
</html>
