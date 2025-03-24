<?php

namespace App\Http\Controllers;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Treits\HttpResponses;
class UserController extends Controller
{
    use HttpResponses;
    public function index(){
        $users= new UserCollection(User::all());
        return $this->Success([
            "user"=> $users
        ]);
    }
    public function show(){
        $user= new UserResource(Auth::user());
        return $this->Success([
            "user"=> $user
        ]);
    }
}
