<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = 'Welcome to laravelProject';
        //return view('pages.index');         //views içerisinde index.blade.php oluşturularak buradan çağırılır.
        //return view('pages.index', compact('title')); //Bu şekilde ikinci parametre ile sayfaya değişkeni gönderebiliyoruz.
        return view('pages.index')->with('title', $title);  //Bu şekilde with ile beraber view içerisindeik adı ve değişken ile de gönderilebiliyor.
    }

    public function about(){
        $title = 'About Page';
        //return view('pages.about');         //views içerisinde bulunan about.blade.php çağırılır.
        return view('pages.about', compact('title'));       //Farklı bir kullanım aktif
    }

    public function services(){
        //Bir dizinin aktarılması.
        $data = array(
            'title' => 'Services',
            'services' => ['Web Design', 'Programming', 'SEO']      //Dizi içerisindeki başka bir dizinin eklenmesi
        );
        return view('pages.services')->with($data);         //views içerisinde bulunan services.blade.php çağırılır. dizi olduğu için sadece dizi adı yazılıyor
    }
}
