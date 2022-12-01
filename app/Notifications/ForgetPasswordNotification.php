<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ForgetPasswordNotification extends Notification
{
    use Queueable;


    public function __construct() {

    }

    public function via() {

        return ['mail','database'];
    }

    public function toMail($notifiable) {

        return (new MailMessage)
                    ->subject('Please set a Forget password')
                    ->greeting('Welcome '. $notifiable->first_name)
                    ->action('Forget Password', route('resetpassword.index', $notifiable->slug))
                    ->line('Thank you for using our application!');
    }

    public function toArray($notifiable) {
        
        return [
            'To'=>$notifiable->email,
            'message'=>'Mail for set New password'
        ];
    }
}
