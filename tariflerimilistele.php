<?php
session_start();
require_once "uye.php";

if(isset($_SESSION["kadi"])){
    echo $_SESSION["kadi"]."<br>";
    echo '<a href="logout.php">Çıkış</a>';
    

    
    // Veritabanı bağlantısını sağlayın
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "lezzetdb";

    // Bağlantıyı oluşturun
    $baglanti = new mysqli($servername, $username, $password, $dbname);
    
    // SQL sorgusunu hazırla
    $sorgu = "SELECT tarif_basligi, tarif_aciklamasi, hazirlanma_suresi, kac_kisilik, pisirme_suresi, malzemeler, nasilyapilir FROM yemektarifleri WHERE kullaniciid = $kullanici_id"; // Tablo adınıza uygun olarak güncelleyin
    $sonuc = mysqli_query($baglanti, $sorgu);

    if($sonuc){
        echo '
        <table border="1">
        <tr>
            <th>Tarif Başlığı</th>
            <th>Tarif Açıklaması</th>
            <th>Hazırlanma Süresi</th>
            <th>Kaç Kişilik</th>
            <th>Pişirme Süresi</th>
            <th>Malzemeler</th>
            <th>Nasıl Yapılır</th>
        </tr>';

        while($satir = mysqli_fetch_assoc($sonuc)){
            echo "
            <tr>
                <td>".$satir["tarif_basligi"]."</td>
                <td>".$satir["tarif_aciklamasi"]."</td>
                <td>".$satir["hazirlanma_suresi"]."</td>
                <td>".$satir["kac_kisilik"]."</td>
                <td>".$satir["pisirme_suresi"]."</td>
                <td>".$satir["malzemeler"]."</td>
                <td>".$satir["nasilyapilir"]."</td>
            </tr>";
        }

        echo "</table>";
    } else {
        echo "Sorgu hatası: " . mysqli_error($baglanti);
    }
} else {
    header("location:index.html");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Lezzetdünyası</title>
    <link rel="stylesheet" href="styles/tariflerimilistele.css">
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
        <a href="#">Anasayfa</a>
        <a href="#">Tüm tarifler</a>
        <a href="#">Popüler tarifler</a>
        <a href="#">Blog</a>
        <a href="#">Tarif ekleyin</a>
        <a href="#">İletişim</a>
    </nav>
    <div class="buttons">
        <button class="büyütec">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>
        <button  onclick="GirişSayfasınaGötür()" >
            <i class="fa-regular fa-user"> </i>
            
        </button>
    </div>
    <script>
        function GirişSayfasınaGötür() {
          window.location.href = 'kayit.php'; 
        }
      </script>
</header>
    <!-- header end-->

    <!-- home start-->
    <section class="home">
        
        
    </section>
    
    <!-- home end-->
    
    
</section>    
</body>
</html>