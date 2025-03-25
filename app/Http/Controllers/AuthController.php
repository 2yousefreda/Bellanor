<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Notifications\LoginNotification;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Treits\HttpResponses;
use phpDocumentor\Reflection\Location;

class AuthController extends Controller
{
    use HttpResponses;
    public function Login(LoginUserRequest $request){
        $ip = $request->ip();
        $lo=Location::get($ip);
        
        $request->validated($request->all());
        if(!Auth::attempt($request->only('email','password'))){
            return $this->Error('','Credentials does not match',401);
        }
        $user = User::where('email', $request->email)->first(); 
        $user->notify(new LoginNotification());
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
            'age'=>$request->age,
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
