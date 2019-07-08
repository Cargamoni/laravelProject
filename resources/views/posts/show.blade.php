@extends('layouts.app')
{{-- Pek bir açıklama yazmıyorum, artık yerine oturmuş olacağını düşündüğüm için, index.blade.php içerisinde olduğu gibi
    gönderilen classın içerisinde çağırılan tablonun bir satırı buraya gönderilerek, her bir hücreye karşılık olan veri 
    getirilmektedir. --}}
@section('content')
    
    <h1>{{$post->title}}</h1>
    <div class="card card-body">
            {{-- <p>{{$post->body}}</p> --}}

            {{-- CK-Editör eklendikten sonra HTML taglarını okuyabilmesi içingösterim şeklini aşağıdaki gibi değiştiriyoruz. --}}
            <div>
                {!!$post->body!!}
            </div>
            <hr>
            
            <small>{{$post->user->name}} tarafından {{$post->created_at}} tarihinde oluşturuldu. </small>
    </div>
    <a href="/laravelProject/public/posts" class="btn btn-md btn-primary mt-1">Geri Dön</a>
     {{-- 
        Bir front-ent developer burada çıldırdı. Normalde bu şekilde kullanılması gerekiyor. Ancak işin kolayına kaçıldığı için a kullanıldı.
        tarayıcı htmli dom tree sekilde tutar. html taglerine göre kullanılan ögelerin ne işe yaradıgını anlar. her tagin kendi özelliği vardır.
        h1 yerine p kullanılmaması gerektigi gibi a tagine button davranışı verilmemesi gerekir. tarayıcı a tagini görünce link oldugunu anlar.
        button oldugunu biz söylemeden anlayamaz. bunun içinde button tagi kullanmak gerekir.
        
        <button class="btn btn-md btn-primary"><a href="/laravelProject/public/posts">Geri Dön</a></button>  
        --}}

    {{-- Part7 Düzenleme ve Silme Butonları --}}
    {{-- Bu butona tıklandığı zaman app/Http/Controllers/PostsController.php içerisindeki edit fonksiyonu çalışacaktır.
        Bunu düzenlemeye gidelim şimdide. --}}
    <a href="/laravelProject/public/posts/{{$post->id}}/edit" class="btn btn-md btn-secondary mt-1">Düzenle </a>

    {{-- Şimdiii, eğer biz bir formu silmek istiorsak, bunun bilgilerini bir şekilde gönderebilmemiz gerekiyor. Bunun için
        Create page'inde olduğu gibi bir form yapısına ihtiyaç duyuyoruz. --}}

        {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Postu Sil', ['class' => 'btn btn-danger mt-1'])}}
        {!!Form::close()!!}
@endsection