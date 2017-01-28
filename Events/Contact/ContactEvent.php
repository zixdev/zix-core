<?php

namespace Zix\Core\Events\Contact;

use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Zix\Core\Entities\Contact\Contact;

class ContactEvent
{
    use InteractsWithSockets, SerializesModels;
    /**
     * @var Contact
     */
    private $contact;

    /**
     * Create a new event instance.
     *
     * @param Contact $contact
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
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
