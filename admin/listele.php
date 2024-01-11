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

// Mevcut kullanıcıları listeleme sorgusu
$sql = "SELECT * FROM uyeler";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Kullanıcı Adı</th><th>E-Posta</th><th>Ad</th><th>Soyad</th><th>kullaniciid</th><th></th><th></th></tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['kullaniciadi'] . "</td><td>" . $row['email'] . "</td><td>" . $row['ad'] . "</td><td>" . $row['soyad'] . "</td><td>" . $row['kullaniciid']. "</td>";
        echo "<td><button class='duzenlekullanici' onclick='duzenleKullanici(" . $row['kullaniciid'] . ")'>düzenle</button></td>";
        echo "<td><button class='silkullanici' onclick='silKullanici(" . $row['kullaniciid'] . ")'>sil</button></td></tr>";
    }

    echo "</table>";
} else {
    echo "Kayıtlı kullanıcı bulunamadı.";
}

// Veritabanı bağlantısını kapat
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
