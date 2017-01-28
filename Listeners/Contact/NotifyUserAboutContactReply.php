<?php

namespace Zix\Core\Listeners\Contact;


use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Zix\Core\Events\Contact\ContactReplyEvent;
use Zix\Core\Notifications\Contact\SendContactReplyNotificationToUser;

class NotifyUserAboutContactReply implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param ContactReplyEvent $event
     */
    public function handle(ContactReplyEvent $event)
    {
        $event->contact->notify(new SendContactReplyNotificationToUser($event->reply));
        $event->contact->status = true;
        $event->contact->save();
    }



}
