@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!

                    {{-- Bu link sağ tarafta dursun. Nav-Bar üzerinde olan bu linki, kullanıcı giriş yaptığında 
                        kullanabilsin diye home -> dashboard üzerinde tutacağız. --}}
                        <a class="btn btn-success float-right" href="/laravelProject/public/posts/create">Post Oluşturun</a>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
