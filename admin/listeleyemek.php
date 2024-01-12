

<?php
 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lezzetdb";

 
$conn = new mysqli($servername, $username, $password, $dbname);

 
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

 
$sql = "SELECT * FROM yemektarifleri";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr>";
    echo "<th style='background-color: red;'>Tarif Başlığı</th>";
    echo "<th style='background-color: red;'>Tarif Açıklaması</th>";
    echo "<th style='background-color: red;'>Hazırlanma Süresi</th>";
    echo "<th style='background-color: red;'>Kaç Kişilik</th>";
    echo "<th style='background-color: red;'>Pişirme Süresi</th>";
    echo "<th style='background-color: red;'>Kullanıcı ID</th>";
    echo "<th style='background-color: red;'>Malzemeler</th>";
    echo "<th style='background-color: red;'>Nasıl Yapılır</th>";
    echo "<th style='background-color: red;'>Tarif ID</th>";
    echo "<th style='background-color: red;'></th>";
    echo "<th style='background-color: red;'></th>";
    echo "</tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['tarif_basligi'] . "</td>";
        echo "<td>" . $row['tarif_aciklamasi'] . "</td>";
        echo "<td>" . $row['hazirlanma_suresi'] . "</td>";
        echo "<td>" . $row['kac_kisilik'] . "</td>";
        echo "<td>" . $row['pisirme_suresi'] . "</td>";
        echo "<td>" . $row['kullaniciid'] . "</td>";
        echo "<td>" . $row['malzemeler'] . "</td>";
        echo "<td>" . $row['nasilyapilir'] . "</td>";
        echo "<td>" . $row['tarifid'] . "</td>";
        echo "<td><button class='duzenleyemektarifi' onclick='duzenleYemekTarifi(" . $row['tarifid'] . ")'style='background-color: lightgreen;'>düzenle</button></td>";
        echo "<td><button class='silyemektarifi' onclick='silYemekTarifi(" . $row['tarifid'] . ")'style='background-color: lightblue;'>sil</button></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Kayıtlı yemek tarifi bulunamadı.";
}

 
$conn->close();
?>

<script>
    function duzenleYemekTarifi(tarifId) {
        window.location.href = 'duzenle_yemek.php?id=' + tarifId;
    }

    function silYemekTarifi(tarifId) {
        if (confirm('Yemek tarifini silmek istediğinizden emin misiniz?')) {
            window.location.href = 'sil_yemek.php?id=' + tarifId;
        }
    }
</script>
