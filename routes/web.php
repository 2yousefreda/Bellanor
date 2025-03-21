<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', [UserController::class, "index"]);
Route::get('/messages', [MessageController::class,'index']);