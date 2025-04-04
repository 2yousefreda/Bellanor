<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPrivacySetting extends Model
{
    protected $fillable = [
        'user_id',
        'isAllowedMessage',
        'acceptImage',
        'allowUnRegisteredToSendMessage',
        'allowToReceiveEmailNotifications'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    
}
