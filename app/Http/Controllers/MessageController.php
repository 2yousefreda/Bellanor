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
        $Messages=new MessageCollection(Message::where("user_id",Auth::user()->id)->get());
        return $this->Success($Messages);
    }
    public function store($username,StoreMessageRequest $request){
        if(!User::where("username",$username)->exists()){
            return $this->Error('',"User not found",404);
        }
        $Message=$request->validated();
        $Message["user_id"]=User::where("username",$username)->first()->id;
        if(request()->hasFile('image')){
            $Message["image"]=StoreImage($request->file('image'),'MessageImages');
        }
        $Message=new MessageResource(Message::create( $Message));
        return $this->Success([
            "message"=> $Message
        ]);
    }
    public function show(Message $Message){
        
        if($Message->user_id!=Auth::user()->id){
            return $this->Error('',"You are not authorized to view this message",401);
        }
        $Message=new MessageResource($Message);
        return $this->Success($Message);
    }
    public function delete(Message $Message){
        if($Message->user_id!=Auth::user()->id){
            return $this->Error('',"You are not authorized to delete this message",401);
        }
        $Message->delete();
        return $this->Success('',"Message deleted successfully");
    }
}
