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
    //CRUD for psps
    Route::get('/psps/datatable', 'TypePspController@datatableData')->name('psp.datatable.data');
    Route::resource('psps', 'TypePspController');
    //CRUD for users
    Route::get('/user/datatable', 'UserController@datatableData')->name('user.datatable.data');
    Route::resource('users', 'UserController');
    //CRUD for typesViolation
    Route::get('/type/datatable', 'TypeViolationController@datatableData')->name('type.datatable.data');
    Route::resource('typeViolations', 'TypeViolationController');
    //CRUD for typesBuild
    Route::get('/typeBuild/datatable', 'TypeBuildController@datatableData')->name('typeBuild.datatable.data');
    Route::resource('typeBuilds', 'TypeBuildController');
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

Route::get('/check/create/{id}', 'CheckController@inspector_create')->name('inspector.create');
Route::post('/checks', 'CheckController@inspector_store')->name('inspector.store');

Route::get('/builds2/datatable', 'BuildController@welcomedatatableData')->name('build2.datatable.data');
Route::get('/show/{build}', 'BuildController@insp_show')->name('build.show');

Route::get('change_system', 'UserController@change_system')->name('change_system');

