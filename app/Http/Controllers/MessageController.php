<?php

namespace App\Http\Controllers;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMessageRequest;

use App\Services\MessageService;


class MessageController extends Controller
{
   
    protected $MessageService;
    public function __construct(MessageService $MessageService)
    {
        $this->MessageService = $MessageService;
    }
    public function Index(request $request){

        return $this->MessageService->getAllMessages($request);
    }
    public function store($username,StoreMessageRequest $request){
       
        return $this->MessageService->storeMessage($username, $request);
    }
    public function show(Message $Message){

        return $this->MessageService->showMessage($Message);
    }
    public function Favorite(Message $Message){

        return $this->MessageService->addMessageToFavorites($Message);
    }
    public function delete(Message $Message){
        return $this->MessageService->deleteMessage($Message);
    }
}
