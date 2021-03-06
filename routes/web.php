<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->middleware('verified');

Route::resource('users', 'usersController');

Route::resource('articleCategories', 'ArticleCategoryController');

Route::resource('articles', 'ArticleController');

Route::post('articles/publish/{id}', 'ArticleController@publish')->name('articles.publish');

Route::resource('dppDocuments', 'DppDocumentController');
Route::get('dppDocuments/document/uiksbu', 'DppDocumentController@uiksbu')->name('dppDocuments.uiksbu');