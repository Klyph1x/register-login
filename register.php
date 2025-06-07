<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($username === '' || $password === '') {
        $error = "kullanıcı adı ve şifre giriniz.";
    } else {
        $users = file('users.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $exists = false;
        foreach ($users as $user) {
            list($u, $p) = explode(':', $user);
            if ($u === $username) {
                $exists = true;
                break;
            }
        }
        if ($exists) {
            $error = "Bu kullanıcı adı zaten alınmış";
        } else {
            //şifre hash
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            file_put_contents('users.txt', $username . ':' . $hashedPassword . PHP_EOL, FILE_APPEND);
            $succsss = "KAYIT BAŞARILI";
        }
    }
}
?>




<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Kayıt Ol</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h2>Kayıt Ol</h2>
        <?php if (isset($error)) echo "<div class='message error'>$error</div>"; ?>
        <?php if (isset($success)) echo "<div class='message success'>$success</div>"; ?>

        <form method="post">
            <input type="text" name="username" placeholder="Kullanıcı Adı" required>
            <input type="password" name="password" placeholder="Şifre" required>
            <button type="submit">Kayıt Ol</button>
        </form>

        <p>Zaten hesabın var mı? <a href="login.php">Giriş yap</a></p>
    </div>
</body>

</html>