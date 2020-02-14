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

Route::get('/put-cache', function () {
    cache()->put('bref', 'on the floor', 60);
});

Route::get('/get-cache', function () {
    dump(cache('bref'));
});
