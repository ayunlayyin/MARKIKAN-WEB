<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kategori</title>
  <link rel="stylesheet" href="kategori.css" />
  <link href="https://fonts.googleapis.com/css2?family=Rock+Salt&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

 <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body, html {
      font-family: 'Poppins', sans-serif;
      height: 100%;
      width: 100%;
    }

    .background {
  background-image: url("assets/bghitam.jpg"); /* atau "images/bghitam.jpg" jika foldernya berbeda */
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
  padding: 20px;
  min-height: 100vh;
  position: relative;
}


    .title {
      font-family: 'Rock Salt', cursive;
      color: #fff7dc;
      font-size: 30px;
      text-align: center;
      text-shadow: 2px 2px #f9a825;
      margin-top: 20px;
    }

    .subtitle {
      text-align: center;
      color: #fff;
      margin-bottom: 40px;
      font-weight: 600;
      font-size: 16px;
    }

    .menu-box {
      position: relative;
      width: 85%;
      max-width: 400px;
      margin: 20px auto;
      background-color: #fff7dc;
      border-radius: 10px;
      box-shadow: 5px 5px 0 #f9a825;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 20px;
      font-weight: bold;
      font-size: 16px;
      cursor: pointer;
      transition: 0.2s;
    }

    .menu-box:hover {
      transform: scale(1.02);
    }

    .menu-box span {
      font-size: 18px;
      font-weight: 600;
      color: #000;
    }

    .menu-box img {
      width: 25px;
      height: 25px;
    }

     footer {
    position: fixed;
    bottom: 10px;
    left: 0;
    width: 100%;
    display: flex;
    justify-content: space-evenly;
    background-color: transparent;
    padding: 10px 0;
    z-index: 999;
  }

  .icon {
    background-color: white;
    border-radius: 15px;
    padding: 12px;
    box-shadow: 2px 2px 5px rgba(0,0,0,0.2);
    cursor: pointer;
  }

  .icon.active {
    background-color: #ffa726;
  }

  .icon img {
    width: 40px;
    height: 40px;
  }

  /* Untuk emoji footer jika tidak pakai img */
  .footer-icon {
    font-size: 36px;
    text-decoration: none;
    color: #999;
    transition: 0.3s ease;
    background-color: white;
    padding: 10px;
    border-radius: 25px;
    box-shadow: 2px 2px 5px rgba(0,0,0,0.2);
  }

  .footer-icon.active {
    background-color: #ffa726;
    color: white;
  }

  .footer-icon:hover {
    color: #fdb849;
  }

    .icon {
      background-color: white;
      border-radius: 15px;
      padding: 10px;
      box-shadow: 2px 2px 5px rgba(0,0,0,0.2);
      cursor: pointer;
    }

    .icon.active {
      background-color: #ffa726;
    }

    .icon img {
      width: 25px;
      height: 25px;
    }
  </style>
</head>
<body>
  <div class="background">
    <h1 class="title">menu kami</h1>
    <p class="subtitle">pilih kategori</p>

   <div class="menu-box" onclick="window.location.href='makanan.php'">
  <span>macam-macam makanan</span>
  <i class="fas fa-chevron-right"></i>
</div>

<div class="menu-box" onclick="window.location.href='minuman.php'">
  <span>macam-macam minuman</span>
  <i class="fas fa-chevron-right"></i>
</div>

<div class="menu-box" onclick="window.location.href='cemilan.php'">
  <span>atau mau cemilan</span>
  <i class="fas fa-chevron-right"></i>
</div>

  </div>

  <footer>
  <a href="beranda.php" class="footer-icon <?= $current == 'beranda.php' ? 'active' : '' ?>">🏠</a>
  <a href="kategori.php" class="footer-icon <?= $current == 'kategori.php' ? 'active' : '' ?>">📋</a>
  <a href="keranjang.php" class="footer-icon <?= $current == 'keranjang.php' ? 'active' : '' ?>">🛒</a>

  </footer>
</body>
</html>
