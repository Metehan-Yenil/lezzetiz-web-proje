<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Lezzetdünyası-tarifiniekle</title>
    <link rel="stylesheet" href="styles/upload.css">
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
            <a href="#" class="active">Anasayfa</a>
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
                <p id="kullaniciAdi"></p>
            </button>
        </div>

        
    </header>
    <!-- header end-->

    <!-- home start-->
    <section class="home">
        <div class="anasayfa_cerceve">
            <div class="cerceve_icerik">
                <div class="arama_kısmı">
                    <h1>Tarif Bilgisi</h1>
                    <div class="fast_tip">
                        
                    <form action="upload.php" method="post" enctype="multipart/form-data" id="uploadForm">
                        <label for="file">Fotoğraf Seç:</label>
                        <input type="file" name="file" id="file">
                        <input type="hidden" name="kullaniciID" value="<?php echo $kullaniciAdi; ?>">
                        <input type="submit" class="yükle" value="Yükle" name="submit">
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    

    <!-- home end-->
    
    
</section>


</body>
</html>
