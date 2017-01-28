<?php

namespace Zix\Core\Http\Controllers\Contact;

use Zix\Core\Entities\Contact\Contact;
use Zix\Core\Events\Contact\ContactEvent;
use Zix\Core\Http\Requests\Contact\ContactCreateRequest;
use Zix\Core\Support\Traits\ApiResponses;

class ContactController
{
    use ApiResponses;
    /**
     * @var Contact
     */
    private $model;


    /**
     * ContactController constructor.
     * @param Contact $model
     */
    public function __construct(Contact $model)
    {
        $this->model = $model;
    }

    /**
     * Send Contact Request
     * @param ContactCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ContactCreateRequest $request)
    {
        $contact = $this->model->create($request->input());

        event(new ContactEvent($contact));

        return $this->respondRequestAccepted($contact);
    }
}