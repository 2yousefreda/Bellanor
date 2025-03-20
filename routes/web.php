<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('Main');
});
Route::get('/messages', function () {
    return view('Messages');
});