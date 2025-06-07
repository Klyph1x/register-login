<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $users = file('users.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $valid = false;

    foreach ($users as $user) {
        list($u, $hashedPassword) = explode(':', $user, 2);
        if ($u === $username && password_verify($password, $hashedPassword)) {
            $valid = true;
            break;
        }
    }
    if ($valid) {
        $_SESSION['username'] = $username;
        header("Location: welcome.php");
        exit;
    } else {
        $error = "Kullanıcı adı veya şifre yanlış.";
    }
}
?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Giriş Yap</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h2>Giriş Yap</h2>
        <?php if (isset($error)) echo "<div class='message error'>$error</div>"; ?>

        <form method="post">
            <input type="text" name="username" placeholder="Kullanıcı Adı" required>
            <input type="password" name="password" placeholder="Şifre" required>
            <button type="submit">Giriş Yap</button>
        </form>

        <p>Hesabın yok mu? <a href="register.php">Kayıt ol</a></p>
    </div>
</body>

</html>