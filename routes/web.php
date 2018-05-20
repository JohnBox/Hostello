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

Route::middleware(['auth'])->group(function () {
    Route::resource('universities', 'UniversityController');

    Route::resource('faculties', 'FacultyController');

    Route::resource('specialties', 'SpecialtyController');

    Route::resource('groups', 'GroupController');

    Route::resource('hostels', 'HostelController');

    Route::resource('watchmen', 'WatchmanController');

    Route::resource('injections', 'InjectionController');

    Route::resource('ejections', 'EjectionController');

    Route::get('payments/autocomplete', 'PaymentController@autocomplete')->name('payments.autocomplete');
    Route::resource('payments', 'PaymentController');

    Route::get('violations/autocomplete', 'ViolationController@autocomplete')->name('violations.autocomplete');
    Route::resource('violations', 'ViolationController');

    Route::get('livers/autocomplete', 'LiverController@autocomplete')->name('livers.autocomplete');
    Route::resource('livers', 'LiverController');

    Route::get('rooms/autocomplete', 'RoomController@autocomplete')->name('rooms.autocomplete');
    Route::resource('rooms', 'RoomController');

    Route::resource('profiles', 'ProfileController');


    Route::get('', 'HomeController@index')->name('home');

    Route::get('logout', 'Auth\LoginController@logout');
});

Auth::routes();
