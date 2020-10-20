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

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/create', function () {
    return view('objects.create');
})->name('create');

Route::get('/maps', function () {
    return view('objects.maps');
})->name('maps');
//Route::middleware('auth')->group(function () {
//    Route::get('/', function () {
//        return view('welcome', ['types' => \App\Type::all()]);
//    })->name('main');
//});
