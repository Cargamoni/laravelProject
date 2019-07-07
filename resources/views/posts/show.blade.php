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
            <small>Oluşturulma tarihi : {{$post->created_at}}</small>
    </div>
    <a href="/laravelProject/public/posts" class="btn btn-md btn-primary mt-1">Geri Dön</a>
     {{-- 
        Bir front-ent developer burada çıldırdı. Normalde bu şekilde kullanılması gerekiyor. Ancak işin kolayına kaçıldığı için a kullanıldı.
        tarayıcı htmli dom tree sekilde tutar. html taglerine göre kullanılan ögelerin ne işe yaradıgını anlar. her tagin kendi özelliği vardır.
        h1 yerine p kullanılmaması gerektigi gibi a tagine button davranışı verilmemesi gerekir. tarayıcı a tagini görünce link oldugunu anlar.
        button oldugunu biz söylemeden anlayamaz. bunun içinde button tagi kullanmak gerekir.
        
        <button class="btn btn-md btn-primary"><a href="/laravelProject/public/posts">Geri Dön</a></button>  
        --}}
@endsection