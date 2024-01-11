<?php
// profil.php

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
$sql = "SELECT kullaniciadi, email, ad, soyad FROM uyeler WHERE kullaniciid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $kullaniciID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $kullaniciadi = $row['kullaniciadi'];
    $email = $row['email'];
    $ad = $row['ad'];
    $soyad = $row['soyad'];
} else {
    $kullaniciadi = "Kullanıcı Adı Bulunamadı";
    $email = "";
    $ad = "";
    $soyad = "";
}

$stmt->close();
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Lezzetdünyası-Üye</title>
    <link rel="stylesheet" href="styles/profil.css">
    <style>
        p {
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
        }
    </style>
                            
                                            
</head>
<body>
<section>

    <!-- header start-->
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
            <a href="#" onclick="window.location.href='index.html'">Anasayfa</a>
            <a href="#" onclick="window.location.href='tarifler.php'" >Tüm tarifler</a>
            <a href="#" onclick="window.location.href='tarifler.php'">Popüler tarifler</a>
            <a href="#">Blog</a>
            <a href="#" onclick="window.location.href='yenitarif.php'">Tarif ekleyin</a>
            <a href="#">İletişim</a>
        </nav>
        <div class="buttons">
            <button class="büyütec">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
            <button  onclick="GirişSayfasınaGötür()" >
                <i class="fa-regular fa-user"> </i>
                <p id="kullaniciAdi"></p>
            </button>
        </div>
                            <script>
                                function showNotification(status, message) {
                                    alert(message);
                                }
                                function degisiklikleriKaydet() {
                                    // Formun verilerini al
                                    var form = document.getElementById("profilForm");

                                    // FormData'nın doğru bir şekilde oluşturulduğunu kontrol et
                                    if (form instanceof HTMLFormElement) {
                                        var formData = new FormData(form);

                                        // AJAX ile update.php dosyasına verileri gönder
                                        var xhr = new XMLHttpRequest();
                                        xhr.open("POST", "update.php", true);
                                        xhr.onload = function () {
                                            // Başarıyla güncellendi ise sayfayı yeniden yükle
                                            if (xhr.status == 200) {
                                                location.reload();
                                                showNotification("success", "Başarıyla güncellendi!");
                                            } else {
                                                // Hata durumunda kullanıcıya mesaj verebilirsiniz
                                                alert("Bir hata oluştu.");
                                            }
                                        };
                                        xhr.send(formData);
                                    } else {
                                        // Form elementi bulunamadıysa hata mesajı göster
                                        console.error("Form elementi bulunamadı.");
                                    }
                                    
                                }
                                
                            </script>          

    </header>
    <!-- header end-->

    <!-- home start-->
    <section class="home">
        <div class="anasayfa_cerceve">
            <div class="cerceve_icerik">
                <div class="arama_kısmı">
                    
                    <div class="fast_tip">
                        <div class="profil_bilgileri">
                            <h2>Profil Bilgileri</h2>
                            <form id="profilForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <label for="yeniKullaniciAdi">Kullanıcı Adı:</label>
                                <input type="text" id="yeniKullaniciAdi" name="yeniKullaniciAdi" value="<?php echo $kullaniciadi; ?>">

                                <label for="yeniEmail">Email:</label>
                                <input type="email" id="yeniEmail" name="yeniEmail" value="<?php echo $email; ?>">

                                <label for="yeniAd">Ad:</label>
                                <input type="text" id="yeniAd" name="yeniAd" value="<?php echo $ad; ?>">

                                <label for="yeniSoyad">Soyad:</label>
                                <input type="text" id="yeniSoyad" name="yeniSoyad" value="<?php echo $soyad; ?>">

                                <button type="button" onclick="degisiklikleriKaydet()">Kaydet</button>
                            </form>
                                                                  
                        </div>
                        <button type="button" class="cikisyap" onclick="window.location.href='logout.php'">Çıkış yap</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- home end-->
    
</section>
</body>
</html>
