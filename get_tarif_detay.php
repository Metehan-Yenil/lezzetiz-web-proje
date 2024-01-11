<!-- get_tarif_detay.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="get_tarif_detay.css"> <!-- CSS dosyasını bağlama -->
 
</head>
<body>
    
</body>
</html>

<?php
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

// Tarif detaylarını sorgula
if (isset($_GET['tarifid'])) {
    $tarifId = $_GET['tarifid'];

    $sql = "SELECT * FROM yemektarifleri WHERE tarifid = $tarifId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<h2>" . $row['tarif_basligi'] . "</h2>";
        echo "<br>";
        echo "<h3>Tarif Açıklaması:</h3><p> " . $row['tarif_aciklamasi'] . "</p>";
        echo "<br>";
        echo "<h4>Hazırlanma Süresi:</h4><p> " . $row['hazirlanma_suresi'] . " dakika</p>";
        echo "<h4>Kaç Kişilik: </h4><p>" . $row['kac_kisilik'] . "</p>";
        echo "<h4>Pişirme Süresi:</h4> <p>" . $row['pisirme_suresi'] . "</p>";
        echo "<br>";
        echo "<h4>Malzemeler:</h4><p> " . $row['malzemeler'] . "</p>";
        echo "<br>";
        echo "<h4>Nasıl Yapılır:</h4><p> " . $row['nasilyapilir'] . "</p>";
    } else {
        echo "Tarif bulunamadı.";
    }
} else {
    echo "Hatalı istek.";
}

$conn->close();
?>
