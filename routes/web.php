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

Route::get('/', 'FolderController@index');
Route::get('/home', 'FolderController@index');
Route::get('/terms', 'TermsController@showTerms');
Route::group(['middleware' => 'auth'], function() {
  Route::get('/sentence', 'SentenceController@index');
  Route::get('/sentence/create', 'SentenceController@create');
  Route::post('/sentence/create', 'SentenceController@create');
  Route::get('/sentence/save', 'SentenceController@save');
  Route::post('/sentence/save', 'SentenceController@save');
  Route::get('/sentence/achieve', 'SentenceController@achieve');
  Route::post('/sentence/achieve', 'SentenceController@achieve');
  Route::get('/sentence/accomplish', 'SentenceController@accomplish');
  Route::post('/sentence/accomplish', 'SentenceController@accomplish');
  Route::get('/sentence/forget', 'SentenceController@forget');
  Route::post('/sentence/forget', 'SentenceController@forget');
  Route::get('/sentence/unlearn', 'SentenceController@unlearn');
  Route::post('/sentence/unlearn', 'SentenceController@unlearn');
  Route::get('/sentence/delete', 'SentenceController@delete');
  Route::post('/sentence/delete', 'SentenceController@delete');
  Route::get('/sentence/list/{lang}/{achieved}/{order}', 'SentenceController@showList')
           ->where('lang', '[0, 1]')->where('achieved', '[0, 1, 2]')->where('order', '[0, 1, 2]');
});
Auth::routes();
Route::get('/{folder}', 'FolderController@showFolder')->name('show.folder');
Route::post('/clear/{folderId}/{newClearData}', 'FolderController@clear');
