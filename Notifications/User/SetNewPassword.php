<?php namespace Zix\Core\Notifications\User;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class SetNewPassword extends Notification
{
    use Queueable;
    /**
     * @var User
     */
    private $user;
    /**
     * @var
     */
    private $password;

    /**
     * Create a new notification instance.
     *
     * @param User $user
     * @param $password
     */
    public function __construct($user, $password)
    {
        $this->user = $user;
        $this->password = $password;
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
     * Get the notification message.
     *
     * @return void
     */
    public function message()
    {
//        $this->line('The introduction to the notification.')
//            ->action('Notification Action', 'https://laravel.com')
//            ->line('Thank you for using our application!');
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
            ->greeting('Hello, ' . $this->user->username)
            ->line('To get you started, we have set a temporary password for you "' . $this->password . '"')
            ->line('To edit it please click the link below.')
            ->action('Edit Password', url('auth/account/password/'. $this->user->active_code))

            ->line('Thank you for using our application!');

    }
}