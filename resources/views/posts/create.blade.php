@extends('layouts.app')

@section('content')
    <h1> Blog Yazısı Oluşturun </h1>
    {{-- Alışılan HTML Form yapısından farklı olarak LaravelCollective aracı ile oluşuturulan 
        bir yapı karşımızda bulunmaktadır.
        
        Formun action olan kısmını PostsController üstlenmektedir. o yüzden göndeilen veriler
        PostsController içerisindeki store fonksiyonu üstlenmektedir. Store fonksiyonu öncelikle 
        alanların boş olup olmaıdğını kontrol edecek bir fonksiyona tabi tutulacaktır. Bunun için
        PostsController içerisini kontrol edebilirsiniz. 
        
        Formun hangi metod ile verileri göndereceği ise bir sonraki bölümdeki method bölümünde 
        belirtilmektedir. POST ile beraber verilerimiz gönderilecektir. İstenirse GET ile alınabilir.
        --}}
    {{ Form::open(['action' => 'PostsController@store', 'method' => 'POST' , 'enctype' => 'multipart/form-data']) }}
        {{-- Bootstrap ile beraber oluşuturlan form-group içerisinde Label ve Text oluşturulmaktadır.
            MVC ile berabaer Form classından label ve text fonksiyonları çağırılarak arayüz oluşturlur.
            Textbox'ın parametrelerinden ilki title name, '' olan kısım  textbox'ın içeriinin boş
            olup olmaması, 'placeholder' içerisinde de HTML'de olduğu gibi placeholder olarak Title
            oluşturulmaktadır.  Aynı zamanda da aşağıda textarea bu şekilde oluşturulmuştur.
            
            Son olarak Form::submit() fonksiyonu ile veriler gönderilmektedir.--}}
        <div class="form-group">
            {{Form::label('title', 'Başlık')}}
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Başlık'])}}
        </div>

        <div class="form-group">
                {{Form::label('body', 'Gövde')}}
                {{Form::textarea('body', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Gövde'])}}
        </div>

        {{-- Bir resim göndermek istediğimiz zaman form metodlarının arasına enctype eklememiz gerekiyor. 
            'enctype' => 'multipart/form-data' şeklinde eklememizi yaptıktan sonra, HTML gönderdiğiniz dosyayı
            encoded yani kodlanmış bir şekilde iletmenizi sağlayacaktır. Bu sayede kısmı veri güvenliği sağlanabilir
            diyebiliriz.--}}
        <div class="form-group">
            {{Form::file('cover_image')}}
        </div>
        {{Form::submit('Gönder', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}
@endsection