<?php

namespace App\Services;

use App\Http\Resources\MessageResource;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;
use App\Treits\HttpResponses;
use App\Notifications\MessageNotification;
use Illuminate\Support\Facades\Http;

class MessageService
{
    /**
     * Create a new class instance.
     */
    use HttpResponses;

    public function getAllMessages(request $request)
    {

        $type = $request->query('type');
        if ($type == null) {
            $type = "received";
        }
        if ($type == "received") {
            $Messages = MessageResource::collection(Message::where("receiver_id", Auth::user()->id)->get());
            return $this->Success($Messages);
        } else if ($type == "sent") {
            $Messages = MessageResource::collection(Message::where("sender_id", Auth::user()->id)->get());
            return $this->Success($Messages);
        } else if ($type == "favorites") {
            $Messages = MessageResource::collection(Message::where("receiver_id", Auth::user()->id)->where("favorite", 1)->get());
            return $this->Success($Messages);
        } else {
            return $this->Error('', "Invalid type", 400);
        }
    }
function isOffensive(string $message): bool
{
    
    $apiKey = env('GEMINI_API_KEY');

    $response = Http::withHeaders([
        'Content-Type' => 'application/json',
        'X-goog-api-key' => $apiKey,
    ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent', [
        'contents' => [
            [
                'parts' => [
                    [
                        'text' => "Is this message offensive, hateful, or contains bad words? Answer only with yes or no:\n\n\"$message\""
                    ]
                ]
            ]
        ]
    ]);
   

    // if (!$response->successful()) {
    //     // Log the error or handle it
    //     \Log::error('Gemini API Error: ' . $response->body());
    //     return false;
    // }

    $text = strtolower($response->json('candidates.0.content.parts.0.text') ?? '');

    return str_contains($text, 'yes');
}
    public function storeMessage($username, $request)
    {
       
       $this->isOffensive($request->content);
        if (!User::where("username", $username)->exists()) {
            return $this->Error('', "User not found", 404);
        }
        $user = User::where("username", $username)->first();
        $Message["receiver_id"] = $user->id;
        if (!$user->PrivacySettings->isAllowedMessage) {
            return $this->Error('', "This user does not allow messages", 401);
        } elseif ($this->isOffensive($request->content)) {
            return $this->Error('', "This message is offensive", 401);
        } elseif (!$user->PrivacySettings->acceptImage && $request->hasFile("image")) {
            return $this->Error('', "This user does not allow images", 401);
        } elseif (!$user->PrivacySettings->allowUnRegisteredToSendMessage && $request->anonymous) {
            return $this->Error('', "This user does not allow anonymous messages", 401);
        }
        if (!$request->anonymous) {
            $Token = PersonalAccessToken::findToken(request()->bearerToken());

            if ($Token == null) {

                return $this->Error('', "You must be logged in to send an unanonymous message", 401);
            }
            $sender = $Token->tokenable;
            $Message["sender_id"] = $sender->id;
            $Message["sender_name"] = $sender->name;
        }
        $Message['content'] = $request->content;
        // dd($user->name,$user->email);
        if (request()->hasFile('image')) {
            $Message["image"] = StoreImage($request->file('image'), 'MessageImages');
        }
        if ($user->PrivacySettings->allowToReceiveEmailNotifications) {

            $user->notify(new MessageNotification($Message));
        }
        $Message = MessageResource::make(Message::create($Message));

        return $this->Success([
            "message content" => $Message
        ]);
    }
    public function showMessage($Message)
    {
        $Message = Message::find($Message);
     
        if (!$Message||($Message->receiver_id != Auth::user()->id && $Message->sender_id != Auth::user()->id)) {
            return $this->Error('', "Message not found", 401);
        }
        $Message = MessageResource::make($Message);
        if ($Message->sender_id == Auth::user()->id) {

            return $this->Success($Message, 'you mustn\'t show favorite value');
        }

        return $this->Success($Message);
    }
    public function addMessageToFavorites($Message)
    {
        $Message = Message::find($Message);
        if (!$Message || ($Message->receiver_id != Auth::user()->id)) {
            return $this->Error('', "message not found", 404);
        }

        $Message->favorite = !$Message->favorite;
        $Message->save();

        $Message = MessageResource::make($Message);
        return $this->Success([
            "message content" => $Message
        ], "Message favorited successfully");
    }
    public function deleteMessage($Message)
    {

        if (($Message->receiver_id != Auth::user()->id) && ($Message->sender_id != Auth::user()->id)) {
            return $this->Error('', "You are not authorized to delete this message", 401);
        }
        $Message->delete();
        return $this->Success('', "Message deleted successfully");
    }
}
