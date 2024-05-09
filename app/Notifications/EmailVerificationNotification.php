<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailVerificationNotification extends Notification
{
    use Queueable;
    protected $code;
    /**
     * Create a new notification instance.
     */
    public function __construct($code)
    {
        $this->code = $code;
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

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Verify Email Address')
                    ->line('Dear '.$notifiable->name)
                    ->line('Thank you for signing up with JAMfurniture! We’re excited to have you as part of our community.
                    To complete your registration, please verify your email address by usig the code below:')
                    ->line('')
                    ->line('Verification Code : '.$this->code)
                    ->line('')
                    ->line('If you did not sign up for an account on JAMfurniture, please ignore this email.');
    }

    // public function toMail(object $notifiable): MailMessage
    // {
    //     return (new MailMessage)
    //         ->subject('Verify Email Address')
    //         ->view('emailVerification', ['code' => $this->code, 'name' => $notifiable->name]);
    // }

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
