<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\LoginNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Stevebauman\Location\Facades\Location;

class SendLoginNotificationJob implements ShouldQueue
{
   use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

       public $user;
       public $ip;

    /**
     * Create a new job instance.
     */
     public function __construct($user)
    {
        $this->user = $user;
        $this->ip = "156.201.178.90";
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
       $location = Location::get($this->ip);
        
        $locationInfo = [
        "Ip"=>$location->ip,
        "CountryName"=>$location->countryName,
        "RegionName"=>$location->regionName,
        "CityName"=>$location->cityName,
        ];

        $this->user->notify(new LoginNotification($locationInfo));
    }
}
