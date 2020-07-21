<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Post;
use App\User;

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

// Inserts a record into "posts" table with schema (title, content)

Route::get('/basicInsert', function (){

    $post = new Post;

    $post->title = 'new Eloquent title';
    $post->content = 'Wow Eloquent is really cool';

    // Inserts/Updates record
    $post->save();

});


// Finds an entry in 'posts' table where id=2 & update  (title, content)
Route::get('/basicInsert2', function (){

    $post = Post::find(2);

    $post->title = 'new Eloquent title 2';
    $post->content = 'Wow Eloquent is really cool, look at this content 2';

    // Inserts/Updates record
    $post->save();

});

// Creating with a mass assignment. For this to work, you need to add the corresponding fields (title, content) into Post Model
Route::get('/create', function (){
    Post::create(['title'=>'the create method', 'content'=>'WOW I am learning a lot of PHP']);
});

// Practicing chaining, update where id=2 & is_admin=0
Route::get('/update', function (){
    Post::where('id',2)->where('is_admin', 0)->update(['title'=>'NEW PHP TITLE', 'content'=>'I love myself']);
});

// Delete using Eloquent where id=2
Route::get('/delete', function (){
    $post = Post::find(2);
    $post->delete();
});

// Delete entries from posts table where id=4,5
Route::get('/delete2', function (){
    Post::destroy([4,5]);

    // Delete where is_admin=0
    //Post::where('is_admin', 0)->delete();
});

// Find entry in posts table with id=7 and soft delete
Route::get('/softdelete', function (){
    Post::find(7)->delete();
});

// Find only soft deleted entries
Route::get('/readsoftdelete', function (){
//    $post = Post::find(7);
//    return $post;
    //$post = Post::withTrashed()->where('id', 7)->get();
    $post = Post::onlyTrashed()->get();
    return $post;
});

// Restore soft deleted items
Route::get('/restore', function (){
     Post::withTrashed()->where('is_admin', 0)->restore();
});

// Delete trashed items
Route::get('/forcedelete', function (){
    Post::onlyTrashed()->where('is_admin', 0)->forceDelete();
});

/*
|--------------------------------------------------------------------------
| Eloquent - Relationships
|--------------------------------------------------------------------------
|
*/

// One to One relationship
Route::get('/user/{id}/post', function ($id){
    return User::find($id)->post->title;
});

// One to One Relationship Inverse - Retrieves user which the post_id in URI belongs to
Route::get('/post/{id}/user', function ($id) {
    return Post::find($id)->user->name;
});

// One to Many - added posts func. in User class
Route::get('/posts', function (){
    $user = User::find(1);

    foreach ($user->posts as $post) {
        echo $post->title. "<br>";
    }
});

// Many to Many relationship
Route::get('user/{id}/role', function ($id){
    $user = User::find($id);

//    foreach($user->roles as $role) {
//        return $role->name;
//    }
});
