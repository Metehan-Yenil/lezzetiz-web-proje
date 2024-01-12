<?php
 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lezzetdb";

 
$baglanti = new mysqli($servername, $username, $password, $dbname);

 
if ($baglanti->connect_error) {
    die("Bağlantı hatası: " . $baglanti->connect_error);
}

 
$aramaKelimesi = $_POST['aramaKelimesi'];

 
$sorgu = "SELECT * FROM yemektarifleri WHERE tarif_basligi LIKE '%$aramaKelimesi%'";

 
$sonuc = mysqli_query($baglanti, $sorgu);

if ($sonuc) {
    // Veritabanından gelen verileri döndür
    $tarifler = mysqli_fetch_all($sonuc, MYSQLI_ASSOC);
    echo json_encode($tarifler);
} else {
    echo json_encode(array('hata' => 'Sorgu hatası: ' . mysqli_error($baglanti)));
}

 
$baglanti->close();
?>
