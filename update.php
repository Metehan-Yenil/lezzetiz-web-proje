<?php
 

 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lezzetdb";

 
$conn = new mysqli($servername, $username, $password, $dbname);

 
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

 
session_start();

 
if(isset($_SESSION["kullaniciID"])){
    $kullaniciID = $_SESSION["kullaniciID"];
} else {
     
    echo "Kullanıcı oturumu bulunamadı.";
    exit();
}

 
$sql = "UPDATE uyeler SET kullaniciadi = ?, email = ?, ad = ?, soyad = ? WHERE kullaniciid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssi", $kullaniciadi, $email, $ad, $soyad, $kullaniciID);

 
$kullaniciadi = $_POST['yeniKullaniciAdi'];
$email = $_POST['yeniEmail'];
$ad = $_POST['yeniAd'];
$soyad = $_POST['yeniSoyad'];

 
if ($stmt->execute()) {
    echo "Başarıyla güncellendi.";
} else {
    echo "Güncelleme sırasında bir hata oluştu.";
}

 
$stmt->close();
$conn->close();
?>