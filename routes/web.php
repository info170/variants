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

Route::get('/', function () {
    // return view('welcome');
    return redirect('/products');
});

Route::get('/products', 'App\Http\Controllers\ProductsController@index');
Route::get('/product/{id}', 'App\Http\Controllers\ProductsController@show');

Route::post('/products', 'App\Http\Controllers\ProductsController@store');
Route::post('/variants', 'App\Http\Controllers\VariantsController@store');
Route::post('/operations', 'App\Http\Controllers\OperationsController@store');

Route::delete('/product/{id}', 'App\Http\Controllers\ProductsController@destroy');
