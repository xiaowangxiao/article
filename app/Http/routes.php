<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/login','AdminController@login');
Route::post('admin/registerUser','AdminController@registerUser');
// Route::post('admin/checkLogin',['middleware'=>'auth',function(App\Http\Controllers\AdminController $admin){
// 	return $admin->checkLogin();
// }]);
Route::post('admin/checkLogin','AdminController@checkLogin');
// Route::get('article/getArticleList',['middleware'=>'auth',function(App\Http\Controllers\ArticleController $article){
// 	return $article->getArticleList();
// }]);
// Route::get('article/delArticle',['middleware'=>'auth',function(App\Http\Controllers\ArticleController $article){
// 	return $article->delArticle();
// }]);
// Route::post('article/addArticle',['middleware'=>'auth',function(App\Http\Controllers\ArticleController $article){
// 	return $article->addArticle();
// }]);
Route::group(['middleware'=>'checkLogin'],function(){
	Route::match(['get', 'post'],'article/getArticleList','ArticleController@getArticleList');
	Route::get('article/delArticle/{id}',function(App\Http\Controllers\ArticleController $article,$id){
		return $article->delArticle($id);
	});
	Route::post('article/addArticle','ArticleController@addArticle');
});



Route::get('admin/clearSession','AdminController@clearSession');
Route::post('article/click','ArticleController@click');
// Route::auth();

// Route::get('/home', 'HomeController@index');

Route::get('test','RedisController@test');
