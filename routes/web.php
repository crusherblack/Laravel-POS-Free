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
| <!-- © 2020 Copyright: Tahu Coding -->
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/products','ProductController');

Route::get('/transcation', 'TransactionController@index');
Route::post('/transcation/addproduct/{id}', 'TransactionController@addProductCart');
Route::post('/transcation/removeproduct/{id}', 'TransactionController@removeProductCart');
Route::post('/transcation/clear', 'TransactionController@clear');
