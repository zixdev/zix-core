<?php

namespace Zix\Core\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Zix\Core\Events\Contact\ContactEvent;
use Zix\Core\Listeners\Contact\NotifyAdmin;
use Zix\Core\Listeners\Contact\NotifyUser;
use Zix\Core\Listeners\Contact\NotifyUserAboutContactReply;
use Zix\Core\Listeners\ContactEventSubscriber;
use Zix\Core\Listeners\UserEventSubscriber;

class EventListenersProvider extends ServiceProvider
{

    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $subscribe = [
        UserEventSubscriber::class,
        ContactEventSubscriber::class
    ];


    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }

}
