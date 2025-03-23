<?php

namespace App\Http\Controllers;
use App\Http\Resources\MessageCollection;
use App\Http\Resources\MessageResource;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMessageRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Treits\HttpResponses;
class MessageController extends Controller
{
    use HttpResponses;
    public function index(){
        return new MessageCollection(Message::where("user_id",Auth::user()->id)->get());
    }
    public function store($username,StoreMessageRequest $request){
        $Message=$request->validated();
        $Message["user_id"]=User::where("username",$username)->first()->id;
        $Message=new MessageResource(Message::create( $Message));
        return $this->Success([
            "message"=> $Message
        ]);
    }
}
