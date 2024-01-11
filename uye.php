<?php
// uye.php

// Oturumu başlat
session_start();

// KullanıcıID oturum değişkeninin set edilip edilmediğini kontrol et
if(isset($_SESSION["kullaniciID"])){
    $kullaniciID = $_SESSION["kullaniciID"];
} else {
    // Eğer KullaniciID oturum değişkeni set edilmediyse, kullanıcıyı giriş sayfasına yönlendir veya uygun bir işlem yap
    header("Location: kayit.php");
    exit();
}

// Veritabanı bağlantısını sağlayın
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lezzetdb";

// Bağlantıyı oluşturun
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol edin
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// Güvenli bir sorgu oluşturun
$sql = "SELECT Ad, Soyad FROM uyeler WHERE kullaniciid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $kullaniciID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $adSoyad = $row['Ad'] . ' ' . $row['Soyad'];
} else {
    $adSoyad = "Kullanıcı Bulunamadı";
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Lezzetdünyası-Üye</title>
    <link rel="stylesheet" href="styles/uye.css">
    <style>
        p {
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
        }
    </style>

    <script>
    function GirişSayfasınaGötür() {
        window.location.href = 'kayit.php'; 
    }

    function ProfilGoruntule() {
        window.location.href = 'profil.php';
    }
</script>


</head>

<header class="header">
    <div class="buttons">
        <button>
            <i class="fa-solid fa-list"></i>
        </button>
    </div>
    <a href="#" class="logo"> 
        <img src="image/channels4_profile.jpg" alt="">
    </a>
    <nav class="navbar">
        <a href="#"  onclick="window.location.href='index.html'">Anasayfa</a>
        <a href="#" onclick="window.location.href='tarifler.php'" >Tüm tarifler</a>
        <a href="#" onclick="window.location.href='tarifler.php'">Popüler tarifler</a>
        <a href="#">Blog</a>
        <a href="#" class="active" onclick="window.location.href='#'">Profilim</a>
        <a href="#">İletişim</a>
    </nav>
    <div class="buttons">
        <button class="büyütec">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>
        <button  onclick="GirişSayfasınaGötür()" >
            <i class="fa-regular fa-user"> </i>
            <p><?php echo $adSoyad; ?></p>
        </button>
    </div>
    <script>
        function GirişSayfasınaGötür() {
          window.location.href = 'kayit.php'; 
        }

        ProfilGoruntule(){

        }


      </script>
</header>
<body>
    <!-- ... (Header kısmı buraya gelir) ... -->

    <!-- home start-->
    <section class="home">
        <div class="anasayfa_cerceve">
            <div class="cerceve_icerik">
                <div class="arama_kısmı">
                    <h1>Lezzetli Üyelik</h1>
                    <h2 style="color: #fff;">MERHABA, <?php echo $adSoyad; ?></h2>
                    <div class="fast_tip">
                        <p></p>
                        <button type="button" onclick="ProfilGoruntule()">Profilim</button>
                        <button type="button">Ayarlarım</button>
                        <button type="button" onclick="window.location.href='tariflerimilistele.php'">Tariflerim</button>
                        <button type="button" onclick="window.location.href='yenitarif.php'">Tarif gönder</button>
                        <button type="button" onclick="window.location.href='index.html'">Hesaptan Çıkış yap</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- home end-->
    
</body>
</html>