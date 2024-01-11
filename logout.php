<?php
// Oturumu başlat
session_start();

// Oturumu sonlandır
session_destroy();

// Kullanıcıyı giriş sayfasına yönlendir
header("Location: kayit.php");
exit();
?>