<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Pesanan Berhasil - Ayuni Layinah Production</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      font-family: 'Poppins', sans-serif;
      background: #e7f5f9;
      color: #222;
      overflow-x: hidden;
    }

    .marquee {
      width: 100%;
      white-space: nowrap;
      overflow: hidden;
      font-size: 14px;
      font-weight: 600;
      color: #0a3d62;
      padding: 12px 0;
      animation: scroll-left 18s linear infinite;
      text-align: center;
    }

    @keyframes scroll-left {
      0% { transform: translateX(100%); }
      100% { transform: translateX(-100%); }
    }

    .container {
      max-width: 720px;
      margin: 50px auto;
      background: #ffffff;
      border-radius: 18px;
      padding: 50px 35px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
      text-align: center;
      animation: fadeIn 1s ease;
      position: relative;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(40px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .brand {
      font-family: 'Playfair Display', serif;
      font-size: 28px;
      color: #0a3d62;
      font-weight: bold;
      margin-bottom: 15px;
      letter-spacing: 1px;
    }

    .checkmark {
      font-size: 70px;
      color: #20bf6b;
      margin-bottom: 20px;
      animation: rotatePop 1s ease-out;
    }

    @keyframes rotatePop {
      0% { transform: rotate(-360deg) scale(0); opacity: 0; }
      100% { transform: rotate(0) scale(1); opacity: 1; }
    }

    h1 {
      font-size: 28px;
      color: #2c3e50;
      margin-bottom: 12px;
    }

    p {
      font-size: 16px;
      color: #555;
      margin-bottom: 30px;
    }

    .button {
      display: inline-block;
      padding: 14px 30px;
      background-color: #0a3d62;
      color: #ffd700;
      text-decoration: none;
      border-radius: 30px;
      font-weight: 600;
      font-size: 16px;
      animation: pulse 2s infinite;
      transition: all 0.3s ease;
      margin-bottom: 15px;
    }

    .button:hover {
      background-color: #145374;
      transform: scale(1.05);
    }

    @keyframes pulse {
      0%, 100% { transform: scale(1); }
      50% { transform: scale(1.07); }
    }

    .logout-button {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background-color: #e53935;
      color: #fff;
      padding: 10px 20px;
      font-size: 16px;
      border-radius: 30px;
      text-decoration: none;
      font-weight: bold;
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
      transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .logout-button:hover {
      background-color: #c62828;
      transform: scale(1.05);
    }

    .logout-button i {
      font-size: 18px;
    }

    .contact {
      margin-top: 35px;
      font-size: 15px;
      color: #444;
    }

    .contact-icons {
      margin-top: 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 20px;
      font-size: 22px;
    }

    .contact-icons a {
      color: #0a3d62;
      transition: all 0.3s ease;
    }

    .contact-icons a:hover {
      color: #ffd700;
      transform: scale(1.2) rotate(3deg);
    }

    .contact-label {
      font-size: 13px;
      color: #777;
    }

    footer {
      text-align: center;
      font-size: 12px;
      color: #888;
      margin-top: 50px;
    }

    #confetti-canvas {
      position: fixed;
      top: 0;
      left: 0;
      pointer-events: none;
      width: 100%;
      height: 100%;
      z-index: 999;
    }
  </style>
</head>
<body>

  <!-- Teks Berjalan -->
  <div class="marquee">💙 Kami hanya melakukan layanan terbaik untuk Anda 💙</div>

  <!-- Confetti -->
  <canvas id="confetti-canvas"></canvas>

  <!-- Kontainer Utama -->
  <div class="container">
    <div class="brand">AYUNI LAYINAH PRODUCTION</div>
    <div class="checkmark">✅</div>
    <h1>Pesananmu Berhasil!</h1>
    <p>Pesananmu sedang kami proses. Terima kasih atas kepercayaanmu, semoga harimu menyenangkan!</p>
    <a class="button" href="beranda.php">Kembali ke Beranda</a><br>
    <a href="logout.php" class="logout-button" title="Keluar">
      <i class="fas fa-power-off"></i> <span>Logout</span>
    </a>

    <div class="contact">
      <p>Hubungi Kami:</p>
      <div class="contact-icons">
        <div>
          <a href="https://wa.me/6285227156575" target="_blank">
            <i class="fab fa-whatsapp"></i>
          </a>
          <div class="contact-label">0852-2715-6575</div>
        </div>
        <div>
          <a href="https://instagram.com/ayunlayyin" target="_blank">
            <i class="fab fa-instagram"></i>
          </a>
          <div class="contact-label">@ayunlayyin</div>
        </div>
      </div>
    </div>
  </div>

  <footer>&copy; 2025 Ayuni Layinah Production. All rights reserved.</footer>

  <!-- Confetti Script -->
  <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
  <script>
    const duration = 2 * 1000;
    const animationEnd = Date.now() + duration;
    const defaults = { startVelocity: 30, spread: 360, ticks: 60, zIndex: 1000 };

    const interval = setInterval(() => {
      const timeLeft = animationEnd - Date.now();
      if (timeLeft <= 0) return clearInterval(interval);
      const particleCount = 50 * (timeLeft / duration);
      confetti(Object.assign({}, defaults, {
        particleCount,
        origin: { x: Math.random(), y: Math.random() - 0.2 }
      }));
    }, 250);
  </script>
</body>
</html>
