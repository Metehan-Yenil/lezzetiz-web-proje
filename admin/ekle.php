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

// Formdan gelen verileri al
$kullaniciadi = $_POST['kullaniciadi'];
$email = $_POST['email'];
$ad = $_POST['ad'];
$soyad = $_POST['soyad'];

// Veritabanına ekleme sorgusu
$sql = "INSERT INTO uyeler (kullaniciadi, email, ad, soyad) VALUES ('$kullaniciadi', '$email', '$ad', '$soyad')";

if ($conn->query($sql) === TRUE) {
    echo "Yeni kullanıcı başarıyla eklendi.";
    echo "<script>
    setTimeout(function() {
        window.location.href = 'admin.php';
    }, 3000); // 3000 milisaniye (3 saniye) bekletme süresi
  </script>";
    
} else {
    echo "Hata: " . $sql . "<br>" . $conn->error;
    echo "<script>
    setTimeout(function() {
        window.location.href = 'admin.php';
    }, 3000); // 3000 milisaniye (3 saniye) bekletme süresi
  </script>";
}

// Veritabanı bağlantısını kapat
$conn->close();
?>
