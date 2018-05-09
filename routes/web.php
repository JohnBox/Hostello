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
Route::get('livers', 'LiverController@getIndex');
Route::get('livers/active', 'LiverController@getActive');
Route::get('livers/nonactive', 'LiverController@getNonactive');
Route::get('livers/removed', 'LiverController@getRemoved');
Route::get('livers/create', 'LiverController@getCreate');
Route::post('livers/create', 'LiverController@postCreate');
Route::get('livers/edit/{id}', 'LiverController@getEdit');
Route::post('livers/edit', 'LiverController@postEdit');
Route::get('livers/delete/{id}', 'LiverController@getDelete');
Route::get('livers/show/{id}', 'LiverController@getShow');
Route::get('livers/settle/{id}', 'LiverController@getSettle');
Route::post('livers/settle', 'LiverController@postSettle');
Route::get('livers/remove/{id}', 'LiverController@getRemove');
Route::get('livers/money/{id}', 'LiverController@getMoney');
Route::post('livers/money', 'LiverController@postMoney');

//Route::get('rooms', 'RoomController@getIndex')->name('rooms.index');
//Route::get('rooms/floor/{id}', 'RoomController@getFloor')->name('rooms.floor');
//Route::get('rooms/show/{id}', 'RoomController@getShow');
//Route::get('rooms/settle/{id}', 'RoomController@getSettle');

//Route::get('payments', 'PaymentController@getIndex');
//Route::post('payments/create', 'PaymentController@postCreate');
//Route::get('payments/livers/{date}', 'PaymentController@getLivers');
//Route::get('payments/paid/{id}', 'PaymentController@getPaid');

//Route::get('violations', 'ViolationController@getIndex');
//Route::get('violations/create', 'ViolationController@getCreate');
//Route::post('violations/create', 'ViolationController@postCreate');
//Route::get('violations/edit/{id}', 'ViolationController@getEdit');
//Route::post('violations/edit', 'ViolationController@postEdit');
//Route::get('violations/delete/{id}', 'ViolationController@getDelete');
//Route::get('violations/paid/{id}', 'ViolationController@getPaid');

//Route::get('settings', 'SettingController@getIndex');
//
//Route::get('settings/create-hostel', 'SettingController@getCreateHostel');
//Route::post('settings/create-hostel', 'SettingController@postCreateHostel');
//Route::get('settings/edit-hostel/{id}', 'SettingController@getEditHostel');
//Route::post('settings/edit-hostel', 'SettingController@postEditHostel');
//Route::get('settings/delete-hostel/{id}', 'SettingController@getDeleteHostel');
//
//Route::get('settings/create-user', 'SettingController@getCreateUser');
//Route::post('settings/create-user', 'SettingController@postCreateUser');
//Route::get('settings/edit-user/{id}', 'SettingController@getEditUser');
//Route::post('settings/edit-user', 'SettingController@postEditUser');
//Route::get('settings/delete-user/{id}', 'SettingController@getDeleteUser');
//
//Route::get('settings/create-faculty', 'SettingController@getCreateFaculty');
//Route::post('settings/create-faculty', 'SettingController@postCreateFaculty');
//Route::get('settings/edit-faculty/{id}', 'SettingController@getEditFaculty');
//Route::post('settings/edit-faculty', 'SettingController@postEditFaculty');
//Route::get('settings/delete-faculty/{id}', 'SettingController@getDeleteFaculty');
//
//Route::get('settings/create-group', 'SettingController@getCreateGroup');
//Route::post('settings/create-group', 'SettingController@postCreateGroup');
//Route::get('settings/edit-group/{id}', 'SettingController@getEditGroup');
//Route::post('settings/edit-group', 'SettingController@postEditGroup');
//Route::get('settings/delete-group/{id}', 'SettingController@getDeleteGroup');
//
//Route::post('settings/create-rooms', 'SettingController@postCreateRooms');
//Route::get('settings/delete-rooms', 'SettingController@getDeleteRooms');
//Route::get('settings/edit-room/{id}', 'SettingController@getEditRoom');
//Route::post('settings/edit-room', 'SettingController@postEditRoom');
//Route::get('settings/delete-room/{id}', 'SettingController@getDeleteRoom');


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

Route::get('', 'HomeController@index')->name('home');

//Route::get('liver/profile', 'ProfileController@index');
//Route::get('liver/rooms', 'ProfileController@rooms');
//Route::get('liver/payments', 'ProfileController@payments');
//Route::get('liver/violations', 'ProfileController@violations');
//Route::get('liver/injections', 'ProfileController@injections');
//Route::get('liver/ejections', 'ProfileController@ejections');


Route::get('logout', 'Auth\LoginController@logout');


Auth::routes();
