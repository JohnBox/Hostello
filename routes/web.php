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

    Route::resource('payments', 'PaymentController');

    Route::resource('violations', 'ViolationController');

    Route::resource('livers', 'LiverController');

    Route::get('/rooms/floor/{id}', 'RoomController@floor')->name('rooms.floor');
    Route::get('/rooms/injection/{liver}', 'RoomController@injection')->name('rooms.injection');
    Route::post ('/rooms/injection/{liver}', 'RoomController@injection')->name('rooms.injection');
    Route::get('/rooms/ejection/{liver}', 'RoomController@ejection')->name('rooms.ejection');
    Route::get('/rooms/rejection/{liver}', 'RoomController@rejection')->name('rooms.rejection');
    Route::post ('/rooms/rejection/{liver}', 'RoomController@rejection')->name('rooms.rejection');
    Route::resource('rooms', 'RoomController');

    Route::resource('profiles', 'ProfileController');

    Route::get('', 'HomeController@index')->name('home');

    Route::get('logout', 'Auth\LoginController@logout');
});

Auth::routes();
