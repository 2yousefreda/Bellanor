<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Treits\HttpResponses;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserPrivacySettingRequest;
use App\Http\Resources\UserPrivacySettingResource;
use App\Models\UserPrivacySetting;
use App\Services\UserPrivacySettingService;

class UserPrivacySettingController extends Controller
{
   
    protected $UserSettings;

    public function __construct(UserPrivacySettingService $UserSettings)
    {
        $this->UserSettings = $UserSettings;
    }

    protected function InitializePrivacySetting(){
        return $this->UserSettings->InitializePrivacySetting();
    }
    public function Show(){
        return $this->UserSettings->Show();
       
    }
    public function Update(UserPrivacySettingRequest $request){
        return $this->UserSettings->Update($request);
       
    }
}
