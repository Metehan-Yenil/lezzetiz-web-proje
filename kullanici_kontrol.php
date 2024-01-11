<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kullaniciAdiGiris = $_POST["kullaniciAdiGiris"];
    $sifreGiris = $_POST["sifreGiris"];

    // Veritabanında kullanıcı kontrolü
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "lezzetdb";

    // Bağlantı oluştur
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Bağlantıyı kontrol et
    if ($conn->connect_error) {
        die("Bağlantı hatası: " . $conn->connect_error);
    }

    // Kullanıcı kontrolü
    $sql = "SELECT * FROM uyeler WHERE kullaniciadi = '$kullaniciAdiGiris' AND sifre = '$sifreGiris'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "Giriş başarılı";
        
    } else {
        echo "Kullanıcı adı veya şifre hatalı";
    }

    $conn->close();
}
?>



</script>
