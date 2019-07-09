<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //User tablosundan kullanıcının id'si aracılığı ile giriş yapmış
        //kullanıcının bilgilerini dashboard'a gönderiyoruz. Posts.php içerisinden
        $user_id = auth()->user()->id;

        // $user = User::find($user_id);
        // return view('dashboard')->with('posts', $user->posts);

        //Çok varsa bu şekilde kullanabiliriz. Sayfalandıralım, sanırım bunu kullanabildiğim
        //her yerde kullanacacğım (:
        $user_posts = User::find($user_id)->posts()->paginate(4);

        return view('dashboard')->with('posts', $user_posts);
    }
}
