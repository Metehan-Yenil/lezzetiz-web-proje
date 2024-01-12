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
    <title>Yemek Tarifi Silme</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 100vh;
            margin: 0;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            max-width: 600px;
            margin: auto;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: red;
            color: white;
        }

        h2, p {
            text-align: center;
            margin-bottom: 1rem;
        }

        form, a {
            margin-top: 1rem;
        }

        button {
            background-color: red;
            color: white;
            padding: 8px;
            border: none;
            cursor: pointer;
        }

        a {
            text-decoration: none;
            color: red;
            margin-left: 1rem;
        }
    </style>
</head>
<body>
    <h2>Yemek Tarifi Silme</h2>

    <table>
        <tr>
            <th>Tarif Bilgileri</th>
            <th></th>
        </tr>
        <tr>
            <td>Tarif Başlığı:</td>
            <td><?php echo $tarifBasligi; ?></td>
        </tr>
        <tr>
            <td>Tarif Açıklaması:</td>
            <td><?php echo $tarifAciklamasi; ?></td>
        </tr>
        <tr>
            <td>Hazırlanma Süresi:</td>
            <td><?php echo $hazirlanmaSuresi; ?></td>
        </tr>
        <tr>
            <td>Kaç Kişilik:</td>
            <td><?php echo $kacKisilik; ?></td>
        </tr>
        <tr>
            <td>Pişirme Süresi:</td>
            <td><?php echo $pisirmeSuresi; ?></td>
        </tr>
        <tr>
            <td>Kullanıcı ID:</td>
            <td><?php echo $kullaniciID; ?></td>
        </tr>
        <tr>
            <td>Malzemeler:</td>
            <td><?php echo $malzemeler; ?></td>
        </tr>
        <tr>
            <td>Nasıl Yapılır:</td>
            <td><?php echo $nasilYapilir; ?></td>
        </tr>
    </table>

    <form action="sil_confirm_yemek.php" method="post">
        <input type="hidden" name="tarifID" value="<?php echo $tarifID; ?>">
        <button type="submit">Evet, Sil</button>
    </form>

    <a href="admin.php">Vazgeç</a>
</body>
</html>
