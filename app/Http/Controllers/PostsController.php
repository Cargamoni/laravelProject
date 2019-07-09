<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;                               //App içerisindeki Post.php dosyasını model clasını da miras aldığı için burada çağırıyoruz. Bu sayede veri tabanı işlemlerini yapabileceğiz.
use DB;                                     //SQL sorgularını kulanabilmemiz için DB kütüphanesini ekilyoruz.
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     * Kullanıcı olmayanların bu alanda giriş yapmadan bir post oluşturmasını engelledik bununla beraber.
     * except ile beraber hangi fonksiyonların daha doğrusu hangi view'ların bundan mahrum bırakılacağını
     * seçebiliyoruz.
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware('auth', ['except' => ['index','show']]);
    }

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
            'body' => 'required',
            //Cover image için validate fonksiyonu biraz daha farklı çalışacak, required yerine
            //image olduğunu belirtmek için image
            //boş bırakılabilir olduğunu belirtmek için nullable
            //boyut sınırlaması için de max:1999 ekliyoruz.
            //Boyut sınırlaması çoğu apache serverda 2mb olduğu için bu şekilde yapıyoruz.
            'cover_image' => 'image|nullable|max:1999'
        ]);

        //Dosya Yükleme ile ilgilenecek olan bölüm burada başlıyor.
        if($request->hasFile('cover_image'))
        {
            //Dosya adının uzantısı ile beraber alınması
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            
            //Sadece Dosya Adının alınması
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            //Sadece uzantının alınması
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            //Saklanacak Dosyanın Adı
            $zaman = time();
            $fileNameToStore = $filename.'_'.$zaman.'.'.$extension;

            //Resmi yükleme
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } 
        else 
        {
            $fileNameToStore = 'noImage.jpg';
        }


        // Yeni bir post oluşturmak için artisan tinkerda yaptığımızın aynısını burada
        //yapıyoruz. Tinker'da yaptığımız şey postu App\Post(); şeklinde çağırırken burada
        //Dosyanın başında use ile beraber çağırdığımız için sadece new Post şeklinde
        //yazmamız yetiyor.

        //Yeni eklediğimiz sütun için auth bize kullanıcımızın id'sini vererek tablo içerisinde
        //id bölümünü doldurmamızı sağlıyor.

        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        //yeni eklediğimiz sütun için dosya adını giriyoruz.
        $post->cover_image = $fileNameToStore;
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

        //Doğru kullanıcının kontrol edildiği bölüm burası
        if(auth()->user()->id !== $post->user_id) {
            return redirect('posts')->with('error', 'Unauthorized Page');
        }
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

        //Resim güncellendiğinde eski resmin adını alabilmek için post değişkeninin tnaımlanmasını
        //Buraya aldık.
        $post = Post::find($id);

        //Dosya Yükleme ile ilgilenecek olan bölüm burada başlıyor.
        //Yüklemeden farklı olarak burada işler biraz daha farklı gelişiyor.
        //Yüklenmezse eski fotoğrafı silmemek için else bölümünü kaldırıyoruz.
        if($request->hasFile('cover_image'))
        {
            //Dosya adının uzantısı ile beraber alınması
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            
            //Sadece Dosya Adının alınması
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            //Sadece uzantının alınması
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            //Saklanacak Dosyanın Adı
            $zaman = time();
            $fileNameToStore = $filename.'_'.$zaman.'.'.$extension;

            //Resmi yükleme
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);

            //Eski Resmi Silme
            Storage::delete('public/cover_images/'.$post->cover_image);
        }

        //Burada yaptığımız değişiklik, bir postumuz hali hazırda bulunduğu için 
        //yeni bir post şeklinde açmayacağız, bunun yerine Request ile beraber gelen 
        //id ile find fonksiyonumuzu çalıştıracağız.
        //$post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        //Eğer gerçekten bir resim eklendiyse ekleme yapılacak, eskisi silinecek
        if($request->hasFile('cover_image')){
            $post->cover_image = $fileNameToStore;
        }
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

        //Doğru kullanıcının kontrol edildiği bölüm burası
        if(auth()->user()->id !== $post->user_id) {
            return redirect('posts')->with('error', 'Unauthorized Page');
        }

        if($post->cover_image != 'noImage.jpg') {
            //Resmi silme
            Storage::delete('public/cover_images/'.$post->cover_image);
        }

        $post->delete();
        return redirect('/posts')->with('success','Post Silindi');
    }
}
