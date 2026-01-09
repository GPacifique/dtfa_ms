<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AccountVerifiedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Your Account Has Been Verified - ' . config('app.name'))
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('Great news! Your email address has been successfully verified.')
            ->line('Your account is now fully activated and you can access all features of the platform.')
            ->action('Go to Dashboard', url(route('dashboard')))
            ->line('Thank you for being part of ' . config('app.name') . '!')
            ->salutation('Best regards,')
            ->from(config('mail.from.address'), config('mail.from.name'));
    }

    /**
     * Get the array representation of the notification for database storage.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Account Verified',
            'message' => 'Your email address has been successfully verified. Welcome to ' . config('app.name') . '!',
            'type' => 'account_verified',
            'icon' => 'check-circle',
        ];
    }
}
