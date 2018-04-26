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
Route::get('livers/delete/{id}', 'LiverController@getDelete');
Route::get('livers/show/{id}', 'LiverController@getShow');
Route::get('livers/settle/{id}', 'LiverController@getSettle');
Route::post('livers/settle', 'LiverController@postSettle');
Route::get('livers/remove/{id}', 'LiverController@getRemove');
Route::get('livers/money/{id}', 'LiverController@getMoney');
Route::post('livers/money', 'LiverController@postMoney');

Route::get('rooms', 'RoomController@getIndex');
Route::get('rooms/show/{id}', 'RoomController@getShow');
Route::get('rooms/settle/{id}', 'RoomController@getSettle');

Route::get('payments', 'PaymentController@getIndex');
Route::post('payments/create', 'PaymentController@postCreate');
Route::get('payments/livers', 'PaymentController@getLivers');
Route::get('payments/paid', 'PaymentController@getPaid');

Route::get('reports', 'ReportController@getIndex');

Route::resource('violations', 'ViolationController');
Route::resource('settings', 'SettingController');
Route::resource('', 'HomeController');
Route::get('logout', 'Auth\LoginController@logout');


Auth::routes();
