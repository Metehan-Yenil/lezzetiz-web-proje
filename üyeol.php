<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lezzetdünyası-giriş</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="styles/üyeol.css">
   
</head>
<body>

    
    <section class="üyelik_sayfası">
        <form method="POST" action="üyeol.php">
        <div class="cerceve" id="cerceve-js">
            <a href="index.html" class="logo"> 
                <img src="../image/channels4_profile" alt="">
            </a>
            <div class="butonlar">
                <button class="üyegirişi" onclick="window.location.href='kayit.php'">Üye Girişi</button>
                <span class="button-separator"></span>
                <button class="üyeol">Üye Ol</button>
            </div>
            <div class=js1-container>

            <div class="js1">
                <div class="userlogojs"><i class="fa-solid fa-user fa-lg" style="margin-bottom: 2rem;"></i></div>
                <input type="text" id="kullaniciAdi" name="kullaniciAdi" class="kullaniciAdiInput" placeholder="kullanıcı adı" required>
            </div>
                
            <div class="js1">    
                <div class="lockjs"><i class="fa-solid fa-lock fa-lg" style="margin-bottom: 2rem;"></i></div>
                <input type="password" id="sifre" name="sifre" class="sifreInput" placeholder="Şifreniz" required>
            </div>

            <div class="js1">    
                <div class="mailjs"><i class="fa-solid fa-envelope fa-lg" style="margin-bottom: 2rem;"></i></div>
                <input type="email" id="Email" name="eMail" class="emailInput" placeholder="e-posta giriniz" required>
            </div>  
            
            <div class="js1">
                <div class="adıjs"><i class="fa-solid fa-signature fa-lg" style="margin-bottom: 2rem;"></i></div>
                <input type="text" id="Adi" name="adi" class="Adiinput" placeholder="Adınızı giriniz" required>
            </div>

            <div class="js1">
                <div class="soyadijs"><i class="fa-solid fa-diamond fa-lg" style="margin-bottom: 2rem;"></i></div>
                <input type="text" id="soyAdi" name="soyadi" class="soyAdiinput" placeholder="Soyadınızı giriniz" required>

                
            </div> 
            <button class="submitbutton" type="submit">Kayıt Ol</button>
        </div>
        </form>
        
    </section>
    

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kullaniciAdi = $_POST["kullaniciAdi"];
    $sifre = $_POST["sifre"];
    $eMail = $_POST["eMail"];
    $Ad = $_POST["adi"];
    $Soyad= $_POST["soyadi"];

    // Veritabanına ekleme işlemleri burada gerçekleştirilebilir

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
    $sql = "INSERT INTO uyeler (kullaniciadi, sifre, email,Ad,Soyad) VALUES ('$kullaniciAdi', '$sifre', '$eMail','$Ad','$Soyad')";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Kayıt başarıyla oluşturuldu");</script>';

    } else {
        echo "Hata: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
</body>
</html>