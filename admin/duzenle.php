<?php
 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lezzetdb";

 
$conn = new mysqli($servername, $username, $password, $dbname);
 
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

 
$kullaniciID = $_GET['id'];

 
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
    <link rel="stylesheet" href="styles/duzenle.css">
    <title>Kullanıcı Düzenleme</title>
    <h1 class="adminh1">ADMIN Panel</h1>
    <style>
         
        .guncelle {
            width: 50%;
            margin: auto;
        }

        table {
            width: 100%;
        }

        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>

<div class="duzenle">



    <h2>Kullanıcı Düzenleme</h2>
    <div class="guncelle">

    
    <form action="guncelle.php" method="post">
            <input type="hidden" name="kullaniciID" value="<?php echo $kullaniciID; ?>">

            <table>
                <tr>
                    <td><label for="kullaniciadi">Kullanıcı Adı:</label></td>
                    <td><input type="text" id="kullaniciadi" name="kullaniciadi" value="<?php echo $kullaniciadi; ?>" required></td>
                </tr>
                <tr>
                    <td><label for="email">E-Posta:</label></td>
                    <td><input type="email" id="email" name="email" value="<?php echo $email; ?>" required></td>
                </tr>
                <tr>
                    <td><label for="ad">Ad:</label></td>
                    <td><input type="text" id="ad" name="ad" value="<?php echo $ad; ?>" required></td>
                </tr>
                <tr>
                    <td><label for="soyad">Soyad:</label></td>
                    <td><input type="text" id="soyad" name="soyad" value="<?php echo $soyad; ?>" required></td>
                </tr>
                <tr>
                    <td colspan="2"><button type="submit">Güncelle</button></td>
                </tr>
            </table>
        </form>
    </div>

</div>

</body>
</html>
