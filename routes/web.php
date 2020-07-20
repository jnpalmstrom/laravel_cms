<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Post;
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

//
//Route::get('/', function () {
//    return view('welcome');
//});
//
////
//Route::get('/about', function () {
//    return "Hi about page";
//});
//
////
//Route::get('/contact', function () {
//    return "Hi I am contact";
//});
//
//// Shows you can pass multiple parameters thru URL
//Route::get('/post/{id}/{name}', function ($id, $name){
//    return "This is post number ". $id. " ". $name;
//});
//
////
//Route::get('admin/posts', array('as'=>'admin.home', function (){
//
//    $url = route('admin.home');
//    return "This URL is ". $url;

//}));
/*
//Route::get('/post/{id}', 'PostsController@index');
Route::resource('posts', 'PostsController');

Route::get('/contact', 'PostsController@contact');

Route::get('post/{id}/{name}/{pass}', 'PostsController@show_post');


/*
|--------------------------------------------------------------------------
| Database Raw SQL Queries
|--------------------------------------------------------------------------
|
*/
/*
// SQL INSERT
Route::get('/insert', function(){
    DB::insert('insert into posts(title, content) values(?, ?)', ['PHP with Laravel', 'Laravel is great.']);
});

// SQL SELECT
Route::get('/read', function(){
    $results = DB::select ('SELECT * FROM posts WHERE id = ?', [1]);
    foreach($results as $result) {
        return $result->title;
    }

});

// SQL UPDATE
Route::get('/update', function(){
    $updated = DB::update ('UPDATE posts SET title = "Updated title" WHERE id = ?', [1]);
    return $updated;
});

// SQL DELETE
Route::get('/delete', function(){
    $deleted = DB::delete('DELETE FROM posts WHERE id = ?', [1]);
    return $deleted;
});
*/

//Route::get();

/*
|--------------------------------------------------------------------------
| Eloquent (ORM)
|--------------------------------------------------------------------------
|
*/

// Finding Titles from Posts Database
Route::get('/read', function (){

    $posts = Post::all();

    foreach ($posts as $post) {
        return $post->title;
    }

});

//
Route::get('/findwhere', function (){

    return Post::where('id', 3)->orderBy('id', 'desc')->take(1)->get();
});

Route::get('/findmore', function (){
//    $posts = Post::findOrFail(1);
//    return $posts;

    $posts = Post::where('user_count', '<', 50)->firstOrFail();
    return $posts;
});
