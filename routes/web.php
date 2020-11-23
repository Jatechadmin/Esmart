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
    return view('index');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/artikel', function () {
    return view('artikel');
});

Route::get('/regulasi', function () {
    return view('regulasi');
});

Route::get('/kontak', function () {
    return view('kontak');
});

Route::get('/calc','HomeController@calc');
Route::get('/calc2','HomeController@calc2');
