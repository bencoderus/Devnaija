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
//Main Routes
Route::get('/', 'PagesController@index');
Route::get('trending', 'PagesController@trending');
Route::get('about', 'PagesController@about');
Route::get('contact', 'PagesController@contact');
Route::get('contact', 'PagesController@contact');
Route::get('banned', 'PagesController@banned');
//Ajax Request
Route::any('date', function () {
$date = date('Y-m-d H:i:s', time());
return $date;
});
Route::get('test', 'PagesController@test');
Route::get('test2', 'PagesController@test2');
Route::post('testup', 'PagesController@testup');
Route::post('/checktest', 'PagesController@test3');
Route::post('/ajax/threadlock', 'AjaxController@threadlock');
Route::get('/ajax/post/{id}', 'PagesController@test4');
Route::post('/ajax/likepost', 'AjaxController@likepost');
Route::post('/ajax/unlikepost', 'AjaxController@unlikepost');
Route::post('/ajax/banuser', 'AjaxController@banuser');
Route::post('/ajax/unbanuser', 'AjaxController@unbanuser');



//Account
Route::get('account', 'UserController@account');
Route::get('user/{name}', 'UserController@profile');
Route::post('user/storephoto', 'UserController@storephoto');
Route::get('account/changephoto', 'UserController@myphoto');
Route::get('account/notifications', 'UserController@notify');
Route::get('/account/thread/{name}', 'UserController@mythread');

//Message
Route::get('/message', 'MessageController@index');
Route::get('/message/send/{name?}', 'MessageController@send');
Route::get('/message/view/{name}', 'MessageController@view');
Route::get('/message/inbox', 'MessageController@inbox');
Route::get('/message/unread', 'MessageController@unread');
Route::get('/message/sent', 'MessageController@sent');
Route::post('/message/send', 'MessageController@store');

//Forum Routes
Route::get('forum', 'ForumController@index');
Route::get('forum/search', 'ThreadController@search');
Route::post('forum/find', 'ThreadController@find');
Route::get('forum/{slug}', 'ForumController@show');
Route::get('forum/create/{id}', 'ThreadController@create');
Route::post('forum/addthread', 'ThreadController@store');
Route::get('thread/{slug}', 'ThreadController@show');

Route::get('topic/{slug}', 'ThreadController@show');
Route::post('forum/addpost', 'PostController@store');
Route::get('thread/editpost/{id}', 'PostController@edit');
Route::post('thread/updatepost', 'PostController@update');
Route::delete('/thread/tdelete/{id}', 'ThreadController@destroy')->name('tdelete');
Route::delete('/admin/postdelete/{id}', 'PostController@destroy')->name('postdelete');
Route::get('thread/edit/{id}', 'ThreadController@edit');
Route::post('thread/threadupdate', 'ThreadController@update');
Route::post('thread/threaddelete', 'ThreadController@destroy');
Route::post('thread/threadlock', 'ThreadController@lock');
Route::post('thread/threadunlock', 'ThreadController@unlock');
Route::get('thread/quote/{id}', 'PostController@quote');
Route::post('thread/', 'PostController@quotereply');
Route::post('thread/like', 'ThreadController@like');
Route::post('thread/unlike', 'ThreadController@unlike');


//Admin Routes
Route::get('/admin', 'AdminController@dashboard');
Route::get('/admin/sendbc', 'AdminController@bc');
Route::post('/admin/sendbc', 'AdminController@sendbc');
Route::get('/admin/section', 'AdminController@section');
Route::get('/admin/users', 'AdminController@users');
Route::get('/admin/forum', 'AdminController@forum');
Route::get('/admin/thread', 'AdminController@thread');
Route::get('/admin/post', 'AdminController@comment');
Route::delete('/admin/deletesec/{id}', 'SecController@destroy')->name('secdelete');
Route::get('/admin/secedit/{id}', 'SecController@edit')->name('secedit');
Route::post('/admin/secupdate', 'SecController@update');
Route::delete('/admin/deleteforum/{id}', 'ForumController@destroy')->name('forumdelete');
Route::get('/admin/forumedit/{id}', 'ForumController@edit')->name('forumedit');
Route::post('/admin/forumupdate', 'ForumController@update');

//admin post Routes
Route::post('/admin/addforum', 'ForumController@store');
Route::post('/admin/addsection', 'SecController@store');



//Auths Routes
Auth::routes();
Route::get('/dashboard', 'DbController@index')->name('home');


Route::get('/slug', function(){
$title = "Everything you need to know about content writing in blogging";
$slug = str_slug($title);
$num = rand(111,999);
return $slug ."-" .$num;
});


Route::get('/mail', function(){
$thread=App\Thread::find(2);
return new App\Mail\Thread($thread);
});
