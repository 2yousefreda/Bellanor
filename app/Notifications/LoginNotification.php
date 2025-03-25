<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LoginNotification extends Notification
{
    use Queueable;
    public $Message;
    public $Subject;
    public $FromEmail;
    public $Mailer;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        $this->Message = "You have successfully logged in";
        $this->Subject = "hi";
        $this->FromEmail = "Test@yousef.com";
        $this->Mailer = 'smtp';
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
        $ip=request()->ip();
        
        $Message = $this->Message. " from IP: $ip";
        $UserName = $notifiable->name ?? 'User';
        return (new MailMessage)
            ->mailer('smtp')
            ->subject($this->Subject)
            ->greeting('Hello '. $UserName)
            ->line($this->Message);
            // ->action('Notification Action', url('/'))
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
