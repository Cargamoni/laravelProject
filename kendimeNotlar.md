# Uygulamalar

* NOT: Bu dökümanı indiip, bir editör aracılığı ile bakarsanız daha rahat okuyabilirsiniz.

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

- Bu bölümde post ekleme işlemi yapıyoruz, /resources/views/posts/create.blade.php dosyasını oluşturup index.blade.php içerisinde ne varsa kopyalayıp yapıştırıyoruz, değişiklikleri onun içerisinden takip edebilirsiniz.

- Bu bölümde bir post oluşturma sayfası oluşturacağız. Bunun için laravelcollective.com internet sitesi daha fazla destek vermiyor ancak github üzerinden yardımlar mevcut. Ben yine yaptığım her adımı neden olduğu ile beraber yardımcı olmaya çalışacağım. Dökümantasyon aşağıda mevcut ekstra olarak incelemek isteyenler için.
    . https://github.com/LaravelCollective/docs/blob/5.6/html.md


    - Yükleme aşamasında öncelikle composer aracılığıyla laravelcollective eklentisini ekleyeceğiz. Ekleyeceğimiz bu araç bize formları daha kolay bir şekilde oluşturmamızı. Form-Groupları daha iyi bir şekilde kullanabilmemizi sağlayan bir araçtır.

    . `composer require "laravelcollective/html":"^5.4.0"`
        
    - Composer ile beraver laravelcollective indiriyoruz. Daha sonra bu aracı projemizde kullanabilmek için gerekli provider ve alias ları ekliyoruz. /config/app.php içerisinde providers bölümüne,
          'providers' => [
                // ...
                Collective\Html\HtmlServiceProvider::class,
                // ...
            ],

    - Son olarak da yine /config/app.php içerisindeki aliases bölümüne,
            'aliases' => [
                // ...
                'Form' => Collective\Html\FormFacade::class,
                'Html' => Collective\Html\HtmlFacade::class,
                // ...
            ],
        eklemeleri yapıyoruz.

- Bu eklemeleri yaptıktan sonra /resources/views/posts/crate.blade.php içerisine kurulumunu yaptığımız aracı ekleyelim.

        . Formun örneği aşağıdaki gibidir, gerekli açıklamayı dosya içerisinden görebilirsiniz.
                {{ Form::open(['url' => 'foo/bar']) }}
                    //
                {{ Form::close() }}

- GNU/Linux işletim sistemlerinde /bootstrap/cache yazılabilir olmalı diye bir hata aldım, others kullanıcılarına yazma yetkisini vermek durumunda kaldım.

- Session dediğimiz yapı, bir kullanıcı veya yöneticinin sistem üzerinde bilgilerinin belli bir süre veya sürekli olarak tutulmasını sağlayan, bu bilgileri aktif olduğu dönem boyunca sistemin erişebilmesini sağlayan, aynı zamanda bu bilgileri yeri geldiği zaman kullanıcı ve sisteme söyleyebilen bir oturum nesnesidir. /resources/views/inc içerisinde oluşturduğumuz messages.blade.php içerisinde tanımı geçtiği için açıklamak, kafada soru işaret bulunuyorsa gidermek için yardımcı olur.

- resources/views/layouts/app.blade.php bildiğiniz gibi bizim layout dosyamız, bu yukarıda bahsettiğimiz messages.blade.php dosyasını, container içerisinde include ederek alınacak hataları o anda kullanıcıya gösterilmesi sağlanacaktır.

- resources/views/posts/create.blade.php içerisinde bir sürü açıklama mevcut, her bir bloğun ne işe yaradığını elimden geldiğince anlatmaya çalıştım, olurda bir sorunuz olursa sormaktan çekinmeyin lütfen.

- app/Http/Controllers/PostsController.php Validate ile ilgili gerekli açıklama da içerisinde.

- Evet, app/Http/Controllers/PostsController.php içerisinde ekleme işlemlerine dair olan yorum satırları olayı daha anlaşılabilir hale getirecektir. Bu sayade yeni bir post'u bir kullanıcı ekleyebilecek düzeye çekmiş oluyoruz. Bir web arayüzünden aldığımız bilgileri veri tabanına yazmamızı sağlayacak bir bölüm oluşturduk. Daha önce böyle bir şey yapayan biri için bu büyük bir adım (:)

- Hadi Nav-Bar'ımıza yeni post ekleme butonu koyalım.
    . resources/views/inc/navbar.blade.php

- Postlarımızı daha opsiyonel ve şekillendirilebilir oluşturmak için Laravel içerisine koyabileceğimiz CK-Editor'den yadım alabiliriz. CK-Editor, yazdığınız yazı fontunu değiştirebildiğiniz, fotoğraf ekleyebildiğiniz, önemli bir noktası da bunları HTML olarak görüntüleyebilip, düzenleyebilip, kaydedebileceğiniz bir yapı sağlamaktadır. Bunun için;
    `https://github.com/UniSharp/laravel-ckeditor`

    . Composer yine bize bu konuda yardımcı olacak, GitHub hesabından görebileceğiniz gibi nasıl yüklendiğini aşağıdan da görebilirsiniz.

    `composer require unisharp/laravel-ckeditor`

    . LaravelCollective'de olduğu gibi yine ApplicationServiceProvider içerisine ekleme yapmamız gerekmektedir. config/app.php içerisindeki providers bölümüne aşağıdaki satırı ekliyoruz.
    
    `Unisharp\Ckeditor\ServiceProvider::class,`

    . Son olarak da Resource'larımızı publish etmemizi istiyor bizden, bunu da Artisan aracılığı ile yapabiliriz.

    `php artisan vendor:publish --tag=ckeditor`

    . Kullanımına gelecek olursak, 

        <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
        <script>
            CKEDITOR.replace( 'article-ckeditor' );
        </script>

        Bu satırları layout dosyamızın body bitişine eklememiz yeterli. Daha sonra da ck editör kullanacağımız textarea'nın id'sine article-ckeditor yazdığımızda otomatik olarak karşımıza gelecektir. Örneği uygulamak için önce resources/views/layouts/app.blade.php içerisine verilerimizi ekleyelim.

        . Eğer bir hata alıyorsanız veya yükleyemiyorsanız, ck-editör'ün projenize eklediğiniz bölümdeki mutlak adresini yazmayı deneyin. Bende yükleme sorunu yaşadığım için, mutlak adresini girmek zounrda kaldım, bu yüzden resources/views/layouts/app.blade.php içerisinde yukarıdan farklı olarak gözükmektedir.

. CK-Editör hakkında ufak bir detay vermiştim yukarıda, HTML olarak kayıt etme özelliği ile ilgili, verilerimizi bu şekilde saklayabildiğimiz gibi bu şekilde de çekebiliyoruz. Ancak bu şekilde eklediğimizi {{}} şeklinde göstermeye çalıştığımızda tarayıcı parse etmiyor ve önümüzü HTML tag'leri ile beraber gelmektedir. Bunu Önlemek için de resources/views/posts/show.blade.php içerisinde de görebileceğiniz gibi postlarımızı daha düzgün bir şeilde gösterebiliriz. Bunun için HTML taglarını işleyebilmek için {!! !!} şeklinde kullanmamız gerekmektedir. Bu sayede birçok HTML tagını kolaylıkla kullanaibliyoruz.

. Bir sonraki bölümdee, silmeyi ve düzenlemeye bakacağız.

[Part7]

- Bir post oluşturabildiğimiz gibi bunları silip, düzenleyebilmemiz de gerekmektedir. resources/views/posts/show.blade.php içerisinden yani postların okunduğu bölümden düzenleme ve silme butonları ekleyelim. Gerekli değişiklikleri oradan kontrol edebilirsiniz.

|        | PUT|PATCH | posts/{post}      | posts.update  | App\Http\Controllers\PostsController@update   | web          |
|        | DELETE    | posts/{post}      | posts.destroy | App\Http\Controllers\PostsController@destroy  | web          |

- Yukarıdaki `php artisan route:list` çıktısından bir bölüm. Sadece bunları almamın sebebi Form'larda verilerin transfer etme metodları üzerine birkaç cümle kuracak olmam. Düzenleme yani update bölümünde Laravel'in PUT veya Patch, silmek yani destroy işlemi için ise DELETE metodlarını desteklediğini yukarıda da görebiliyoruz. Dolayısıyla resources/views/posts/show.blade.php ve resources/views/posts/edit.blade.php dosyaları içerisinde gördüğünüz hidden şeklinde belirtlimiş metodlar mevcut. Bunlar POST şeklinde pass edilen yani gönderilen verilerin görünürde POST ancak gizli olarak PUT veya PATCH, DELETE metodları kullanılarak gönderilmesini sağlamaktadır (Yanlış anladıysam, bir hatam varsa lütfen düzeltin).

[Part8]

- Evet böyle bir uygulama için kaçınılmaz olan durum şudur. Kimlik doğrulama sistemi ve oturum açma. Bu bölümde buna değineceğiz. Değinmemize bile gerek kalmayacak bir kolaylık sağlıyor Laravel bize. Halihazırda dosyaların içerisine baktığınız zaman,
    app/User.php
    app/Providers/AuthServiceProvider.php
    app/Http/Controllers/Auth/ForgotPasswordController.php
    app/Http/Controllers/Auth/LoginController.php
    app/Http/Controllers/Auth/RegisterController.php
    app/Http/Controllers/Auth/ResetPasswordController.php
    app/Http/Controllers/Auth/VerificationController.php
    şeklinde bir sürü kimilk doğrulama ve yönetimiyle ilgili dosyalraın olduğunu görebiliriz.

- Aynı zamanda hatırlarsanız yaptığımız database migration sonucunda, veri tabanı tablolarımızın içerisinde bir users tablomuzun oluştuğunu da görmüştük. Laravel bize User Authentication ile ilgili çok büyük bir yardımda bulunuyor. Yaptığı şey aslında şu, Artisan ile beraber koştuğumuz komutla kendisi bir layout oluşturuyor. Bu layout içerisinde login ve register bölümleri mevcut, aynı zamanda yukarıda görebildiğiniz parola sıfılama, giriş kontrolleri gibi özellikleri de var. Laravel bizim için bu sayfaları oluşturup. Kullanıma hazır bir hale getiriyor. Users tablosunu ve sütunlarını aşağıda inceleyebilirisniz.
    . `php artisan tinker` ile tablolarımızı ve users tablosnun içereeceği bilgileri görebilirsiniz.
        >>> $tables = \DB::select('show tables');
        => [
            {#2962
            +"Tables_in_laravelProject": "migrations",
            },
            {#2960
            +"Tables_in_laravelProject": "password_resets",
            },
            {#2967
            +"Tables_in_laravelProject": "posts",
            },
            {#2969
            +"Tables_in_laravelProject": "users",
            },
        ]
        >>> $columns = \Schema::getColumnListing('users');
        => [
            "id",
            "name",
            "email",
            "email_verified_at",
            "password",
            "remember_token",
            "created_at",
            "updated_at",
        ]

- User Authentication'ı aktif hale getirebilmek için `php artisan make:auth` komutunu yazıyoruz. Bu komutu koştuğumuz zaman terminal üzerinde bize bir soru yöneltecektir. resources/views/layouts/app.blade.php diye bir dosya zaten var bunu değiştireyim mi abi ? Önceki olanları saklamak niyetinde olduğum için bu dosyanın sonuna .old ekleyerek değişiklikleri kaybetmemek ve yenisi üzerinde çalışabilmek için bu şekilde yapıp, okuyanlara da yardımcı olmasını sağlıyorum.
    . app/Http/Controllers/Auth içerisindeki tüm Controller yapısı aktif hale getiriyor Artisan bizim için. Bu kolaylık bizi bir çok angaryadan kurtarıyor.

- Komutu çalıştırdığımızda daha önce yaptığımız layout değiştiği için oluşturduğumuz linklerde onunla beraber gidiyor. Eskisini tutmamız burada bize fayda sağlayacak.

    . resources/views/layouts/app.blade.php.old ihtiyacımız olan bölümleri resources/views/layouts/app.blade.php içerisine aktarmaya başlayalım. Normalde biz Nav-Bar'ı include ediyoruz ancak Laravel bize app.blade içerisinde getiriyor öncelikle bunu bir düzenleyelim.

- Burada değiştirmek isteyebileceğimiz bir bölüm mevcut. Dilerseniz aynı şekilde de bırakabilirsiniz ancak, normalde home dediğimiz kavram ana sayfayı temsil etmektedir. Bir kullanıcı giriş yaptığı zaman dashboard kavramı daha uygun olur. Bu yüzden yönlendirmeler olsun, yeni oluşturulan resources/views/home.blade.php olsun, routes/web.php içerisindeki yönlendirmeler olsun bunları home yerine dashboard ile değiştiriyorum.
    . app/Http/Controllers/Auth/LoginController.php
        /home -> /dashboard
    . app/Http/Controllers/Auth/RegisterController.php
        /home -> /dashboard
    . app/Http/Controllers/Auth/ResetPasswordController.php
        /home -> /dashboard
    . app/Http/Controllers/Auth/VerificationController.php
        /home -> /dashboard
    . routes/web.php
        Route::get('/home', 'HomeController@index')->name('home'); -> Route::get('/dashboard', 'DashboardController@index');
            Burada değiştrdiğimiz HomeController ismini app/Http/Controllers/HomeController.php -> app/Http/Controllers/DashboardController.php olarak da değiştirmeyi unutmayın.
    . resources/views/home.blade.php -> resources/views/dashboard.blade.php
    . app/Http/Controllers/DashboardController.php
        return view('home'); -> return view('dashboard');
        class HomeController extends Controller -> class DashboardController extends Controller

- Tüm değişiklikleri yaptıktan sonra resources/views/inc/navbar.blade.php içerisine giriş yapıldığında dashboard'a gidebilmek için bir link ekledim. Kullanıcı giriş yaptığında bu değişiklikleri yaptığınızda bizi resources/views/dashboard.blade.php yönlendirecek ve buradan bir post oluşturmamızı sağlayacak butonu da ekledik.

- Artık kullanıcı kimlik doğrulama işlemlerini aktif hale getirdiğimize göre, postlarımızı hangi kullanıcının eklediğini belirtmemizin vakti geldi. phpMyAdmin üzerinden veya tinker'dan posts tablosunu kontrol ederseniz herhangi bir user_id bölümünün olmadığını görebilirsiniz. Sistemde giriş yapmış kullanıcı bir post oluşturduğunda bunu belirtemiyoruz. Bunu elemek için ise Artisan'dan yardım alacağız.
    . `php artisan make:migration add_user_id_to_posts`
        Komutunu koşuyoruz. Önceden de yaptığımız gibi bu bize database/migrations/2019_07_08_074019_add_user_id_to_posts.php oluşturuyor. Oluşturduğumuz migration içerisine baktığımızda up ve down fonksiyonlarını görebiliyoruz.

        . up fonksiyonu içerisine 
            Schema::table('posts', function($table){
                $table->integer('user_id');
            });

        . down fonksyionu içerisine
            Schema::table('posts', function($table){
                $table->dropColumn('user_id');
            });

        Artisan bize bu fonksiyonları zaten oluşturuyor. Bu yüzden sadece up fonksiyonu içerisine $table->integer('user_id'); down fonksiyonu içerisine de $table->dropColumn('user_id'); eklememiz yeterli olacaktır. Yoks sizin yazmanız gerekir.
    
    . İşlemlerimizi yaptıktan sonra artık migrate işlemini gerçekleştirebiliriz. `php artisan migrate` Eklenilen sütunları görmek için tinker veya phpmyadmin'den posts tablosunu kotnrol edebilirsiniz. Manuel olarak 0 girilmiş satırları düzeltebiliriz şimdilik. Ancak post oluşturulduğunda ekleme yapması için app/Http/Controllers/PostsController.php içerisinde store fonksiyonunu düzenlememiz gerekecektir.
        . $post->user_id = auth()->user()->id;
    
[Part9]

- Burada yapacağımız durum tablolar arasındaki ilişkiler ile ilgleneceğiz. Oluşturulacak Post'lar bir kullanıcı ile ilişkili olduğu için hangi postun kime ait olduğunu belirtebiliyor olmamız gerekmektedir. Şuanki durumda yapacağımız ise Dashboard üzerinde giriş yapmış kullanıcının postlarını göstermek istiyoruz. Bir ilişki oluşturmak Laravel ile aslında çok kolay, app/Post.php içerisine gidiyoruz.

    . app/Post.php
        public function user(){
            return $this->belongsTo('App\User');
        }

    . app/User.php
        public function posts(){
            return $this->hasMany('App\Post');
        }

    . Bu satırları dosyalarımıza ekledikten sonra user ile posts arasında bir ilişki olduğunu ifade ediyoruz. İlişkinin türünü de User.php içerisinde belirtiyoruz. Post'un kullanıcıya ait olduğunu Post.php içerisinde bir kullanıcının birden fazla post'unun olabileceğini de User.php içerisinde fonksiyonlarla tanımlıyoruz.

. app/Http/Controllers/DashboardController.php içerisinde kullanıcının bilgilerini view'a gönderiyoruz. resources/views/dashboard.blade.php içerisinde de bu bilgileri göstermek için değişiklikleri yapacağız. Her bir kişiye ait olan post'ları kendi dashboardlarında gösterilecek. Gerekirse düzenleme ve silme işlemlerini gerçekleştirilecek duruma getilirecektir.

- resources/views/dashboard.blade.php içerisinde HTML aracılığıyla Başlık bilgisini çektik ve post sahibi, kendi mesajlarını düzenleyeiblecek veya silebilecektir. Detayları için dosyaya bakabilirsiniz.


User::find(122)->sites->paginate(); doesnt work because you are trying to call the paginate method on the sites collection. With the parenthesis you call it on the return value of the relationship method, which is the relationship object, which can be used as a query builder.





        

