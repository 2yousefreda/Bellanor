<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/{username}', [MessageController::class, 'store']);

Route::post('/register  ', [AuthController::class, 'register']);
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::apiResource('messages', MessageController::class);
    Route::get('profile', [UserController::class,'show']);
    Route::get('users', [UserController::class,'index']);
    Route::post('/logout  ', [AuthController::class, 'logout']);
 
});