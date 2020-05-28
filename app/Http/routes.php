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
Route::post('admin/checkLogin','AdminController@checkLogin');
Route::get('article/getArticleList','ArticleController@getArticleList');
Route::post('article/getArticleList','ArticleController@getArticleList');
Route::get('article/delArticle','ArticleController@delArticle');
Route::post('article/addArticle','ArticleController@addArticle');
Route::post('article/click','ArticleController@click');