<?php

namespace App\Notifications;

use App\Models\Course;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EnrollmentNotification extends Notification
{
    use Queueable;
    private $user, $course;
    
    public function __construct(User $user,Course $course)
    {
        $this->user = $user; 
        $this->course = $course;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                            ->subject('Course Enrolled ')
                            ->greeting('Hey '.$notifiable->first_name)
                            ->line('Course Enrolled '. $this->course->title)
                            ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            'To'=>$notifiable->email,
            'From'=>$this->user,
            'message'=>'Mail for Course Enrolled'
        ];
    }
}
