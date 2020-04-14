<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewMediaUploaded extends Notification implements ShouldQueue
{
    use Queueable;
    protected $post;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($post)
    {
        $this->post = $post;
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
        return (new MailMessage)
            ->subject('New Media uploaded')
            ->from('post@rtamediahub.com', 'RTA Media Hub')
            ->greeting('Hi,')
            ->line('A new media has been uploaded to RTA Media Hub.')
            ->line('<strong>Headline: ' . $this->post->headline . '</strong>')
            ->line('<strong>Category: ' . $this->post->category->name . '</strong>')
            ->line('<strong>Tags: ' . $this->post->tags . '</strong>')
            ->action('Check it out', url('/'));
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
