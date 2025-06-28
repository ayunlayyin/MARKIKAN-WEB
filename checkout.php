<?php

session_start();
$cart = $_SESSION['cart'] ?? [];
$totalHarga = 0;
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Checkout - Mari Makan</title>
  <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: url('assets/bg-checkout.jpg') no-repeat center center fixed;
      background-size: cover;
      color: #333;
    }

    .container {
      max-width: 500px;
      margin: auto;
      padding: 20px;
      background-color: rgba(255, 255, 255, 0.95);
      border-radius: 20px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.2);
      margin-bottom: 120px;
    }

    .header {
      text-align: center;
      font-family: 'Fredoka One', cursive;
      font-size: 1.8rem;
      color: #f57c00;
      margin-bottom: 20px;
    }

    .section-title {
      font-weight: bold;
      margin: 20px 0 10px;
      color: #555;
      font-size: 16px;
    }

    .summary-item {
      display: flex;
      justify-content: space-between;
      margin: 8px 0;
      font-size: 1rem;
    }

    .payment-methods label {
      display: block;
      padding: 10px 15px;
      background: #f9f9f9;
      margin: 10px 0;
      border: 2px solid #ddd;
      border-radius: 12px;
      cursor: pointer;
      transition: 0.3s;
    }

    .payment-methods input:checked + label {
      border-color: #f57c00;
      background-color: #fff3e0;
    }

    input[type="radio"] {
      display: none;
    }

    .form-input {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border-radius: 10px;
      border: 1.5px solid #ccc;
      font-size: 15px;
      box-sizing: border-box;
    }

    .confirm-btn {
      width: 100%;
      padding: 14px;
      margin-top: 25px;
      background-color: #f57c00;
      color: white;
      font-weight: bold;
      font-size: 1rem;
      border: none;
      border-radius: 12px;
      cursor: pointer;
      transition: background 0.3s;
    }

    .confirm-btn:hover {
      background-color: #e65100;
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
    }

    #detailPembayaran {
      margin-top: 10px;
      padding: 10px;
      background-color: #fff8e1;
      border-radius: 10px;
      display: none;
    }

    #qrImage {
      max-width: 100%;
      border-radius: 12px;
      margin-top: 10px;
    }

    @media (max-width: 480px) {
      .container {
        margin: 10px;
        padding: 15px;
      }

      .form-input {
        font-size: 14px;
        padding: 10px 12px;
        margin: 8px 0;
      }

      .section-title {
        font-size: 15px;
      }
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="header">Checkout</div>

    <!-- Ringkasan Pesanan -->
    <div class="section-title">Ringkasan Pesanan</div>
    <?php if (empty($cart)) : ?>
      <p>Keranjang kamu kosong.</p>
    <?php else : ?>
      <?php foreach ($cart as $item): 
        $harga = (int)$item['price'];
        $totalHarga += $harga;
      ?>
        <div class="summary-item">
          <span><?= htmlspecialchars($item['item']) ?> x1</span>
          <span><?= number_format($harga / 1000, 0) ?>K</span>
        </div>
      <?php endforeach; ?>
      <div class="summary-item"><strong>Total</strong><strong><?= number_format($totalHarga / 1000, 0) ?>K</strong></div>
    <?php endif; ?>

    <!-- Form Pengiriman -->
    <div class="section-title">Informasi Pengiriman</div>
    <input type="text" class="form-input" id="nama" placeholder="Nama Penerima" />
    <input type="text" class="form-input" id="alamat" placeholder="Alamat Lengkap" />

    <!-- Metode Pembayaran -->
    <div class="section-title">Metode Pembayaran</div>
    <div class="payment-methods">
      <input type="radio" id="qris" name="payment" value="QRIS" onchange="tampilkanDetail()">
      <label for="qris"><i class="fas fa-qrcode"></i> QRIS (Scan Barcode)</label>

      <input type="radio" id="cod" name="payment" value="COD" onchange="tampilkanDetail()">
      <label for="cod"><i class="fas fa-money-bill-wave"></i> Bayar di Tempat (COD)</label>
    </div>

    <!-- Detail berdasarkan metode -->
    <div id="detailPembayaran"></div>

    <button class="confirm-btn" onclick="confirmOrder()">Konfirmasi Pesanan</button>
  </div>

  <!-- Footer -->
  <footer class="footer-nav">
    <a href="beranda.php" class="footer-icon">🏠</a>
    <a href="kategori.php" class="footer-icon">📋</a>
    <a href="keranjang.php" class="footer-icon">🛒</a>
  </footer>

  <!-- Script -->
  <script>
    function tampilkanDetail() {
      const metode = document.querySelector('input[name="payment"]:checked').value;
      const container = document.getElementById('detailPembayaran');
      container.style.display = 'block';

      if (metode === 'QRIS') {
        container.innerHTML = `
          <div><strong>Silakan scan QR berikut untuk pembayaran:</strong></div>
          <img src="assets/qris.jpg" alt="QRIS Payment" id="qrImage">
        `;
      } else {
        container.innerHTML = `<div><em>Bayar langsung kepada kurir saat pesanan tiba.</em></div>`;
      }
    }

    function confirmOrder() {
      const nama = document.getElementById("nama").value.trim();
      const alamat = document.getElementById("alamat").value.trim();
      const metode = document.querySelector('input[name="payment"]:checked');

      if (!nama || !alamat || !metode) {
        alert("Mohon lengkapi semua data pengiriman dan pilih metode pembayaran!");
        return;
      }

      sessionStorage.setItem("namaPenerima", nama);
      sessionStorage.setItem("alamatPenerima", alamat);
      sessionStorage.setItem("metodePembayaran", metode.value);
      sessionStorage.setItem("totalHarga", "<?= number_format($totalHarga / 1000, 0) ?>K");

      window.location.href = "pesanan_sukses.php";
    }
  </script>

</body>
</html>
