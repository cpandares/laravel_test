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
//use App\Image;
/*

Route::get('/', function () {

   $images = Image::all();
    foreach($images as $image){
        echo $image->image_path."<br>";
        echo $image->description."<br>";
        echo $image->user->nickname."<br>";
        echo "<strong> COMENTARIOS </strong>";
       foreach($image->comments as $comments){
           echo $comments->user->name.' '. $comments->user->lastname.': ';
           echo $comments->content."<br>";
       }

       echo ' Likes '. count($image->likes);
        echo "<hr>";
    }
    
die();
    return view('welcome');

});
*/


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('configuracion', 'UserController@config')->name('config');
Route::post('user/update', 'UserController@update')->name('user.update');
Route::get('user/image/{filename}', 'UserController@getImagen')->name('user.image');
Route::get('image/create', 'ImageController@create')->name('image.create');
Route::post('image/save', 'ImageController@save')->name('image.save');

Route::get('/image/file/{filename}', 'ImageController@getImages')->name('home.image');

Route::get('image/detalle/{id}', 'ImageController@detail')->name('image.detail');
Route::post('content/store', 'CommentController@store')->name('content.store');
Route::get('comment/delete/{id}', 'CommentController@delete')->name('comment.delete');
Route::get('like/{image_id}', 'LikeController@like')->name('like.save');
Route::get('dislike/{image_id}', 'LikeController@dislike')->name('dislike.delete');
Route::get('/likes', 'LikeController@index')->name('likes');
Route::get('user/profile/{id}', 'UserController@profile')->name('user.profile');
Route::get('image/delete/{id}', 'ImageController@delete')->name('image.delete');
Route::get('image/edit/{id}', 'ImageController@edit')->name('image.edit');
Route::post('image/update', 'ImageController@update')->name('image.update');
Route::get('gente/{search?}', 'UserController@users')->name('user.index');