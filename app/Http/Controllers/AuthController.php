<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\EmailVerificationRequest;
use App\Http\Requests\ForgetPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Http\Request;

use App\Services\AuthService;


// use phpDocumentor\Reflection\Location;

class AuthController 
{
    protected $AuthService;
   public function __construct(AuthService $AuthService)
    {
       $this->AuthService = $AuthService;
    }

    public function Login(LoginUserRequest $request){
        return $this->AuthService->Login($request);
    }
    public function Register(StoreUserRequest $request){
        return $this->AuthService->Register($request);
    }
    public function ResendEmailVerification(Request $request){
       return $this->AuthService->ResendEmailVerification($request);
    }
    public function EmailVerification(EmailVerificationRequest $request){
        return $this->AuthService->EmailVerification($request);
    }
    public function ForgetPassword(ForgetPasswordRequest $request){
      return $this->AuthService->ForgetPassword($request);  
    }
    public function ResetPassword(ResetPasswordRequest $request){
       return $this->AuthService->ResetPassword($request);
    }
    public function Logout(){
       return $this->AuthService->Logout();
    }
}
