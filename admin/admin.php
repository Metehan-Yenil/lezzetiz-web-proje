<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="styles/admin.css">
    <title>Admin paneli</title>
    <style>
    form {
        display: flex;
        flex-direction: column;
        max-width: 300px; 
        margin: auto;
    }

    label {
        margin-bottom: 5px;
    }

    input {
        margin-bottom: 10px;
        padding: 8px;
        box-sizing: border-box;
    }

    button {
        padding: 10px;
        cursor: pointer;
    }
</style>

    <h1 class="adminh1">ADMIN Panel</h1>
</head>

<body>

<header class="header">
    
    <a href="#" class="logo"> 
        <img src="image/channels4_profile.jpg" alt="">
    </a>
    
    <nav class="navbar">
        <a href="#" class="active" onclick="window.location.href='../uye.php'">Profil</a>

        <a href="#"  onclick="window.location.href='../blogadmin.php'">Blog</a>
        
    </nav>
    
    <button  onclick="GirişSayfasınaGötür()" >
            <i class="fa-regular fa-user" onclick="window.location.href='../kayit.php'">  Log Out </i>
            
        </button>
</header>



    <div class="ekleme_formu">

    
        <h2>Kullanıcı Ekleme Formu</h2>

        <form action="ekle.php" method="post">
            <label for="kullaniciadi">Kullanıcı Adı:</label>
            <input type="text" id="kullaniciadi" name="kullaniciadi" required><br>

            <label for="email">E-Posta:</label>
            <input type="email" id="email" name="email" required><br>

            <label for="ad">Ad:</label>
            <input type="text" id="ad" name="ad" required><br>

            <label for="soyad">Soyad:</label>
            <input type="text" id="soyad" name="soyad" required><br>

            <button type="submit" style="background-color: lightgreen;">Ekle</button>
        </form>

    </div>
                <div class="mevcutkullanicilar">
                        <h2>Mevcut Kullanıcılar</h2>
                        <?php include('listele.php'); ?>
                </div>

                <div class="mevcuttarifler">
                    <h2>Mevcut tarifler</h2>
                    <?php include('listeleyemek.php');?>

                </div>
    
    
</body>
</html>


