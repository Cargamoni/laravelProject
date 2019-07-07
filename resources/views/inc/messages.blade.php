{{-- Eğer herhangi bir hata mevcut ise ve bunlar kaç tane ise aktif sayfa üzerinde
    gösterilmesini sağlayan bir NavBar gibi bir include edilebilecek bölüm ekledik. --}}
@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="alert alert-danger">
            {{$error}}
        </div>
    @endforeach
@endif

{{-- Burada Session ile ilgili giriş bilgisini onaylayacak bir mesaj bulunmakta, aşağıdaki 
    kod bloğu ise bir hata olduğunda bizim karşımıza giriş veya bir diğer deyişle session
    oluşturulmada hata olursa bunu belirtecektir. --}}
@if(session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{session('error')}}
    </div>
@endif