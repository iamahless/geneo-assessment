<?php

use Illuminate\Support\Facades\{App, Route, URL};

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

if (App::environment('production')) {
    URL::forceScheme('https');
    URL::forceRootUrl(env('APP_URL'));
};

Route::group(['as' => 'contact.'], function () {
    Route::get('/', 'ContactController@index')->name('index');
    Route::post('/process', 'ContactController@process')->name('process')->middleware('throttle:contact');
});
