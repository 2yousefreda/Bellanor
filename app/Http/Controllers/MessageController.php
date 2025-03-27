<?php

namespace App\Http\Controllers;
use App\Http\Resources\MessageCollection;
use App\Http\Resources\MessageResource;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;
use App\Treits\HttpResponses;

use function PHPSTORM_META\type;

class MessageController extends Controller
{
    use HttpResponses;
    public function Index(request $request){

        $type = $request->query('type');
        if($type == null){
            $type="received";
        }
        if($type=="received"){
            $Messages=new MessageCollection(Message::where("receiver_id",Auth::user()->id)->get());
            return $this->Success($Messages);
        }else if($type== "sent"){
            $Messages=new MessageCollection(Message::where("sender_id",Auth::user()->id)->get());
            return $this->Success($Messages);
        }else if($type== "favorites"){
            $Messages=new MessageCollection(Message::where("receiver_id",Auth::user()->id)->where("favorite",1)->get());
           
            return $this->Success($Messages);
        }
        else{
            return $this->Error('',"Invalid type",400);
        }
    }
    public function store($username,StoreMessageRequest $request){
        if(!User::where("username",$username)->exists()){
            return $this->Error('',"User not found",404);
        }
        $Message["receiver_id"]=User::where("username",$username)->first()->id;
        if(!$request->anonymous){
            $Token=PersonalAccessToken::findToken(request()->bearerToken());
            
            if(request()->bearerToken()==null){
                
                return $this->Error('',"You must be logged in to send an unanonymous message",401);
            }
            $user=$Token->tokenable;
            $Message["sender_id"]=$user->id;
            
        }
        $Message['content']=$request->content;
        if(request()->hasFile('image')){
            $Message["image"]=StoreImage($request->file('image'),'MessageImages');
        }
        
      
        $Message=new MessageResource(Message::create( $Message));
        return $this->Success([
            "message"=> $Message
        ]);
    }
    public function show(Message $Message){
        
        if($Message->receiver_id!=Auth::user()->id&& $Message->sender_id!=Auth::user()->id){
            return $this->Error('',"You are not authorized to view this message",401);
        }
        $Message=new MessageResource($Message);
        if($Message->sender_id==Auth::user()->id){
           
            return $this->Success($Message,'you mustn\'t show favorite value');
        }
    
        return $this->Success($Message);
    }
    public function Favorite(Message $Message){
      
        if  ($Message->receiver_id!=Auth::user()->id){
            return $this->Error('',"You are not authorized to favorite this message",401);
        }
        
        $Message->favorite=!$Message->favorite;
        $Message->save();
       
        $Message=new MessageResource($Message);
        return $this->Success([
            "message"=> $Message
        ],"Message favorited successfully");
    }
    public function delete(Message $Message){
        // dd($Message);
        if(($Message->receiver_id!=Auth::user()->id) && ( $Message->sender_id!=Auth::user()->id)){
            return $this->Error('',"You are not authorized to delete this message",401);
        }
        $Message->delete();
        return $this->Success('',"Message deleted successfully");
    }
}
