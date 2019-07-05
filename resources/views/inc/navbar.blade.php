{{-- 
    https://getbootstrap.com/docs/4.3/examples/starter-template/
    Bu adresten nav-bar alınarak düzenlendi.
    --}}

{{-- navbar-fixed-top classı kaldırıldı. --}}
<nav class="navbar navbar-expand-md navbar-dark bg-dark">       

    {{-- navbar-brand proje adı çağırıldı config içerisinden --}}
    <a class="navbar-brand" href="/laravelProject/public/">{{config('app.name', 'laravelProject')}}</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">

            {{-- active classı çıkarıldı şimdilik, daha sonra dinamik bir şekilde yapılacak --}}
            <li class="nav-item">
                <a class="nav-link" href="/laravelProject/public/">Home <span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/laravelProject/public/about">About</a>
            </li>

            <li class="nav-item">
                    <a class="nav-link" href="/laravelProject/public/services">Services</a>
            </li>

        </ul>
    </div>
</nav>