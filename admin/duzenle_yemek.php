<?php
 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lezzetdb";

 
$conn = new mysqli($servername, $username, $password, $dbname);

 
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

 
$tarifID = $_GET['id'];

 
$sql = "SELECT * FROM yemektarifleri WHERE tarifid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $tarifID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $tarifBasligi = $row['tarif_basligi'];
    $tarifAciklamasi = $row['tarif_aciklamasi'];
    $hazirlanmaSuresi = $row['hazirlanma_suresi'];
    $kacKisilik = $row['kac_kisilik'];
    $pisirmeSuresi = $row['pisirme_suresi'];
    $kullaniciID = $row['kullaniciid'];
    $malzemeler = $row['malzemeler'];
    $nasilYapilir = $row['nasilyapilir'];
} else {
    echo "Yemek tarifi bulunamadı.";
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
    <title>Yemek Tarifi Düzenleme</title>
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
    <h2>Yemek Tarifi Düzenleme</h2>

    <table border='1'>
        <form action="guncelle_yemek.php" method="post">
            <input type="hidden" name="tarifID" value="<?php echo $tarifID; ?>">

            <tr>
                <td><label for="tarifBasligi">Tarif Başlığı:</label></td>
                <td><input type="text" id="tarifBasligi" name="tarifBasligi" value="<?php echo $tarifBasligi; ?>" required></td>
            </tr>

            <tr>
                <td><label for="tarifAciklamasi">Tarif Açıklaması:</label></td>
                <td><textarea id="tarifAciklamasi" name="tarifAciklamasi" required><?php echo $tarifAciklamasi; ?></textarea></td>
            </tr>

            <tr>
                <td><label for="hazirlanmaSuresi">Hazırlanma Süresi:</label></td>
                <td><input type="text" id="hazirlanmaSuresi" name="hazirlanmaSuresi" value="<?php echo $hazirlanmaSuresi; ?>" required></td>
            </tr>

            <tr>
                <td><label for="kacKisilik">Kaç Kişilik:</label></td>
                <td><input type="text" id="kacKisilik" name="kacKisilik" value="<?php echo $kacKisilik; ?>" required></td>
            </tr>

            <tr>
                <td><label for="pisirmeSuresi">Pişirme Süresi:</label></td>
                <td><input type="text" id="pisirmeSuresi" name="pisirmeSuresi" value="<?php echo $pisirmeSuresi; ?>" required></td>
            </tr>

            <tr>
                <td><label for="malzemeler">Malzemeler:</label></td>
                <td><textarea id="malzemeler" name="malzemeler" required><?php echo $malzemeler; ?></textarea></td>
            </tr>

            <tr>
                <td><label for="nasilYapilir">Nasıl Yapılır:</label></td>
                <td><textarea id="nasilYapilir" name="nasilYapilir" required><?php echo $nasilYapilir; ?></textarea></td>
            </tr>

            <tr>
                <td colspan="2"><button type="submit">Güncelle</button></td>
            </tr>
        </form>
    </table>
</body>
</html>
