@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard  
                        {{-- Bu link sağ tarafta dursun. Nav-Bar üzerinde olan bu linki, kullanıcı giriş yaptığında 
                            kullanabilsin diye home -> dashboard üzerinde tutacağız. --}}
                        <a class="btn btn-success float-right" href="/laravelProject/public/posts/create">Post Oluşturun</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h3>Size Ait Olanlar</h3>
                    @if(count($posts) > 0)
                        <table class="table table-striped">
                            <tr>
                                <th>Başlık</th>
                                <th></th>
                                <th></th>
                            </tr>
                            
                            {{-- Dashboard üzerinde kullanıcıya ait olan postlar gösterilecek. Düzenleyebileceği ve 
                                Silebileceği butonlar burada kaşısına çıkacak. --}}
                            @foreach ($posts as $post)
                            <tr>
                                <td>{{$post->title}}</td>
                                <td></td>
                                <td>
                                    <a href="/laravelProject/public/posts/{{$post->id}}/edit" class="btn btn-md btn-secondary float-right">Düzenle </a>
                                    {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right mr-1'])!!}
                                        {{Form::hidden('_method', 'DELETE')}}
                                        {{Form::submit('Postu Sil', ['class' => 'btn btn-danger'])}}
                                    {!!Form::close()!!}
                                </td>
                            </tr>
                            @endforeach

                        </table>

                        {{-- Sayfalandırma yapıldığı zaman konuşlandırılacak linkler. --}}
                        <div class="float-right mt-2">
                                {{$posts->links()}}
                        </div>
                    @else
                        <hr>
                        <p>Herhangi bir Postunuz yok.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
