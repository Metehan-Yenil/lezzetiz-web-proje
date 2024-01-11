<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <style>
        .adminh1 {
    text-align: center;
    background-color: red;
    color: white;
    font-size: 3em;
    font-weight: bold;
    padding: 0 1rem;
    border-radius: 0.5rem;
  }
    </style>
    <h1 class="adminh1">ADMIN Panel</h1>
</head>
<body>
    
</body>
</html>
<?php
// Veritabanı bağlantısı için bilgiler
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lezzetdb";

// Bağlantıyı oluştur
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// Kullanıcı ID'sini ve diğer form verilerini al
$kullaniciID = $_POST['kullaniciID'];
$kullaniciadi = $_POST['kullaniciadi'];
$email = $_POST['email'];
$ad = $_POST['ad'];
$soyad = $_POST['soyad'];

// Kullanıcıyı güncelleme sorgusu
$sql = "UPDATE uyeler SET kullaniciadi = ?, email = ?, ad = ?, soyad = ? WHERE kullaniciid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssi", $kullaniciadi, $email, $ad, $soyad, $kullaniciID);

// Güncelleme işlemini gerçekleştir
if ($stmt->execute()) {
    echo "Kullanıcı başarıyla güncellendi.";
    echo "<script>
            setTimeout(function() {
                window.location.href = 'admin.php';
            }, 3000); // 3000 milisaniye (3 saniye) bekletme süresi
          </script>";
} else {
    echo "Güncelleme işlemi sırasında bir hata oluştu.";
    echo "<script>
            setTimeout(function() {
                window.location.href = 'admin.php';
            }, 3000); // 3000 milisaniye (3 saniye) bekletme süresi
          </script>";
}

$stmt->close();
$conn->close();
?>
