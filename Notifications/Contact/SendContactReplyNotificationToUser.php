<?php

namespace Zix\Core\Notifications\Contact;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Zix\Core\Entities\Contact\ContactReply;

class SendContactReplyNotificationToUser extends Notification
{
    use Queueable;
    /**
     * @var ContactReply
     */
    private $reply;

    /**
     * Create a new notification instance.
     *
     * @param ContactReply $reply
     */
    public function __construct(ContactReply $reply)
    {
        $this->reply = $reply;
    }

    /**
     * Get the notification channels.
     *
     * @param  mixed  $notifiable
     * @return array|string ['mail', 'database', 'slack', 'nexmo']
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
            ->from(config('forms.contact.from.email'), config('forms.contact.from.name'))
            ->subject($this->reply->subject)
            ->line($this->reply->message);


    }
}
