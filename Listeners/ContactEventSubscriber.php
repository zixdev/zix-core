<?php namespace Zix\Core\Listeners;

use Zix\Core\Events\Contact\ContactReplyEvent;
use Zix\Core\Listeners\Contact\NotifyUserAboutContactReply;

class ContactEventSubscriber
{
    public function subscribe($events) {
        $events->listen(
            ContactReplyEvent::class,
            NotifyUserAboutContactReply::class
        );
    }

}