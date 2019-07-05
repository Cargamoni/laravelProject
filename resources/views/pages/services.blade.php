{{-- Bu bölümde layouts dan app.blade.php gelmektedir. --}}
@extends('layouts.app')

{{-- Conten'in başladığını section ile başlatıp, endsection ile bitiriyoruz. --}}
@section('content')

    {{-- Artık Pages Controller ile Alabiliyoruz //$ işaretini unutma // Dizinin içerisinde verinin olup olmadığını kontrol etmemiz gerekiyor.--}}
    <h1>{{$title}}</h1>

    @if(count($services) > 0)
    <ul class="list-group">
        @foreach($services as $service)
            <li class="list-group-item">{{$service}}</li>
        @endforeach
    </ul>
    @endif
@endsection