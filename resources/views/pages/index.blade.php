{{-- Bu bölümde layouts dan app.blade.php gelmektedir. --}}
@extends('layouts.app')

{{-- Conten'in başladığını section ile başlatıp, endsection ile bitiriyoruz. --}}
@section('content')
    <div class="jumbotron text-center">
        {{-- Artık Pages Controller ile Alabiliyoruz //$ işaretini unutma --}}
        <h1>{{$title}}</h1>
        <p> Lorem ipsum dolor, sit amet consectetur adipisicing elit. Explicabo inventore quos debitis deleniti minus voluptate aperiam nihil, unde iusto quis aliquam illum eos natus doloribus id odio esse asperiores quaerat! </p>
        <p>
            <a class="btn btn-primary btn-lg" href="{{ route('login') }}" role="button">{{ __('Login') }}</a>
            @if (Route::has('register')) 
                <a class="btn btn-success btn-lg" href="{{ route('register') }}" role="button">{{ __('Register') }}</a>
            @endif
        </p>
    </div>
@endsection
