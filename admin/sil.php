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
$kullaniciID = $_GET['id'];

// Veritabanından kullanıcı bilgilerini al
$sql = "SELECT kullaniciadi, email, ad, soyad FROM uyeler WHERE kullaniciid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $kullaniciID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $kullaniciadi = $row['kullaniciadi'];
    $email = $row['email'];
    $ad = $row['ad'];
    $soyad = $row['soyad'];
} else {
    echo "Kullanıcı bilgileri bulunamadı.";
    exit();
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kullanıcı Silme</title>
</head>
<body>
    <h2>Kullanıcı Silme</h2>

    <p>Kullanıcıyı silmek istediğinizden emin misiniz?</p>

    <p>Kullanıcı Adı: <?php echo $kullaniciadi; ?></p>
    <p>E-Posta: <?php echo $email; ?></p>
    <p>Ad: <?php echo $ad; ?></p>
    <p>Soyad: <?php echo $soyad; ?></p>

    <form action="sil_confirm.php" method="post">
        <input type="hidden" name="kullaniciID" value="<?php echo $kullaniciID; ?>">
        <button type="submit">Evet, Sil</button>
    </form>

    <a href="index.php">Vazgeç</a>
</body>
</html>
