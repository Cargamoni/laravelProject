{{-- Bu bölümde layouts dan app.blade.php gelmektedir. --}}
@extends('layouts.app')

{{-- Conten'in başladığını section ile başlatıp, endsection ile bitiriyoruz. --}}
@section('content')
    {{-- <h1> About </h1> --}}

    {{-- Artık Pages Controller ile Alabiliyoruz, index'dekinden farklı olarak bu şekilde de yapılabilir. //$ işaretini unutma --}}
    <h1><?php echo $title; ?></h1>

    <p> Lorem ipsum dolor, sit amet consectetur adipisicing elit. Explicabo inventore quos debitis deleniti minus voluptate aperiam nihil, unde iusto quis aliquam illum eos natus doloribus id odio esse asperiores quaerat! </p>
@endsection
