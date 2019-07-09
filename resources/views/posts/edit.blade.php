@extends('layouts.app')
{{-- Bu sayfadaki form ve diğer öğeler create.blade.php içerisinde açıklanmıştır. --}}
@section('content')
    <h1>{{$post->title}} Postunu Değiştirin</h1>
    {{-- Burada PostController içerisindeki update fonksiyonu çalışacağı için form kısmındaki action'ın yönlendirildiği
    bölüm değiştiriliyor. Eksra olarak da id gönderiliyor. id ile beraber çektiğimiz verilerin içeriği textbox ve text 
    area içerisine doduruyoruz, böylelikle düzenleme seçeneiğini kullanıcıya verebiliyoruz.
    --}}
    {{ Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
        <div class="form-group">
            {{Form::label('title', 'Başlık')}}
            {{Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Başlık'])}}
        </div>

        <div class="form-group">
            {{Form::label('body', 'Gövde')}}
            {{Form::textarea('body', $post->body, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Gövde'])}}
        </div>
        <div class="form-group">
                {{Form::file('cover_image')}}
        </div>
        {{-- Burada gizli bir şekilde metodumuzun değiştirmek durumundayız, Laravel ile oluşturduğumuz route bizim posts.update
            fonksiyonumuzun sadece PUT veya PATCH metodlarıyla veri göndermemizi kabul ettiği için bu yola başvuruyoruz. Aynı zamanda
            bunun dışarıdan görülmemesi de gerekiyor. --}}
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Gönder', ['class' => 'btn btn-primary'])}}
        {{-- Gönder butonu PostsController içerisindeki update fonksiyonu boş olduğu için bir işlev gerçekleştiremeyecektir. --}}
    {{ Form::close() }}
@endsection