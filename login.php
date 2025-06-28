<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Mari Makan</title>
  <link rel="stylesheet" href="login.css">
</head>
<body>
  <!-- Segitiga latar -->
  <div class="triangle triangle-top-left"></div>
  <div class="triangle triangle-middle-left"></div>
  <div class="triangle triangle-bottom-right"></div>

  <div class="login-container">
    <!-- Logo -->
    <div class="logo-wrapper">
      <img src="assets/logo.png" alt="Logo" class="logo-img">
    </div>
    <h2 class="brand-text">mari makan</h2>

    <!-- Form login -->
    <form action="proses_login.php" method="POST">
      <input type="email" name="email" placeholder="email" required>
      <input type="password" name="password" placeholder="password" required>
      <button type="submit">LOGIN</button>
    </form>
  </div>
</body>
</html>
