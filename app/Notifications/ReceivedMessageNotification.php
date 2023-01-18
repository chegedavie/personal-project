<?php

namespace App\Notifications;

use App\Models\ReceivedMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Blog;

class ReceivedMessageNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $receivedMessage;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(ReceivedMessage $message)
    {
        $this->receivedMessage=$message->withoutRelations();
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
        ->subject($this->receivedMessage->subject)
        ->from('chegenganga2@gmail.com', 'David Chege')
        ->greeting('Greetings!')
                    ->line('Hi, '.$this->receivedMessage->firstname)
                    ->line('Thank you for sending me a message. I will get back to you ASAP. I am always excited when people interested in my work write me. In the meanwhile, kindly check out my blog.')
                    ->action('Back to blog', url('http://localhost:3000/blog'))
                    ->line('Thank you for sending me a message!');
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
            'name'=>$this->receivedMessage->firstname.' '.$this->receivedMessage->lastname,
            'email'=>$this->receivedMessage->email,
            'subject'=>$this->receivedMessage->subject,
            'message'=>$this->receivedMessage->message,
        ];
    }
}
