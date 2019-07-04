<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        return view('pages.index');         //views içerisinde index.blade.php oluşturularak buradan çağırılır.
    }

    public function about(){
        return view('pages.about');         //views içerisinde bulunan about.blade.php çağırılır.
    }

    public function services(){
        return view('pages.services');         //views içerisinde bulunan services.blade.php çağırılır.
    }
}
