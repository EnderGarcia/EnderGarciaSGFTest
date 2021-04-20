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
Route::get('/','App\Http\Controllers\Home\HomeController@index')->name('home');
Route::middleware([ApiKeyLaika::class])->group(function()
{
  Route::group(['prefix' => '/users','as' => 'users.'], function() {
      Route::post('/','App\Http\Controllers\Users\UsersController@index')->name('index');
      Route::any('/list','App\Http\Controllers\Users\UsersController@list')->name('list');
      Route::post('/store','App\Http\Controllers\Users\UsersController@store')->name('store');
      Route::post('/update/{id?}','App\Http\Controllers\Users\UsersController@update')->name('update');
      Route::delete('/destroy/{id?}','App\Http\Controllers\Users\UsersController@destroy')->name('destroy');
  });
  Route::group(['prefix' => '/documents','as' => 'documents.'], function() {
      Route::post('/','App\Http\Controllers\DocumentTypes\DocumentTypesController@index')->name('index');
      Route::any('/list','App\Http\Controllers\DocumentTypes\DocumentTypesController@list')->name('list');
      Route::post('/store','App\Http\Controllers\DocumentTypes\DocumentTypesController@store')->name('store');
      Route::post('/update/{id?}','App\Http\Controllers\DocumentTypes\DocumentTypesController@update')->name('update');
      Route::delete('/destroy/{id?}','App\Http\Controllers\DocumentTypes\DocumentTypesController@destroy')->name('destroy');
  });
});
