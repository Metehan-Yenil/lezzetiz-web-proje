<?php
session_start();

if (isset($_POST['editorContent'])) {
    
    $editorContentFromAdmin = $_POST['editorContent'];
    $_SESSION['editorContentFromAdmin'] = $editorContentFromAdmin;
    echo "success"; 
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Lezzetdünyası</title>
    <link rel="stylesheet" href="styles/blog.css">
    
    <style>
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
        }

        .social-icons {
            margin-top: 10px;
        }

        .social-icons a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
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
                <a href="#"  onclick="window.location.href='index.html'">Anasayfa</a>
                <a href="#" onclick="window.location.href='tarifler.php'" >Tüm tarifler</a>
                <a href="#" onclick="window.location.href='tarifler.php'">Popüler tarifler</a>
                <a href="#" class="active" onclick="window.location.href='blog.php'">Blog</a>
                <a href="#" onclick="window.location.href='yenitarif.php'">Tarif ekleyin</a>
                <a href="#">İletişim</a>
            </nav>
            <div class="buttons">
                <button class="büyütec">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
                <button onclick="GirişSayfasınaGötür()">
                    <i class="fa-regular fa-user"></i>
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
            <div class="anasayfa_cerceve">
                <h2>Lezzetli Haberler</h2>

                <div id="editor">
                <?php
                    
                    $editorContent = isset($_SESSION['editorContentFromAdmin']) ? $_SESSION['editorContentFromAdmin'] : '';
                    echo $editorContent;
                ?>
                </div>
            </div>
        </section>
        <!-- home end-->
    </section>

    <footer>
        <div class="social-icons">
            <a href="https://www.facebook.com/" target="_blank">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://twitter.com/_metehan_ynl_" target="_blank">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="https://www.instagram.com/_mete_ynl_/" target="_blank">
                <i class="fab fa-instagram"></i>
            </a>
            
        </div>
    </footer>

   
</body>
</html>



