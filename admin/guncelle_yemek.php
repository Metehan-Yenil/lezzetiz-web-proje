<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <h1 class="adminh1">ADMIN Panel</h1>
    <style>
        h1{
            text-align: center;
            background-color: red;
            color: white;
            font-size: 3em;
            font-weight: bold;
            padding: 0 1rem;
            border-radius: 0.5rem;
        }
    </style>
</head>
<body>
    
</body>
</html>

<?php
 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lezzetdb";
 
$conn = new mysqli($servername, $username, $password, $dbname);

 
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
     
    $tarifID = $_POST['tarifID'];
    $tarifBasligi = $_POST['tarifBasligi'];
    $tarifAciklamasi = $_POST['tarifAciklamasi'];
    $hazirlanmaSuresi = $_POST['hazirlanmaSuresi'];
    $kacKisilik = $_POST['kacKisilik'];
    $pisirmeSuresi = $_POST['pisirmeSuresi'];
    $malzemeler = $_POST['malzemeler'];
    $nasilYapilir = $_POST['nasilYapilir'];

    // Güncelleme sorgusu
    $sql = "UPDATE yemektarifleri SET
            tarif_basligi = ?,
            tarif_aciklamasi = ?,
            hazirlanma_suresi = ?,
            kac_kisilik = ?,
            pisirme_suresi = ?,
            malzemeler = ?,
            nasilyapilir = ?
            WHERE tarifid = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssi", $tarifBasligi, $tarifAciklamasi, $hazirlanmaSuresi, $kacKisilik, $pisirmeSuresi, $malzemeler, $nasilYapilir, $tarifID);

    if ($stmt->execute()) {
        echo "Yemek tarifi başarıyla güncellendi.";
        echo "<script>
            setTimeout(function() {
                window.location.href = 'admin.php';
            }, 3000); // 3000 milisaniye (3 saniye) bekletme süresi
          </script>";
        
        exit();
    } else {
        echo "Güncelleme hatası: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Geçersiz istek.";
}

$conn->close();
?>

