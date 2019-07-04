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
        <!-- Bu bölüme pages içerisindeki content bölümü yani içerik gelecektir. Bu sayede tüm pages içerisindeki tekrarlayan kısımları atabiliriz. -->
        @yield('content')
    </body>
</html>
