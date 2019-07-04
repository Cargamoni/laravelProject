# Uygulamalar

[Part1]
- public dizini frontend bölümü
    . /opt/lampp/etc/extra/httpd-vhosts.conf içerisine alttaki satırlar ekleniyor.
        <VirtualHost *:80>
            DocumentRoot "/opt/lampp/htdocs/laravelProject/public"
            ServerName laravelProject.dev
        </VirtualHost>

        <VirtualHost *:80>
            DocumentRoot "/opt/lampp/htdocs"
            ServerName localXampHost
        </VirtualHost>

    . /etc/hosts içerisine ekledik
        127.0.0.1       localXampHost
        127.0.0.1       laravelProject.dev

    . 

- app/User.php
    . Burası bir model, istenirse bu dosya models diye bir dizin oluşturulup buraya da aktarılabilir.

- app/Http/Controllers/
    . Controller.php, BaseCntroller classını içerisine barındırır, tüm fonksiyonları içerisinde barındırır.
    . Laravel aynı zamanda Auth dizinini oluşturur. Burada kullanıcı kayıt, giriş, parola resetleme ve unutulan parola için işlemleri yaptırılabilir.
    . İsteğe bağlı olarak da kontroller oluşturulabilir buraya veya oluşturulacak modeller içerisine aktarılabilir.

- resources/views
    . welcome.blade.php kullanılabilecek view'lardan biridir.

- routes/
    . Eğer bir api oluşturmak istersek bu bölümden eklenebilir.
    . Ana routes dosyamız bu dizin altındaki web.php dosyası olacaktır.

- app/providers
    . Burada provider oluşturulabilir, servisler oluşturulabilir.

- config/
    . Laravel için uygulamadaki ayar dosyalarının tutulduğu yer.
    . database.php içerisinden veri tabanı bağlantısının bilgileri girilmektedir.

[Part2]
