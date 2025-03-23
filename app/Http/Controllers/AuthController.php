<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Treits\HttpResponses;

class AuthController extends Controller
{
    use HttpResponses;
    public function Login(LoginUserRequest $request){
        $request->validated($request->all());
        if(!Auth::attempt($request->only('email','password'))){
            return $this->Error('','Credentials does not match',401);
        }
        $user = User::where('email', $request->email)->first(); 
        return $this->Success([
            'user'=>$user,
            'token'=>$user->createToken('Api Tocken of '.$user->name,)->plainTextToken
        ]);
    }
    public function Register(StoreUserRequest $request){
        $request->validated($request->all());
        $user= User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'username'=>$request->username,
            'password'=>Hash::make($request->password),
        ]
        );
        return $this->Success([
            'user'=>$user,
            'token'=>$user->createToken('Api Tocken of '.$user->name)->plainTextToken
        ]);
    }
    public function Logout(){
        Auth::user()->currentAccessToken()->delete();
        return $this->Success([
            'message'=>'Logged out successfully'
        ]);
    }
}
