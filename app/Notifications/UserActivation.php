<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserActivation extends Notification implements ShouldQueue
{
    use Queueable;
    protected $user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if ($this->user->active) {
            return (new MailMessage)
                ->subject('User activated')
                ->from('post@rtamediahub.com', 'RTA Media Hub')
                ->greeting('Hi ' . $this->user->name . ',')
                ->line('Thank you for registering with RTA Media Hub. Your account is now activated and ready to use.')
                ->line('Please visit RTA Media Hub to upload/download media.')
                ->action('Visit RTA Media Hub', url('/'));
        } else {
            return (new MailMessage)
                ->subject('User de-activated / blocked')
                ->from('post@rtamediahub.com', 'RTA Media Hub')
                ->greeting('Hi ' . $this->user->name . ',')
                ->line('Your account has been de-activated or blocked. Please contact RTA Media Hub immediately to resolve the issue.');
        }
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
