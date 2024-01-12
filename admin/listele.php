<?php
 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lezzetdb";

 
$conn = new mysqli($servername, $username, $password, $dbname);

 
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

 
$sql = "SELECT * FROM uyeler";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr>";
    echo "<th style='background-color: red;'>Kullanıcı Adı</th>";
    echo "<th style='background-color: red;'>E-Posta</th>";
    echo "<th style='background-color: red;'>Ad</th>";
    echo "<th style='background-color: red;'>Soyad</th>";
    echo "<th style='background-color: red;'>kullaniciid</th>";
    echo "<th style='background-color: red;'></th>";
    echo "<th style='background-color: red;'></th>";
    echo "</tr>";

    
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['kullaniciadi'] . "</td><td>" . $row['email'] . "</td><td>" . $row['ad'] . "</td><td>" . $row['soyad'] . "</td><td>" . $row['kullaniciid']. "</td>";
        echo "<td><button class='duzenlekullanici' onclick='duzenleKullanici(" . $row['kullaniciid'] . ")'style='background-color: lightgreen;'>düzenle</button></td>";
        echo "<td><button class='silkullanici' onclick='silKullanici(" . $row['kullaniciid'] . ")'style='background-color: lightblue;'>sil</button></td></tr>";
    }

    echo "</table>";
} else {
    echo "Kayıtlı kullanıcı bulunamadı.";
}

 
$conn->close();
?>

<script>
    function duzenleKullanici(kullaniciId) {
        window.location.href = 'duzenle.php?id=' + kullaniciId;
    }

    function silKullanici(kullaniciId) {
        if (confirm('Kullanıcıyı silmek istediğinizden emin misiniz?')) {
            window.location.href = 'sil.php?id=' + kullaniciId;
        }
    }
</script>
