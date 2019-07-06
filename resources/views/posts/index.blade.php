@extends('layouts.app')

@section('content')
    <h1> Posts </h1>
    {{-- Öncelikle Post varmı kontrol edelim. Parametre olarak gönderilen tablo foreach ile satırları teker teker okunabiliyor.--}}
    @if(count($posts) > 0)
        @foreach($posts as $post)
            <a href="/laravelProject/public/posts/{{$post->id}}" class="card-link text-dark">
                <div class="card card-body">
                        <h3>{{$post->title}}</h3>
                        <small>Oluşturulma tarihi : {{$post->created_at}}</small>
                </div>
            </a>
        @endforeach
        {{-- Burada sayfalandırma işlemini gerçekleştiren links fonksiyonu, gönderilen kaç sayfa ise 
            burayı ona göre ayarlayıp, postların yazdığınız sınırda gösterilmesini ve kalanını
            bir diğer sayfaya aktarılmasına yardımcı olacak numaralandırma işlemini yapıyor. --}}
        <div class="pull-right mt-2">
            {{$posts->links()}}
        </div>
    @else
        <p>No Posts Found</p>
    @endif
@endsection