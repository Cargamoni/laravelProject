{{-- Bu bölümde layouts dan app.blade.php gelmektedir. --}}
@extends('layouts.app')

{{-- Conten'in başladığını section ile başlatıp, endsection ile bitiriyoruz. --}}
@section('content')

    {{-- Artık Pages Controller ile Alabiliyoruz //$ işaretini unutma // Dizinin içerisinde verinin olup olmadığını kontrol etmemiz gerekiyor.--}}
    <h1>{{$title}}</h1>

    @if(count($services) > 0)
    <ul>
        @foreach($services as $service)
            <li>{{$service}}</li>
        @endforeach
    </ul>
    @endif

    <p> Lorem ipsum dolor, sit amet consectetur adipisicing elit. Explicabo inventore quos debitis deleniti minus voluptate aperiam nihil, unde iusto quis aliquam illum eos natus doloribus id odio esse asperiores quaerat! </p>
@endsection