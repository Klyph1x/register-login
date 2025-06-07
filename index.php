<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = htmlspecialchars($_SESSION['username']);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Hoş Geldin</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h2>Hoş Geldin, <?php echo $username; ?>!</h2>
        <p>Giriş başarılı. Artık bu sayfayı görebilirsin.</p>
        <a href="logout.php">Çıkış Yap</a>
    </div>
</body>

</html>