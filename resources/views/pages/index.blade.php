<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Burada .env içerisinden APP_NAME çekilerek title'a yazılır, eğer yoksa diğer tırkan içerisindeki değer işlenir. -->
        <title>{{config('app.name', 'laravelProject')}}</title>
    </head>
    <body>
        <h1> Welcome to laravelProject </h1>
        <p> Lorem ipsum dolor, sit amet consectetur adipisicing elit. Explicabo inventore quos debitis deleniti minus voluptate aperiam nihil, unde iusto quis aliquam illum eos natus doloribus id odio esse asperiores quaerat! </p>
    </body>
</html>
