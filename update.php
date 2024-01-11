<?php
// update.php

// Veritabanı bağlantısını sağlayın
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lezzetdb";

// Bağlantıyı oluşturun
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol edin
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// Oturumu başlat
session_start();

// KullanıcıID oturum değişkeninin set edilip edilmediğini kontrol et
if(isset($_SESSION["kullaniciID"])){
    $kullaniciID = $_SESSION["kullaniciID"];
} else {
    // Eğer KullaniciID oturum değişkeni set edilmediyse, uygun bir işlem yap (örneğin, kullanıcıyı giriş sayfasına yönlendir)
    echo "Kullanıcı oturumu bulunamadı.";
    exit();
}

// Güvenli bir sorgu oluşturun
$sql = "UPDATE uyeler SET kullaniciadi = ?, email = ?, ad = ?, soyad = ? WHERE kullaniciid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssi", $kullaniciadi, $email, $ad, $soyad, $kullaniciID);

// POST verilerini al
$kullaniciadi = $_POST['yeniKullaniciAdi'];
$email = $_POST['yeniEmail'];
$ad = $_POST['yeniAd'];
$soyad = $_POST['yeniSoyad'];

// Sorguyu çalıştır
if ($stmt->execute()) {
    echo "Başarıyla güncellendi.";
} else {
    echo "Güncelleme sırasında bir hata oluştu.";
}

// Bağlantıyı kapat
$stmt->close();
$conn->close();
?>