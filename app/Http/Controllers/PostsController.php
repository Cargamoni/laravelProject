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
        //Validate ile gelen request'deki verilerin yeterliliği kontrol edilmektedir.
        //Boş gönderildiyse veriler eklenmeyecektir. Post metodu ile beraber gönderilen
        //veriler title name option'ına ait olan başlık bölümünün gerekli olduğunu ve
        //boş bıraklıamayacağını ifade eder. Aynı zamanda body name option'ına ait olan
        //gövde bölümü de boş bırakılamayacaktır.
        
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);



        // Yeni bir post oluşturmak için artisan tinkerda yaptığımızın aynısını burada
        //yapıyoruz. Tinker'da yaptığımız şey postu App\Post(); şeklinde çağırırken burada
        //Dosyanın başında use ile beraber çağırdığımız için sadece new Post şeklinde
        //yazmamız yetiyor.

        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->save();
        
        //İşlem tamamlandıktan sonra postların olduğu sayfaya redirect edilmekteyiz.
        return redirect('/posts')->with('success','Post Oluşturuldu');
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
        //Show içerisindeki gibi aslında postu id'sine göre getirip onun ile ilgili işlem yapacağız.
        //Dolayısıyla bir de edit page oluşturmamız gerekmektedir. Create içerisinde ne varsa kopyalayıp
        //bir takım değişiklikler yapacağız. Değişiklikler için edit.blade.php içerisine bakabilirsiniz.
        $post =  Post::find($id);
        return view('posts.edit')->with('post', $post);
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
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

        //Burada yaptığımız değişiklik, bir postumuz hali hazırda bulunduğu için 
        //yeni bir post şeklinde açmayacağız, bunun yerine Request ile beraber gelen 
        //id ile find fonksiyonumuzu çalıştıracağız.
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->save();
        
        return redirect('/posts')->with('success','Post Düzenlendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Burada resources/views/posts/show.blade.php'dan gelen id'ye ait olan post silinecek. Öncelikle Postu bulmalı
        //ondan sonra da delete fonksyionunu çalıştırmalıyız. Bu kadar basit.

        $post = Post::find($id);
        $post->delete();

        return redirect('/posts')->with('success','Post Silindi');
    }
}
