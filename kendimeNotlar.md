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

- routes/
    . web.php içerisinde / dizindeyken hnagi modülün return edileceği belirlenir. 
    . view('welcome') fonksyionu view'lar içerisinde adı welcome olanı return eder ve ana sayfa yüklenir.
    . return edilen fonksyion yerine başka bir view yüklenebilir.
    . Aşağıdaki kod bloğunda görüldüğü gibi url içerisinde /hello size sadece HelloWorld yazısını geri döndürür.
        Route::get('/hello', function () {
            return 'HelloWorld';
        });
    . Route::post, Route::delete... gibi metodlar da kullanılaiblir.
    . Dinamik bir şekilde sayfa getirilecekse 
        Route::get('/users/{id}', function($id) {      //Önemli olan kısım  $ işaretinin yeri.
            return 'Bu istenilen id '.$id;
        });
        Route::get('/users/{id}/{name}', function($id,$name) {      //Önemli olan kısım  $ işaretinin yeri.
            return 'Bu istenilen id '.$id.' '.$name;
        });

- resources/views
    . pages adlı bir klasör oluşturup içerisine sayfalarımızı olutşturalım.
    . about.blade.php içerisine gösterilmesi istenilen bilgileri yazıp route içerisine ekleyelim
    . pages dizini içerisinde tanımlanan about.blade.php dosyası, routes içerisinden yeni bir fonksiyon yazılarak şu şekilde çağırılabilir,
        Route::get('/hello', function () {
            return view('pages.about');             //pages içerisindeki about çağırılır, pages/about olarak da kullanılaiblir.
        });
    
    . Direk olarak view'ı return etmek yerine bir controller oluştururuz,
        - php artisan make:controller PagesController
        - bu komut çalıştırıldığında app/Http/Contollers içerisinde dosya oluşturulmaktadır.
        - Burada uzantılara göer geri döndürülecek sayfaları ayarlayacağız ve bu fonksiyon aracılığıyla viewları döndüreceğiz.
            . Bu dosya içerisindeki fonksiyonları dosyadan kontrol edip açıklamalarına bakabilirsin.
            . Home page oluşturulur.
        - Her bir sayfa oluşturulduğunda PagesController içerisine eklenmeli. About, Index, Gallery etc.
        - PagesController içerisinde eklenen her bir page için doğru yönlenebilmesi için ise routes/web.php güncellenmeli.

- .env
    . Buradan app ismini değiştiriyoruz ve index içerisindeki işlerimize devam ediyoruz.

[Part3]

- Sürekli tekrar eden HTML bölümlerinden kaçınmak için burada layout dizini oluşturulacaktır.
    . resources/pages/layout
        Burada app.blade.php oluşturularak tekrarlayan HTML bölümünü buraya ekliyoruz.
    - app.blade.php içerisinde layout oluşturularak, sabit html bölümünün içerisine dinamik değişken bir içerik eklenmesi bu şekilde mümkün olabilmektedir.

- PagesController içerisinde tanımladığımız fonksiyonlardan sayfalara veri veya parametre göndermek için, PagesController.php içerisine bakın. Her iki yöntemde gösterilmektedir.

- Assets kullanımına laravel izin vermektedir., laravel içerisinde gömülü olarak gelen bootstrap kullanılabilir.
- Laravel içerisinde CSS framework olarak SASS kullanmaktadır. /resources/sass içerisinde görülebilir. SASS ile asıl CSS dosyası değiştirilebilir, eklemeler yapılabilir. Proje içerisine çağırmak için is asset('css/app.css') fonksyionu kullanılmaktadır. /public/css/app.css içerisinde yer almaktadır.
- Ana dizin içerisinde package.json içerisine baktığımız zaman bootstrap içerisinde olduğunu görebiliyoruz, aynı zamanda vue.js ve sass'ın kullanabilmesi için sass frameworkü de beraberinde gelmektedir. Bu sayede assets olarak eklenebilir. Bunun yapılabilmesi için proje içerisinde npm yüklemek gerekiyor (sanırım). Npm yüklendikten sonra proje içerisinde npm install komutunu girdikten sonra package.json içerisindeki gerekli olan nodeları npm projeniz içerisine aktarmaktadır.
- Tüm node'lar eklendiğinde proje dizininiz içerisine node_modules eklenmektedir.
- Arayüzde bir değişiklik yapmak istediğimiz zaman bunu, public içerisindeki css üzerinden değil yukaruda da belirttiğimiz sass içerisinden yapmak gerekmektedir. Yaptığınız değişikliklerin uygulanabilmesi, yani bir nevi derlenebilmesi için `npm run dev` komutunu çalıştırmamız gerekmektedir. NPM tüm dosyaları tarayarak değişiklikleri işler ve bir nevi derleyerek değişiklikleri çalıştırılabilir ve gösterilebilir hale getirir (yanlış anladıysam lütfen düzeltin).
    . /resources/sass/_variables.scss
        $body-bg: #f8fafc; //değiştirilip `npm run dev` komutunu koşalım
- Sürekli olarak her seferinde aynı komutu koşmak de her değişiklik yaptığımızda bunu görmek için uğraşmak yerine `npm run watch` kullanulabilir. Sürekli olarak değişiklikleri izleyerek uygulanabilir olan değişiklikleri görülebilir hale getirlir.
- Eğer kendi yaptığınız bir css dosyasını eklemek için yine /resources/sass içerisinde _cssDosyasi.scss oluşturulabilir. Örnek olarak _custom.scss oluşturalım.
    . /resources/sass/_custom.scss
        Bu eklendikten sonra app.scss içerisine import etmemiz gerekmektedir. Bu sayede değişiklikler uygulanabilsin.

- Bu bölümde aslında bir Navigation Bar yapmak için neleri değiştirip düzenlememiz gerekiyor ona bir bakalım.
    . app.blade.php
        Container Div
    . services.blade.php
        ul class="list-group"
        li class="list-group-item"
    . NavBar include edileceği için yani her sayfada çağırılacağı için views içerisine bir dizin oluşturalım. navbar.blade.php oluşturulduğunda her çağırıldığına aslında sayfa içerisine Navigation Bar eklenmektedir. Eklemek için ise app.blade.php içerisine gidip
        . @include('inc.navbar'); yazmak yeterli oluyor.
    . Bootstrap sitesinden navbarı çekip ekledik. Bu sayede navbar layout içerisinde include edilerek tüm sayfalarda gösterilebiliyor.
    . Değişiklikleri izlemek için app.blade.php içerisine bakabilirsiniz.
    . Aynı zamanda index.blade.php içerisine jumbotron eklendi

[Part4]

        

