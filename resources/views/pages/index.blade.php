{{-- Bu bölümde layouts dan app.blade.php gelmektedir. --}}
@extends('layouts.app')

{{-- Conten'in başladığını section ile başlatıp, endsection ile bitiriyoruz. --}}
@section('content')
    {{-- <h1> Welcome to laravelProject </h1> --}}

    {{-- Artık Pages Controller ile Alabiliyoruz //$ işaretini unutma --}}
    <h1>{{$title}}</h1>
    <p> Lorem ipsum dolor, sit amet consectetur adipisicing elit. Explicabo inventore quos debitis deleniti minus voluptate aperiam nihil, unde iusto quis aliquam illum eos natus doloribus id odio esse asperiores quaerat! </p>
@endsection
