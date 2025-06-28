<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Buat Akun</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="daftar.css">
</head>
<body class="register-page">

    <div class="register-container">
        <h2 class="brand-text">mari makan</h2>
        <h1 class="headline">buat akun baru</h1>

        <form action="daftar.php" method="POST" class="form-box">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="create-btn">Daftar</button>
        </form>

        <p class="login-redirect">sudah punya akun? <a href="login.php">login</a></p>
    </div>
</body>
</html>
