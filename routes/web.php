<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/hello', function () {
//     return 'HelloWorld';
// });


// Route::get('/users/{id}', function($id) {
//     return 'Bu istenilen id '.$id;
// });

// Route::get('/users/{id}/{name}', function($id,$name) {
//     return 'Bu istenilen id '.$id.' adı '.$name;
// });

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::get('/about', function() {
//     return view('pages.about');
// });

Route::get('/', 'PagesController@index');           //PagesController içierisindeki index fonksiyonunu koşar.

Route::get('/about', 'PagesController@about');

Route::get('/services', 'PagesController@services');

Route::resource('posts', 'PostsController');        //Kontrol içerisinde oluşturulan her bir fonksiyon için yönlendirme oluşturur.


Auth::routes();

Route::get('/dashboard', 'DashboardController@index');
