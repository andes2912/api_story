<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login','API\AuthController@index');

// Frontend
Route::get('/articles','API\FrontendController@article');
Route::get('/articles/{slug}','API\FrontendController@showArticle');

Route::group(['middleware' => 'auth:api'], function(){
	Route::get('profile', 'API\AuthController@profile');
	Route::post('logout', 'API\AuthController@logout');

  // Category
  Route::resource('category','API\CategoryController');

  // Article
  Route::resource('article','API\ArticleController');
});
