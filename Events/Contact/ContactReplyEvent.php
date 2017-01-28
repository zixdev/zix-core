<?php

namespace Zix\Core\Events\Contact;

use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Zix\Core\Entities\Contact\Contact;
use Zix\Core\Entities\Contact\ContactReply;

/**
 * Class ContactReplyEvent
 * @package Zix\Core\Events\Contact
 */
class ContactReplyEvent
{
    use InteractsWithSockets, SerializesModels;
    /**
     * @var Contact
     */
    public $contact;
    /**
     * @var ContactReply
     */
    public $reply;

    /**
     * Create a new event instance.
     *
     * @param Contact $contact
     * @param ContactReply $reply
     */
    public function __construct(Contact $contact, ContactReply $reply)
    {
        $this->contact = $contact;
        $this->reply = $reply;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
