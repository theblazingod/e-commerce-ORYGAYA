<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable; 
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $token;

public function __construct($token)
{
    $this->token = $token;
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

public function toMail($notifiable)
{
    $url = url(route('password.reset', [
        'token' => $this->token,
        'email' => $notifiable->getEmailForPasswordReset(),
    ], false));

    return (new MailMessage)
        ->subject('Pemberitahuan Pengaturan Ulang Kata Sandi')
        ->markdown('emails.reset-password', [
            'url' => $url,
            'expire' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire'),
            'appName' => config('app.name'),
        ]);
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
