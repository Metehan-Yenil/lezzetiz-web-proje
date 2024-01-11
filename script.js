document.addEventListener('DOMContentLoaded', function () {
    const üyeGirisiButton = document.querySelector('.üyegirişi');
    const üyeOlButton = document.querySelector('.üyeol');
    const formContainer = document.getElementById('formContainer');
    const formCerceve = document.getElementById('cerceve-js');
    const girisyapbutton =document.querySelector('.giris-yap');

    girisyapbutton.addEventListener('click', function(){
         // Kullanıcı bilgilerini al
         const kullaniciAdiGiris = document.getElementById('kullaniciadigiris').value;
         const sifreGiris = document.getElementById('sifregiris').value;
 
         // AJAX ile veritabanında kullanıcı kontrolü
         const xhr = new XMLHttpRequest();
         xhr.open('POST', 'kullanici_kontrol.php', true);
         xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
         xhr.onreadystatechange = function () {
             if (xhr.readyState == 4 && xhr.status == 200) {
                 const response = xhr.responseText;
                 alert(response);
                 
             }
         };
 
         // Verileri gönder
         const data = `kullaniciAdiGiris=${kullaniciAdiGiris}&sifreGiris=${sifreGiris}`;
         xhr.send(data);    
    });

    üyeGirisiButton.addEventListener('click', function () {
        window.location.href = "kayit.php";
        location.reload(true);
    });

    üyeOlButton.addEventListener('click', function () {
        formContainer.innerHTML = '';

        const yeniForm = document.createElement('form');
        yeniForm.innerHTML = `
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

            <button type="submit">Kayıt Ol</button>
        </div> 
        `;

        formContainer.appendChild(yeniForm);
        formCerceve.style.height = '47rem';

        yeniForm.addEventListener('submit', function (event) {
            event.preventDefault(); // Formun normal submit işlemini engelle

            // Kullanıcı bilgilerini al ve küçük harfe çevir
            const kullaniciAdi = document.getElementById('kullaniciAdi').value.toLowerCase();
            const sifre = document.getElementById('sifre').value;
            const eMail = document.getElementById('Email').value;
            const Ad= document.getElementById('Adi').value;
            const Soyad=document.getElementById('soyAdi').value;

            // AJAX ile veritabanında kullanıcı adının kontrolü
            const xhrCheck = new XMLHttpRequest();
            xhrCheck.open('POST', 'kullanici_kontrol.php', true);
            xhrCheck.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhrCheck.onreadystatechange = function () {
                if (xhrCheck.readyState == 4 && xhrCheck.status == 200) {
                    const response = (xhrCheck.responseText.trim() !== "") ? JSON.parse(xhrCheck.responseText) : null;
                    if (response.exists) {
                        alert('Bu kullanıcı adı zaten kullanılmaktadır. Başka bir kullanıcı adı seçiniz.');
                    } else {
                        // Kullanıcı adı kontrolünden geçtikten sonra AJAX ile veritabanına kayıt işlemi
                        const xhr = new XMLHttpRequest();
                        xhr.open('POST', 'kayit.php', true);
                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                        xhr.onreadystatechange = function () {
                            if (xhr.readyState == 4) {
                                if (xhr.status == 200) {
                                    // Başarı durumu
                                    alert('Kayıt başarılı bir şekilde oluşturuldu');
                                } else {
                                    // Hata durumu
                                    alert('Kayıt oluşturulurken bir hata oluştu');
                                }
                            }
                        };

                        // Verileri gönder
                        const data = `kullaniciAdi=${kullaniciAdi}&sifre=${sifre}&eMail=${eMail}&Adi=${Ad}&Soyadi=${Soyad}`;
                        xhr.send(data);
                    }
                }
            };

            // Verileri gönder
            const dataCheck = `kullaniciAdi=${kullaniciAdi}`;
            xhrCheck.send(dataCheck);
        });
    });
});
