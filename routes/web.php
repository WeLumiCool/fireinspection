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
Route::get('/show', function () {
    return view('objects.show');
})->name('show');

Route::prefix('admin')->name('admin.')/*->middleware('admin')*/
->group(function () {
    Route::get('/', 'AdminController@index')->name('admin');
    Route::get('dashboard', 'AdminController@dashboard')->name('dashboard');

    //CRUD for builds
    Route::get('/builds/datatable', 'BuildController@datatableData')->name('build.datatable.data');
    Route::resource('builds', 'BuildController');
    //CRUD for checks
    Route::get('/checks/datatable', 'BuildController@datatableData')->name('build.datatable.data');
    Route::resource('checks', 'CheckController')->except('create');
    Route::get('/checks/create/{id}', 'CheckController@create')->name('checks.create');
    //AJAX
    Route::get('change_permission', 'UserController@change_permission')->name('change.permission');
});
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
