<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kullaniciAdiGiris = $_POST["kullaniciAdiGiris"];
    $sifreGiris = $_POST["sifreGiris"];

     
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "lezzetdb";

     
    $conn = new mysqli($servername, $username, $password, $dbname);

     
    if ($conn->connect_error) {
        die("Bağlantı hatası: " . $conn->connect_error);
    }

     
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
