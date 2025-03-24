<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;




Route::post('/register  ', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::group(['middleware' => ['auth:sanctum']], function () {
    
    Route::get('messages', [MessageController::class,'index']);
    Route::get('message/{message}', [MessageController::class,'show']);
    Route::delete('message/{message}', [MessageController::class,'delete']);
    Route::get('users', [UserController::class,'index']);
    Route::get('profile', [UserController::class,'show']);
    Route::put('profile', [UserController::class,'update']);
    Route::post('/logout  ', [AuthController::class, 'logout']);
    
});
Route::post('/{username}', [MessageController::class, 'store']);