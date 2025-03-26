<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\EmailIsVerified;

Route::get('users', [UserController::class,'index']);
Route::post('/register  ', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('forget-password', [AuthController::class,'ForgetPassword']);
Route::post('reset-password', [AuthController::class,'ResetPassword']);
Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::group(['middleware'=> [EmailIsVerified::class]], function () {
        Route::get('messages', [MessageController::class,'index']);
        Route::put('update-profile', [UserController::class,'update']);
        Route::get('profile', [UserController::class,'show']);
        Route::get('messages/{message}', [MessageController::class,'show']);
        Route::delete('messages/{message}', [MessageController::class,'delete']);
    });


Route::post('logout  ', [AuthController::class, 'logout']);
Route::post('email-verification', [AuthController::class, 'EmailVerification']);
Route::post('resend-email-verification', [AuthController::class, 'ResendEmailVerification']);
});

Route::post('{username}', [MessageController::class, 'store']);