<?php namespace Zix\Core\Listeners;

use Illuminate\Notifications\Notifiable;
use Zix\Core\Events\User\UserRegistered;
use Zix\Core\Notifications\User\ActivateYourEmail;

class UserEventSubscriber
{
    use Notifiable;
    /**
     * Handle user login events.
     * @param $event
     */
    public function onUserLogin($event) {}

    /**
     * Handle user logout events.
     * @param $event
     */
    public function onUserLogout($event) {}

    /**
     * Handle user register events.
     * @param $event
     */
    public function onUserRegister(UserRegistered $event) {
        $event->user->notify(new ActivateYourEmail($event->user));
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Illuminate\Auth\Events\Login',
            'Zix\Core\Listeners\UserEventSubscriber@onUserLogin'
        );

        $events->listen(
            'Illuminate\Auth\Events\Logout',
            'Zix\Core\Listeners\UserEventSubscriber@onUserLogout'
        );

        $events->listen(
            UserRegistered::class,
            'Zix\Core\Listeners\UserEventSubscriber@onUserRegister'
        );
    }
}