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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('notes')->group(function () {
    Route::get('', 'NotesController@index')->name('notes.index');
    Route::get('create', 'NotesController@create')->name('notes.create');
    Route::get('edit/{notes}', 'NotesController@edit')->name('notes.edit');
    Route::get('show/{order}', 'NotesController@show')->name('notes.show');
    Route::get('pdf/{notes}', 'NotesController@pdf')->name('notes.pdf');
    Route::post('store', 'NotesController@store')->name('notes.store');
    Route::post('update/{notes}', 'NotesController@update')->name('notes.update');
    Route::post('delete/{notes}', 'NotesController@destroy')->name('notes.destroy');
});
Route::prefix('status')->group(function () {
    Route::get('', 'StatusController@index')->name('status.index');
    Route::get('create', 'StatusController@create')->name('status.create');
    Route::post('store', 'StatusController@store')->name('status.store');
    Route::post('delete/{status}', 'StatusController@destroy')->name('status.destroy');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
