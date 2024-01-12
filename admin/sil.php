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
    <title>Kullanıcı Silme</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        h1 {
            text-align: center;
            background-color: red;
            color: white;
            font-size: 3em;
            font-weight: bold;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
        }

        table {
            width: 80%;
            max-width: 600px;
            margin-top: 1rem;
            border-collapse: collapse;
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
    <h1 class="adminh1">ADMIN Panel</h1>

    <h2>Kullanıcı Silme</h2>

    <p>Kullanıcıyı silmek istediğinizden emin misiniz?</p>

    <table>
        <tr>
            <th>Bilgi</th>
            <th>Değer</th>
        </tr>
        <tr>
            <td>Kullanıcı Adı:</td>
            <td><?php echo $kullaniciadi; ?></td>
        </tr>
        <tr>
            <td>E-Posta:</td>
            <td><?php echo $email; ?></td>
        </tr>
        <tr>
            <td>Ad:</td>
            <td><?php echo $ad; ?></td>
        </tr>
        <tr>
            <td>Soyad:</td>
            <td><?php echo $soyad; ?></td>
        </tr>
    </table>

    <form action="sil_confirm.php" method="post">
        <input type="hidden" name="kullaniciID" value="<?php echo $kullaniciID; ?>">
        <button type="submit">Evet, Sil</button>
    </form>

    <a href="admin.php">Vazgeç</a>
</body>
</html>
