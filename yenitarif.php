<?php
session_start();


if (isset($_SESSION['kullaniciID'])) {
    // Kullanıcı giriş yapmışsa işlemleri gerçekleştir
    $kullaniciid = $_SESSION['kullaniciID'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Form verilerini işle
        $tarifBaslik = $_POST['textbox1'];
        $girisYazisi = $_POST['textarea'];
        $kisiSayisi = $_POST['textbox4'];
        $hazirlamaSuresi = $_POST['textbox5'];
        $pisermeSuresi = $_POST['textbox6'];
        $malzemeler = $_POST['textarea1'];
        $nasilYapilir = $_POST['textarea2'];

        // Veritabanına ekleme işlemleri burada gerçekleştirilebilir
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

        // Veritabanına ekleme işlemi
        $sql = "INSERT INTO yemektarifleri (tarif_basligi, tarif_aciklamasi, hazirlanma_suresi, kac_kisilik, pisirme_suresi, kullaniciid, malzemeler, nasilyapilir) VALUES ('$tarifBaslik', '$girisYazisi', '$hazirlamaSuresi', '$kisiSayisi', '$pisermeSuresi', '$kullaniciid', '$malzemeler', '$nasilYapilir')";

        $response = array(); // JSON yanıtı için dizi oluştur

        if ($conn->query($sql) === TRUE) {
            // Başarılı bir şekilde eklendi
            $response['status'] = 'success';
        } else {
            // Hata durumunda
            $response['status'] = 'error';
            $response['message'] = $conn->error;
        }

        // Bağlantıyı kapat
        $conn->close();

        // JSON yanıtını ekrana yazdır
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
} else {
    // Kullanıcı giriş yapmamışsa istenilen işlemleri yapabilirsiniz.
    // Örneğin, hata mesajı döndürebilir veya giriş sayfasına yönlendirebilirsiniz.
    $response = array(
        'status' => 'error',
        'message' => 'Kullanıcı girişi yapılmalıdır.'
    );

    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Lezzetdünyası-Üye</title>
    <link rel="stylesheet" href="styles/yenitarif.css">
    <style>
        p {
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
        }
    
        th{
            background-color: #dc3545;
            color: white;
            border: 1px solid #ccc;

        }
        tr{
            border-radius: 3rem;
        }
         /* Yeni Eklenen Stiller */
         #bilgiMesaji {
            display: none;
            padding: 20px;
            background-color: #28a745;
            color: white;
            text-align: center;
            font-size: 18px;
            border-radius: 10px;
            margin-top: 20px;
            margin-left: 20px;
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

            <a href="#" onclick="window.location.href='index.html'" >Anasayfa</a>
            <a href="#" onclick="window.location.href='tarifler.php'" >Tüm tarifler</a>
            <a href="#" onclick="window.location.href='tarifler.php'">Popüler tarifler</a>
            <a href="#">Blog</a>
            <a href="#" class="active" >Tarif ekleyin</a>
            <a href="#">İletişim</a>
            <a href="#" onclick="window.location.href='uye.php'">Profilim</a>
        </nav>
        <div class="buttons">
            <button class="büyütec">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
            <button>
                <i class="fa-regular fa-user"> </i>
                <p id="kullaniciAdi"></p>
            </button>
        </div>

        <script>
    // URL'den parametreleri almak için bir yardımcı fonksiyon
    function getParameterByName(name, url) {
        if (!url) url = window.location.href;
        name = name.replace(/[\[\]]/g, "\\$&");
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    }

    // Kullanıcı ID'yi al
    var kullaniciID = getParameterByName('kullaniciID');

    
    </script>

        
    </header>
    <!-- header end-->

    <!-- home start-->
    <section class="home">
        <div class="anasayfa_cerceve">
            <div class="cerceve_icerik">
                <div class="arama_kısmı">
                    <h1>Tarif Bilgisi</h1>
                    <div class="fast_tip">
                        <form action="" method="post" enctype="multipart/form-data" id="tarifForm">
                            <table>
                                <tr>
                                    <th>Tarif Başlığı *</th>
                                </tr>
                                <tr>
                                    <td><input type="text" name="textbox1" style=""></td>
                                </tr>
                                <tr>
                                    <th>Giriş Yazısı *</th>
                                </tr>
                                <tr>
                                    <td><textarea name="textarea" rows="4" cols="50"></textarea></td>
                                </tr>
                                <tr>
                                    <th>Kişi Sayısı *</th>
                                    <th>Hazırlama Süresi *</th>
                                    <th>Pişirme Süresi *</th>
                                </tr>
                                <tr>
                                    <td><input type="number" name="textbox4" placeholder="kaç kişi?"></td>
                                    <td><input type="number" name="textbox5" placeholder="kaç dk?"></td>
                                    <td><input type="number" name="textbox6" placeholder="kaç dk?"></td>
                                </tr>
                                <tr>
                                    <th>Malzemeler</th>
                                </tr>
                                <tr>
                                    <td><textarea name="textarea1" rows="4" cols="50"></textarea></td>
                                </tr>
                                <tr>
                                    <th>Nasıl Yapılır?</th>
                                </tr>
                                <tr>
                                    <td><textarea name="textarea2" rows="4" cols="50"></textarea></td>
                                </tr>
                            </table>
                            <input type="hidden" name="kullaniciID" id="kullaniciID">
                            <button type="button" class="devametbutton" onclick="formuGonder()">Devam et</button>

                        </form>
                        <div id="bilgiMesaji"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Form verilerini işle
    $tarifBaslik = $_POST['textbox1'];
    $girisYazisi = $_POST['textarea'];
    $kisiSayisi = $_POST['textbox4'];
    $hazirlamaSuresi = $_POST['textbox5'];
    $pisermeSuresi = $_POST['textbox6'];
    $kullaniciid = $_POST['kullaniciID']; // Kullanıcı ID'sini al
    $malzemeler = $_POST['textarea1'];
    $nasilYapilir = $_POST['textarea2'];

    // Veritabanına ekleme işlemleri burada gerçekleştirilebilir
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

    // Veritabanına ekleme işlemi
    $sql = "INSERT INTO yemektarifleri (tarif_basligi, tarif_aciklamasi, hazirlanma_suresi, kac_kisilik, pisirme_suresi, kullaniciid,malzemeler, nasilyapilir) VALUES ('$tarifBaslik', '$girisYazisi', '$hazirlamaSuresi', '$kisiSayisi', '$pisermeSuresi', '$kullaniciid', '$malzemeler', '$nasilYapilir')";

    $response = array(); // JSON yanıtı için dizi oluştur

    if ($conn->query($sql) === TRUE) {
        // Başarılı bir şekilde eklendi
        $response['status'] = 'success';
    } else {
        // Hata durumunda
        $response['status'] = 'error';
        $response['message'] = $conn->error;
    }

    // Bağlantıyı kapat
    $conn->close();

    // JSON yanıtını ekrana yazdır
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
?>

<script>
    function formuGonder() {
        var formData = new FormData(document.getElementById('tarifForm'));
        var kullaniciID = getParameterByName('kullaniciID');
        document.querySelector('#kullaniciID').value = kullaniciID;

        fetch('yenitarif.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            try {
                // JSON formatına çevirme denemesi yap
                var jsonData = JSON.parse(data);

                console.log('Server Response:', jsonData);

                if (jsonData.status === 'success') {
                    // Başarı mesajını göster
                    var bilgiMesaji = document.getElementById('bilgiMesaji');
                    bilgiMesaji.innerHTML = 'Tarif başarıyla eklendi.';
                    bilgiMesaji.style.backgroundColor = '#28a745';
                    bilgiMesaji.style.display = 'block';

                    // Ekleme işlemi başarılı olduğunda başka bir sayfaya yönlendirilebilirsiniz
                    window.location.href = 'uye.php';
                } else {
                    // Hata mesajını göster
                    var bilgiMesaji = document.getElementById('bilgiMesaji');
                    bilgiMesaji.innerHTML = 'Hata: ' + jsonData.message;
                    bilgiMesaji.style.backgroundColor = '#dc3545';
                    bilgiMesaji.style.display = 'block';
                }
            } catch (e) {
                console.error('Hata:', e);
                var bilgiMesaji = document.getElementById('bilgiMesaji');
                    bilgiMesaji.innerHTML = 'Tarif başarıyla eklendi.';
                    bilgiMesaji.style.backgroundColor = '#28a745';
                    bilgiMesaji.style.display = 'block';
            }
        })
    }
</script>

    <!-- home end-->
    
</section>
</body>
</html>
