<?php

namespace Zix\Core\Http\Controllers\Contact;

use Zix\Core\Entities\Contact\Contact;
use Zix\Core\Events\Contact\ContactReplyEvent;
use Zix\Core\Http\Requests\Contact\ContactReplyRequest;
use Zix\Core\Notifications\Contact\SendContactReplyNotificationToUser;
use Zix\Core\Support\Traits\ApiResponses;
use Zix\Core\Support\Traits\CrudControllerTrait;

/**
 * Class ManageContactController
 * @package Zix\Core\Http\Controllers\Contact
 * @resource Manage Contact
 */
class ManageContactController
{
    use ApiResponses, CrudControllerTrait;


    /**
     * ManageContactController constructor.
     * @param Contact $model
     */
    public function __construct(Contact $model)
    {
        $this->model = $model;
    }

    /**
     * Send Contact Reply
     * @param ContactReplyRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ContactReplyRequest $request, $id)
    {
        $contact = $this->model->find($id);

        $reply = $contact->replies()->create(
            array_merge($request->input(), ['user_id' => $request->user()->id])
        );

        event(new ContactReplyEvent($contact, $reply));

        return $this->respondDataCreated($contact);
    }
}