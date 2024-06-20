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




Route::get('szervezoinknek', function () {
    return view('szervezoinknek');

});
Route::get('rolunk', function () {
    return view('rolunk');

});
Route::get('kapcsolat', function () {
    return view('kapcsolat');

});

Auth::routes();

Route::get('/', "\App\Http\Controllers\PecAdminController@Main")->name('PecAdmin.Main');
Route::get('/kapcsolat', "\App\Http\Controllers\PecAdminController@kapcsolat")->name('PecAdmin.kapcsolat');
Route::get('/rolunk', "\App\Http\Controllers\PecAdminController@rolunk")->name('PecAdmin.rolunk');
Route::get('/szervezoinknek', "\App\Http\Controllers\PecAdminController@szervezoinknek")->name('PecAdmin.szervezoinknek');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('Home');

Route::resource('Hirdetes', App\Http\Controllers\HirdetesController::class);

Route::post('/hirdetes/create', "\App\Http\Controllers\HirdetesController@create");
Route::get('/hirdetes/jelentkez', "\App\Http\Controllers\HirdetesController@jelentkez")->name('jelentkez');
Route::post('/hirdetes/jelentkezesStore', "\App\Http\Controllers\HirdetesController@jelentkezesStore")->name('jelentkezesStore');

Route::get('/hirdetes/indexPrivate', "\App\Http\Controllers\HirdetesController@indexPrivate")->name('indexPrivate');


Route::get('/hirdetes/edit/hirdetes={IdHirdetes}', "\App\Http\Controllers\HirdetesController@edit")->name('edit');

Route::post('/hirdetes/update/hirdetes={IdHirdetes}', "\App\Http\Controllers\HirdetesController@update")->name('update');

Route::get('/hirdetes/destroy/hirdetes={IdHirdetes}', "\App\Http\Controllers\HirdetesController@destroy")->name('destroy');
Route::get('/hirdetes/destroylist/hirdetes={Id}', "\App\Http\Controllers\HirdetesController@destroylist")->name('destroylist');


Route::get('/hirdetes/show/hirdetes={IdHirdetes}', "\App\Http\Controllers\HirdetesController@show")->name('reszletek');
Route::get('/hirdetes/listing/hirdetes={IdHirdetes}', "\App\Http\Controllers\HirdetesController@listing")->name('listing');



