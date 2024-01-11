<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lezzetdünyası-giriş</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="styles/login.css">
    
</head>
<body>

    
    <section class="üyelik_sayfası">
        
        <div class="cerceve" id="cerceve-js">
            <a href="index.html" class="logo"> 
                <img src="../image/channels4_profile" alt="">
            </a>
            <div class="butonlar">
                <button class="üyegirişi">Üye Girişi</button>
                <span class="button-separator"></span>
                <button class="üyeol" onclick="window.location.href='üyeol.php'">Üye Ol</button>
            </div>
            <form method="POST" action="kayit.php">
            <div class="textbox-container" id="formContainer">
                <div class="textbox">
                    <div class="userlogo"><i class="fa-solid fa-user fa-lg" style="margin-bottom: 2rem;"></i></div>
                    <input type="text" name="kullaniciadigiris" id="kullaniciadigiris" placeholder="Kullanıcı Adı">
                </div>
                <div class="textbox">
                    <div class="locklogo"><i class="fa-solid fa-lock fa-lg" style="margin-bottom: 2rem;"></i></div>
                    <input type="password" name="sifregiris" id="sifregiris" placeholder="Şifre">
                </div>
                <button class="giris-yap">Giriş Yap</button>
            </div>
            </form>
        </div>
       
        
    </section>
    

<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kullaniciAdi = $_POST["kullaniciadigiris"];
    $sifre = $_POST["sifregiris"];

    // Örnek: Veritabanına ekleme
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

    // Veritabanına ekleme işlemleri burada gerçekleştirilebilir
    $sql = "SELECT * FROM uyeler WHERE kullaniciadi = '$kullaniciAdi' AND sifre = '$sifre'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Kullanıcı varsa, oturum verilerini oluştur ve yönlendir
        $row = $result->fetch_assoc();
        $kullaniciID = $row["kullaniciid"];
        
        // Oturum verilerini kaydet
        $_SESSION["kullaniciID"] = $kullaniciID;
        $_SESSION["kadi"] = $kullaniciAdi;

        // Veritabanı bağlantısını kapat
        $conn->close();

        // Kullanıcıyı uye.php sayfasına yönlendir
        header("Location: uye.php");
        exit();
    } else {
        // Kullanıcı yoksa, uygun şekilde işle (örneğin, hata mesajı göster)
        echo '<script>alert("Geçersiz giriş bilgileri");</script>';
    }

    $conn->close();
}
?>
</body>
</html>