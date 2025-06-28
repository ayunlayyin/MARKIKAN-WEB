<?php
session_start();

if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = $_POST['nama'] ?? '';
  $harga = $_POST['harga'] ?? 0;

  $found = false;
  foreach ($_SESSION['cart'] as &$item) {
    if ($item['nama'] === $nama) {
      $item['qty'] += 1;
      $found = true;
      break;
    }
  }

  if (!$found) {
    $_SESSION['cart'][] = [
      'nama' => $nama,
      'harga' => $harga,
      'qty' => 1
    ];
  }
}
?>
