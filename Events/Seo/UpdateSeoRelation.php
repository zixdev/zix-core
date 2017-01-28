<?php

namespace Zix\Core\Events\Seo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;

class UpdateSeoRelation
{
    use InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @param Model $model
     * @param Request $request
     */
    public function __construct(Model $model, Request $request)
    {
        $model->seo->update([
            'title'          =>  $request->get('seo')['title'],
            'keywords'       =>  $request->get('seo')['keywords'],
            'description'    =>  $request->get('seo')['description']
        ]);
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
