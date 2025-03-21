<?php

namespace App\Http\Controllers;
use App\Http\Resources\MessageCollection;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(){
        return new MessageCollection(Message::all());
    }
}
