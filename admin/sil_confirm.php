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

// Kullanıcı ID'sini al
$kullaniciID = $_POST['kullaniciID'];

// Kullanıcıyı silme sorgusu
$sql = "DELETE FROM uyeler WHERE kullaniciid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $kullaniciID);

// Silme işlemini gerçekleştir
if ($stmt->execute()) {
    echo "Kullanıcı başarıyla silindi.";

    // JavaScript ile yönlendirme
    echo "<script>
            setTimeout(function() {
                window.location.href = 'admin.php';
            }, 3000); // 3000 milisaniye (3 saniye) bekletme süresi
          </script>";
} else {
    echo "Silme işlemi sırasında bir hata oluştu.";
    echo "<script>
            setTimeout(function() {
                window.location.href = 'admin.php';
            }, 3000); // 3000 milisaniye (3 saniye) bekletme süresi
          </script>";
}

$stmt->close();
$conn->close();
?>
