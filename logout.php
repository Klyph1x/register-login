<?php
session_start();
session_destroy(); // Tüm oturum verilerini temizle
header("Location: login.php"); // Login sayfasına yönlendir
exit;
