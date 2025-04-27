<?php

/** @noinspection PhpUndefinedClassInspection */

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

Auth::routes(['reset' => false, 'register' => false]);

Route::redirect('/', '/dashboard');

Route::middleware(['auth', 'logout_if_not_active'])->group(function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/users/change-password', 'UsersController@editPassword')->name('users.edit.password');
    Route::patch('/users/change-password', 'UsersController@changePassword')->name('users.change.password');

    Route::resource('users', 'UsersController')->except(['destroy', 'show']);
    Route::post('/users/bulk-delete', 'UsersController@bulkDelete')->name('users.bulkDelete');
    Route::resource('carrier', 'CarriersController');
    Route::post('/carriers/bulk-delete', 'CarriersController@bulkDelete')->name('carrier.bulkDelete');
    Route::get('/search', 'CarriersController@search')->name('carrier.search');
    Route::get('/export', 'CarriersController@export')->name('carrier.export');
    Route::get('/import', 'CarriersController@import')->name('carrier.import');
    Route::post('/import', 'CarriersController@storeImport')->name('carrier.storeImport');
    Route::get('/clean-config', 'CarrierCleanConfigController@index')->name('carrier.clean_config');
    Route::post('/clean-config', 'CarrierCleanConfigController@update')->name('carrier.clean_config.update');
    Route::get('/activity-log', 'ActivityLogController@index')->name('users.activity_log');
});
