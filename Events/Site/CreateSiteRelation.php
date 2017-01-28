<?php

namespace Zix\Core\Events\Site;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CreateSiteRelation
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
        $sites = collect($request->get('sites'))->map(function ($site) {
            return $site['id'];
        })->toArray();
        $model->sites()->sync($sites);
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
