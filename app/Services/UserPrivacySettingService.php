<?php

namespace App\Services;
use App\Treits\HttpResponses;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserPrivacySettingResource;
use App\Models\UserPrivacySetting;

class UserPrivacySettingService
{
    /**
     * Create a new class instance.
     */
    use HttpResponses;
    public function InitializePrivacySetting(){
        $user = Auth::user();
        UserPrivacySetting::create([
            'user_id'=> $user->id,
        ]);
    }
    public function Show(){
        $user = Auth::user();
        $Setting = UserPrivacySetting::where('user_id', $user->id)->first();
        $Setting= UserPrivacySettingResource::make($Setting);
        return $this->Success($Setting);
    }
    public function Update($request){
        $user = Auth::user();
        $Setting = UserPrivacySetting::where('user_id', $user->id)->first();
        $Setting->update($request->validated());
        $Setting= UserPrivacySettingResource::make($Setting);
        return $this->Success($Setting);
    }
}
