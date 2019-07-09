@extends('layouts.app')

@section('content')
    <h1> Posts </h1>
    {{-- Öncelikle Post varmı kontrol edelim. Parametre olarak gönderilen tablo foreach ile satırları teker teker okunabiliyor.--}}
    @if(count($posts) > 0)
        @foreach($posts as $post)
            <a href="/laravelProject/public/posts/{{$post->id}}" class="card-link text-dark">
                <div class="card card-body">
                        {{-- Resim ve Konu başlığı yanyana gözükmesi için düzenledik. --}}
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <img class="img-thumbnail" src="storage/cover_images/{{$post->cover_image}}">
                            </div>
                            <div class="col-md-8 col-sm-8">
                            <h3>{{$post->title}}</h3>
                            <small>{{$post->user->name}} tarafından {{$post->created_at}} tarihinde oluşturuldu. </small>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
        {{-- Burada sayfalandırma işlemini gerçekleştiren links fonksiyonu, gönderilen kaç sayfa ise 
            burayı ona göre ayarlayıp, postların yazdığınız sınırda gösterilmesini ve kalanını
            bir diğer sayfaya aktarılmasına yardımcı olacak numaralandırma işlemini yapıyor. --}}
        <div class="float-right mt-2">
            {{$posts->links()}}
        </div>
    @else
        <p>No Posts Found</p>
    @endif
@endsection