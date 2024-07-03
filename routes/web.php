<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/products', 'App\Http\Controllers\ProductController@index')->name('products.index');
Route::get('/products/create', 'App\Http\Controllers\ProductController@create')->name('products.create');
Route::post('/products/store', 'App\Http\Controllers\ProductController@store')->name('products.store');
Route::get('/products/show/{id}', 'App\Http\Controllers\ProductController@show')->name('products.show');
Route::get('/products/edit/{id}', 'App\Http\Controllers\ProductController@edit')->name('products.edit');
Route::post('/products/update/{id}', 'App\Http\Controllers\ProductController@update')->name('products.update');
Route::post('/products/destroy/{id}', 'App\Http\Controllers\ProductController@destroy')->name('products.destroy');
