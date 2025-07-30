<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Stevebauman\Location\Facades\Location;

class LoginNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $Message;
    public $Subject;
    public $FromEmail;
    public $Mailer;
    public $Location;

    /**
     * Create a new notification instance.
     */
  public function __construct($locationInfo)
{
    $this->Message = "You have successfully logged in";
    $this->Subject = "Login Notification";
    $this->FromEmail = "Test@yousef.com";
    $this->Mailer = 'smtp';
    $this->Location = $locationInfo;
    
}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
  
        
        
        $Message = $this->Message. " from Location:\n" ;
        

        $UserName = $notifiable->name ?? 'User';
        return (new MailMessage)
            ->mailer('smtp')
            ->subject($this->Subject)
            ->greeting('Hello '. $UserName)
            ->line($Message)
            ->line("IP: " . ($this->Location['Ip']))
            ->line("CityName: " . ($this->Location['CityName']))
            ->line("RegionName: " . ($this->Location['RegionName']))
            ->line("CountryName: " . ($this->Location['CountryName']))
            ->line( "At: ".now());
           
            
            
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
