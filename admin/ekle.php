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

 
$conn->close();
?>
