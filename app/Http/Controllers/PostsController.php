<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;                               //App içerisindeki Post.php dosyasını model clasını da miras aldığı için burada çağırıyoruz. Bu sayede veri tabanı işlemlerini yapabileceğiz.
use DB;                                     //SQL sorgularını kulanabilmemiz için DB kütüphanesini ekilyoruz.

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$posts = Post::all();                                         //Elequent dediğimiz durum bu aslında, detaylı bilgi için kendimeNotlar.md
        //$posts = Post::where('title', 'İkinci Post')->get();          //Where ile beraber herhangi bir veriyi çekebiliriz.
        //$posts = DB::select('SELECT * FROM posts');                   //SQL Query bu şekilde rahat bir şekilde çekilebilmektedir.
        //$posts = Post::orderBy('id','desc')->take(1)->get();          //Sorgulardan gelenlerden sadece tek bir tanesini gönümüze getiriyor take fonksiyonu ile.
        
        //Paginate, belkide bu tarz durumlarda şuana kadar en sevdiğim fonksiyon diyebilirim. Normalde elle yaptığım bu
        //fonksyionun tam olarak yaptığı işlev şu. Sizin için, belli bir sayıda veri getiriyor, geri kalanınıda sayfalandırmayı sağlıyor.
        //Bundan sonra tek yapmanız gereken şey, posts altında index.blade.php içerisine gidip {{$posts->links()}} satırını eklemek.
        $posts = Post::orderBy('id','desc')->paginate(3);

        //$posts = Post::orderBy('id','desc')->get();                     //Elequent ile beraber SQL sorgularında kullandığımız gibi orderby kullanabiliriz.
        return view('posts.index')->with('posts', $posts);              // posts ana sayfada döndürülecek view
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //İçerikleri göstermek için sayfayı yükleyelim, tabi onun içinde sayfa oluşturmamız gerekiyor.
        //Hangi postu getireceğimiz, link ile gittiğimiz GET metoduyla alınarak Eleuqent ile beraber o id'ye ait post getiriliyor.
        $post =  Post::find($id);

        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
