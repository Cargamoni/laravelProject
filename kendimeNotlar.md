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
- Artisan bir Laravel ile birlikte gelen bir CLI (Command Line Interface)'dir. Php uygulamalarını kolay bir şekilde uyarlamanızı, projenizi yönetmenizi sağlar. Aşağıdaki adresten detaylarını öğrenebiliriz.
    https://laravel.com/docs/5.8/artisan

- Burada veritabanına giriş yapıyoruz. PhpmyAdmin'e giriş yapalım
    . phpmyadmin üzerinden giriş yaptığımızda laravelProject adında bir veritabanı oluşturduk. Şimdilik oluşturduktan sonra yeni bir controller olutşurmak için php artisan'a başvuruyoruz.
        . `php artisan make:controller PostsController`
        Blog postlarını oluşturmayı sağlaycak.
        . `php artisan make:model Post -m`
        Bu sefer artisan ile beraber model oluşturulmaktadır. -m parametresi ile beraber veritabanı tablosu /database/migrations içerisine eklenmektedir.

        Bu iki komutu uyguladıktan sonra /app içerisinde User.php gibi bir model oluşturulmaktadır. Yeni oluşturduğumuz modelin adı Post. Bu modeli kontrol etmek için de PostsController oluşturuldu.

        /database/migrations içerisinde artisan aracılığı ile oluşturulan *_create_posts_table.php içerisine baktığımız zaman, up ve down fonksiyonlarını görmekteyiz, run db dediğimiz zaman 
            Schema::create('posts', function (Blueprint $table) {   //post tablosu oluşturuyor
            $table->bigIncrements('id');                            //primarykey oluşturacak 
            $table->timestamps();                });                //tabloya oluşturulma ve güncelleme zamanı eklenecek.

            Eğer bir sütun eklemek istiyorsak dosya içerisindeki yorum satılarını okuyun.
        
        . Laravel oluştururken kolaylık olması açısından Users tablosunu ve user.php modelini eklemektedir.

    . Migration'ı başlatmadan önce .env içerisindeki veritabanı bilgilerini güncellememiz gerekmektedir.
        . env içerisine girdiğimizde
            DB_DATABASE=laravelProject (Database'i hangi isimle oluşturduysanız o isim)
            DB_USERNAME=cargamoni
            DB_PASSWORD=123456
            yukarıdaki bilgiler sizinkilerle uygun olması gerekmektedir, yoksa bağlantı yapamazsınız. Dilerseniz phpmyadmin üzerinden kendinize bir kullanıcı oluşturabilirsiniz, dilerseniz de root kullanıcını kullanarak bağlantı yapabilirsiniz.
        
        . env içerisindeki bilgiler tamamlandıktan sonra migrate işlemine hazırız demektir.
            . `php artisan make` Bu komut koşulduğunda, php tüm /database/migrations altındaki tabloları veritabanına ekleyecektir.

        NOT: Bu noktada eski versiyonlarda bir hata oluşabiliyormuş, bende olmadı ancak olursa diye aşağıdaki şekilde /app/Providers/AppServiceProvider.php dosyasını düzenleyin
            use Illuminate\Support\Facades\Schema;  //Class üzerinde kütüphaneyi ekleyin

            boot fonksiyonu içerisine ise
            Schema::defaultStringLength(191); //Satırını ekleyin.

            Bu kısım bende yorum satırı içerisinde olacak bilginize.
    
    . Migration' yapıldıktan sonra phpmyadmin içerisinden tabloların eklendiğini görüyoruz.

- Tablolara verileri eklemek için artisan'ın tinker uygulamasına başvuracağız.
    . `php artisan tinker`
        Tinker, controller sınıfı yerine işlemleri test edebileceğimiz bir komut yardımı sağlıyor. Debug işleminde kodları kaydetmeden çalıştırabilmemizi sağlıyor. Aşağıdaki örnekte olduğu gibi veritabanında kayıtlı olan post sayısını, veritabanına post eklememizi sağlamaktadır. Laravel için kuvvetli bir REPL (Read–eval–print loop) çözümü diyebiliriz.

        Aşağıdaki komutlar tinker içerisinde işlem yaparken kullanılmaktadır.
    
    . `App\Post::count()`
        Tabloda kayıtlı olan satır sayısını döndürmektedir.
    
    . `$post = new App\Post();`
        PHP bir nesne yönelimli programlama dilidir. Bu sayede siz bir nesne için RAM üzerinde bir alan ayırıp bununla işlemler yapabilirsiniz ve her `new` önderleyici komutu sayesindede bu işlem farklı bir RAM bölümüne yazılarak işlenir.

        Bu komuttan sonra $post değişkeni içerisinde tablonun tüm elemanları bulunmaktadır. 

    . `$post->title='İlk Post';`
    . `$post->body='Buda gövdek kısmı';`
    . `$post->save();`
        Tablodaki title ve body kısımları değerleri eklendi. save fonksiyonu ile de bu bilgiler veri tabanına eklenmektedir. Fonksyionun geri döndürdüğü true/false değerine göre işlemin başarılı olup olmadığı belirtilir. Bu durumda oluşturulma ve değiştirilme tarihiyle beraber id de veritabanına eklenir.
    
- Index, Create, Store, Edit, Update, Show, Destroy. Tüm bu işlemler PostsController üzerinden gerçekleştirilmesi gerekmektedir. Bütün hepsi bir postun indexini, oluşturulmasını, saklanmasını, düzenlenmesini, güncellenmesini, gösterilmesini ve silinmesini sağlayacaktır. Daha öncesinde oluşutrduğumuz PostsController dosyasını hatırlıyorsunuzdur. Yukarıda her yazdığımız işlem için bir yönlendirme yani route oluşturmamız gerekmekte. Şudanda aktif olan route'ları görmek için `php artisan route:list` komutundan yardım alabiliriz. Bana şu anda aşağıdaki gibi bir sonuç vermekte. 

+--------+----------+----------+------+-----------------------------------------------+--------------+
| Domain | Method   | URI      | Name | Action                                        | Middleware   |
+--------+----------+----------+------+-----------------------------------------------+--------------+
|        | GET|HEAD | /        |      | App\Http\Controllers\PagesController@index    | web          |
|        | GET|HEAD | about    |      | App\Http\Controllers\PagesController@about    | web          |
|        | GET|HEAD | api/user |      | Closure                                       | api,auth:api |
|        | GET|HEAD | services |      | App\Http\Controllers\PagesController@services | web          |
+--------+----------+----------+------+-----------------------------------------------+--------------+

- Her bir işlem için yeni bir route oluşturmamız gerekmekte. Bunun için PostsController.php dosyamızı siliyoruz. Bunu yapmamızın sebebi yukarıda yazdığımız tüm fonksiyonlar bizim resource'larımız yani kaynaklarımız diyebiliriz. Bu kaynak fonksiyonlarını Artisan bizim için oluşturabilmektedir.
    `php artisan make:controller PostsController --resource`
    Komutu çalıştırdıktan sonra yeni PostsController dosyasının içerisinde fonskiyonlarımızın oluştuğunu görüyoruz ve bu her fonksiyon için ayrı bir route'a ihtiyacımız olacaktır.

- /routes/web.php içerisine girdiğimizde,
    Elimizdeki tüm route'ları görebiliriz, `Route::resource('posts','PostsController');` satırını eklediğimizde otomatik olarak tüm route'lar elenmektedir.

    `php artisan:route:list`
+--------+-----------+-------------------+---------------+-----------------------------------------------+--------------+
| Domain | Method    | URI               | Name          | Action                                        | Middleware   |
+--------+-----------+-------------------+---------------+-----------------------------------------------+--------------+
|        | GET|HEAD  | /                 |               | App\Http\Controllers\PagesController@index    | web          |
|        | GET|HEAD  | about             |               | App\Http\Controllers\PagesController@about    | web          |
|        | GET|HEAD  | api/user          |               | Closure                                       | api,auth:api |
|        | GET|HEAD  | posts             | posts.index   | App\Http\Controllers\PostsController@index    | web          |
|        | POST      | posts             | posts.store   | App\Http\Controllers\PostsController@store    | web          |
|        | GET|HEAD  | posts/create      | posts.create  | App\Http\Controllers\PostsController@create   | web          |
|        | GET|HEAD  | posts/{post}      | posts.show    | App\Http\Controllers\PostsController@show     | web          |
|        | PUT|PATCH | posts/{post}      | posts.update  | App\Http\Controllers\PostsController@update   | web          |
|        | DELETE    | posts/{post}      | posts.destroy | App\Http\Controllers\PostsController@destroy  | web          |
|        | GET|HEAD  | posts/{post}/edit | posts.edit    | App\Http\Controllers\PostsController@edit     | web          |
|        | GET|HEAD  | services          |               | App\Http\Controllers\PagesController@services | web          |
+--------+-----------+-------------------+---------------+-----------------------------------------------+--------------+

- Yukarıda yazdığımız komut bize bir harita çıkarmaktadır, fonksiyonların bzi nereye götüreceğini, nasıl gideceğini hazırlar. Görüldüğü gibi bir tüm route'lar eklenmiştir. Bir sonraki bölümde bu postlarla iligili işlemleri yapacağız.

[Part5]
- /app/Post.php içerisinde pek fazla birşey yapmamıza gerek yok zaten, Model classını miras aldığı için aslında pek çok şeye buradan erişebiliyoruz. `Post::All();` ile Post içerisindeki herşeyi çekebiliyoruz. Yapabileceğimiz şeyler arasnda, eğer değiştirmek isterseniz tablo ismini değiştirebilirsiniz, id alınabilir veya özelleştirilebilir.

- Eğer projede laravelProject.dev/posts* içerisine girdiğiniz zaman PostsController içerisindeki Index fonksiyonuna gitmektedir. Karşımıza bir ekran gelmemesinin sebebi aslında bu.
    * Eğer hosts dosyasını düzenlediyseniz bu şekilde karşınıza gelir tarayıcınızdan, düzenlemediyseniz benim gibi aynı anda localhost/laravelProject/public/posts içerisinde görebilirsiniz.

- PostsController içerisindeki Index fonksiyonundan bize posts.index view'ını döndürmesini isteyelim. Tabi bunun için Views içerisinde bir index.blade.php oluşturmamız gerekiyor. Elim değmişken dizin de oluşutrayım.

- Burada değinilmesi gereken bir konu mevcut, Elequent ORM. Elequent ORM dediğimiz yapı aslında veritabanı ile daha kolay bir şekilde çalışmamızı sağlayan, kolay bir şekilde verilerimizi yönetmemize yardımcı olan bir ActiveRecord uygulamasıdır. Peki ActiveRecord dediğimiz olay ne ? ActiveRecord aslında veri tabanı uygulamalarıyla ilgilenenlerin de bildiği DML ve DDL sorgularını kolaylıkla, fonksiyonlar aracılığı ile göndermemizi sağlayan, bir yönden de hayatımızı kolaylaştıran bir araç diyebiliriz. Basitçe bir örnek verecek olursak basit elimizde adı Product olan bir tablomuz olsun;

    . $urun = New Product;
    . $urun -> name = "Monitör";
    . $urun -> save();

    Yukarıda gördüğünüz örnek aslında `insert into Product(name) values('Monitör')` SQL Query'sinden başka birşey değildir. 

- Kısa bir bilgilendirmeden sonra PostsController içerisinden verilerimizi çekmeye ve göstermeye başlayalım.
    . views/posts içerisinde oluşturduğumuz index ve show içerisinde aslında sayfalara nasıl verileri gönderdiğimizi gösterdiğim için pek bir açıklama yazmadım. Ancak neyin nasıl olduğunu yine açıkça gözükmektedir.

    . PostsController içerisinde Elequent ile ilgili birkaç tane daha örnek bulabilirsiniz.
    . Aynı zamanda /resources/views/posts/index.blade.php içerisinden gerekli yorum satırlarını okuyabilirsiniz.
    . /resources/views/posts/show.blade.php içerisinden gerekli yorum satırlarını okuyaiblirsiniz.

[Part6]





        

