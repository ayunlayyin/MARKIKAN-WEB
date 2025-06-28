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
  header("Location: keranjang.php");
  exit();
}

if (isset($_POST['remove'])) {
  $removeIndex = $_POST['remove_index'];
  if (isset($_SESSION['cart'][$removeIndex])) {
    unset($_SESSION['cart'][$removeIndex]);
    $_SESSION['cart'] = array_values($_SESSION['cart']);
  }
}

$cart = $_SESSION['cart'] ?? [];
$total = 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Keranjang</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: url('assets/bgputih.jpg') no-repeat center center fixed;
      background-size: cover;
      color: #333;
      padding: 20px;
      padding-bottom: 120px;
    }

    h1 {
      font-size: 26px;
      text-align: center;
      margin-top: 20px;
      color: #000;
      font-weight: 700;
    }

    p.subtitle {
      text-align: center;
      margin-bottom: 30px;
      color: #444;
      font-weight: 500;
      font-size: 14px;
    }

    .grid-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
      gap: 20px;
    }

    .item-card {
      background-color: #fbbd2c;
      border-radius: 15px;
      padding: 10px;
      box-shadow: 5px 5px 0 #75b9c0;
      display: flex;
      flex-direction: column;
      align-items: center;
      position: relative;
    }

    .item-card .price {
      font-weight: 600;
      font-size: 15px;
      margin-bottom: 3px;
    }

    .item-card .name {
      font-size: 14px;
      text-align: center;
    }

    .item-card form {
      margin-top: 5px;
    }

    .item-card button.remove-btn {
      background-color: #ff4444;
      color: white;
      border: none;
      padding: 5px 10px;
      border-radius: 6px;
      font-size: 12px;
      cursor: pointer;
    }

    .checkout-bar {
      position: fixed;
      bottom: 70px;
      left: 50%;
      transform: translateX(-50%);
      background-color: #fff7dc;
      border: 2px solid #fbbd2c;
      border-radius: 12px;
      width: 90%;
      max-width: 400px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 20px;
      font-family: 'Poppins', sans-serif;
      font-weight: 600;
      box-shadow: 4px 4px 0 #fbbd2c;
    }

    .checkout-bar .total {
      font-size: 14px;
      color: #000;
    }

    .checkout-bar button {
      background-color: #ffa726;
      border: none;
      padding: 8px 16px;
      border-radius: 8px;
      color: white;
      font-weight: 600;
      cursor: pointer;
      transition: 0.3s;
    }

    .checkout-bar button:hover {
      background-color: #ff8f00;
    }

    footer {
      position: fixed;
      bottom: 10px;
      width: 100%;
      display: flex;
      justify-content: space-evenly;
      background-color: transparent;
      z-index: 1000;
    }

    .footer-icon {
      font-size: 20px;
      color: #999;
      text-decoration: none;
      transition: 0.3s ease;
    }

    .footer-icon:hover {
      color: #fdb849;
    }

    .footer-icon.active {
      color: #fdb849;
    }

    @media (max-width: 480px) {
      h1 { font-size: 22px; }
      .checkout-bar .total { font-size: 13px; }
      .checkout-bar button { padding: 6px 12px; font-size: 14px; }
    }
  </style>
</head>
<body>
  <h1>Isi Keranjangmu</h1>
  <p class="subtitle">
    <?php echo empty($cart) ? 'Belum ada menu yang ditambahkan ke keranjang.' : 'Ayo di-checkout, gak enak kalau cuma disimpan...'; ?>
  </p>

  <div class="grid-container">
    <?php foreach ($cart as $index => $item): ?>
      <?php
        $priceNumber = (int) $item['price'];
        $total += $priceNumber;
      ?>
      <div class="item-card">
        <div class="price">Rp <?php echo number_format($priceNumber, 0, ',', '.'); ?></div>
        <div class="name"><?php echo htmlspecialchars($item['item']); ?></div>
        <form method="POST">
          <input type="hidden" name="remove_index" value="<?php echo $index; ?>">
          <button type="submit" name="remove" class="remove-btn">Hapus</button>
        </form>
      </div>
    <?php endforeach; ?>
  </div>

  <?php if (!empty($cart)): ?>
  <div class="checkout-bar">
    <div class="total">Total: Rp <span id="total"><?php echo number_format($total, 0, ',', '.'); ?></span></div>
    <form action="checkout.php" method="post">
      <button type="submit">Checkout</button>
    </form>
  </div>
  <?php endif; ?>

  <?php $current = basename($_SERVER['PHP_SELF']); ?>
  <footer>
    <a href="beranda.php" class="footer-icon <?= $current == 'beranda.php' ? 'active' : '' ?>">🏠</a>
    <a href="kategori.php" class="footer-icon <?= $current == 'kategori.php' ? 'active' : '' ?>">📋</a>
    <a href="keranjang.php" class="footer-icon <?= $current == 'keranjang.php' ? 'active' : '' ?>">🛒</a>
  </footer>
</body>
</html>
