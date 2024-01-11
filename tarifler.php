<?php
// tarifler.php

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
$sql = "SELECT tarifler.*, uyeler.kullaniciadi 
        FROM yemektarifleri as tarifler
        JOIN uyeler ON tarifler.kullaniciid = uyeler.kullaniciid";

$result = $conn->query($sql);

// Veritabanından gelen tüm tarifleri listeleyin
if ($result->num_rows > 0) {
    //echo "<div class='tarif-listesi'>";
    while ($row = $result->fetch_assoc()) {
       // echo "<div class='tarif-baslik' onclick='detayGoster(" . $row['tarifid'] . ")'>" . $row['tarif_basligi'] . " - Yazar: " . $row["kullaniciadi"] . "</div>";
    }
    //echo "</div>";
} else {
   // echo "Hiç tarif bulunamadı.";
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
        <a href="#"  onclick="window.location.href='index.html'">Anasayfa</a>
        <a href="#" class="active" onclick="window.location.href='tarifler.php'" >Tüm tarifler</a>
        <a href="#" onclick="window.location.href='tarifler.php'">Popüler tarifler</a>
        <a href="#">Blog</a>
        <a href="#"  onclick="window.location.href='uye.php'">Profilim</a>
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
        <div class="container">
            <div class="tarif-listesi">
                <?php
                // Yukarıda veritabanına bağlantı işlemleri yapılır

                // Tarifleri sorgula
                $sql = "SELECT tarifid, tarif_basligi FROM yemektarifleri";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='tarif-baslik' onclick='detayGoster(" . $row['tarifid'] . ")'>" . $row['tarif_basligi'] . "</div>";
                    }
                } else {
                    echo "Hiç tarif bulunamadı.";
                }
                ?>
            </div>

            <div id="tarif-detaylari">
                
                <!-- Burada tarif detayları gösterilecek -->
            </div>
        </div>
    </section>
    
    <!-- home end-->
    
    
</section>
<script>
    function detayGoster(tarifId) {
    // Tarif detaylarını AJAX ile getir ve #tarif-detaylari içine yerleştir
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "get_tarif_detay.php?tarifid=" + tarifId, true);
    xhr.onload = function () {
        if (xhr.status == 200) {
            var detaylar = xhr.responseText.split("\n"); // Satırlara ayır

            // İçeriği düz bir şekilde göster
            var listeHTML = "<div>";
            for (var i = 0; i < detaylar.length; i++) {
                listeHTML += detaylar[i];
            }
            listeHTML += "</div>";
            listeHTML +="<button style='background-color: #dc3545;' onclick='location.reload();'>kapat</button>"

            // #tarif-detaylari içine içeriği ekle
            document.getElementById("tarif-detaylari").innerHTML = listeHTML;
        } else {
            console.error("Hata oluştu.");
        }
    };
    xhr.send();
}

</script>

</body>
</html>