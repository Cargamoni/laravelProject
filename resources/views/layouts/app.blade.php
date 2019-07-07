<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- Burada varsayılan css çağırılmaktadır --}}
        <link rel="stylesheet" href="{{asset('css/app.css')}}" >

        <!-- Burada .env içerisinden APP_NAME çekilerek title'a yazılır, eğer yoksa diğer tırkan içerisindeki değer işlenir. -->
        <title>{{config('app.name', 'laravelProject')}}</title>
    </head>
    <body>
        
        {{-- Navbar buraya include ediliyor. --}}
        @include('inc.navbar')

        {{-- Container bölümü burada başlıyor --}}
        <div class="container">

            {{-- Hata mesajları ve sesion ile ilgili uyarılar bu bölüme yerleştirilmektedir. --}}
            @include('inc.messages')

            <!-- Bu bölüme pages içerisindeki content bölümü yani içerik gelecektir. Bu sayede tüm pages içerisindeki tekrarlayan kısımları atabiliriz. -->
            @yield('content')
        </div>

        {{-- ck-editor'un çalışmasını sağlayacak olan js dosyasını include ediyoruz, böylelikle ID bölümünde 
        article-ckeditor yazan textarea HTML elemanları için değişim sağlayacaktır. Kullanımını, resources/views/posts/create.blade.php
        içerisinden kotnrol edebilirsiniz. Sayfaya yüklerken bulamadığı için mutlak adres vermek zorunda kaldım. --}}
        <script src="/laravelProject/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
        <script>
            CKEDITOR.replace('article-ckeditor');
        </script>
    </body>
</html>
