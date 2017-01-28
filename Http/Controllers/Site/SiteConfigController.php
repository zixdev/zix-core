<?php

namespace Zix\Core\Http\Controllers\Site;

use Illuminate\Http\Request;
use Zix\Core\Entities\Site;
use Zix\Core\Http\Requests\Site\SiteConfigCreateRequest;
use Zix\Core\Support\Traits\ApiResponses;

/**
 * Class SiteConfigController
 * @package Zix\Core\Http\Controllers\Site
 * @resource Manage Sites
 */
class SiteConfigController
{
    use ApiResponses;

    /**
     * @var Site
     */
    private $site;

    /**
     * SiteConfigController constructor.
     * @param Site $site
     */
    public function __construct(Site $site)
    {
        $this->site = $site;
    }


    /**
     * Get Site Configs
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return $this->respondWithData($this->site->find($id)->config);
    }

    /**
     * Create Site Config
     *
     * @param SiteConfigCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function create(SiteConfigCreateRequest $request)
    {
        return $this->respondDataCreated($this->site->config()->create($request->only(['key', 'value'])));
    }

    /**
     * Update Site Config
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $tmp = collect($request->all())->map(function ($value, $key) use ($id) {
            return $this->site->find($id)->config()->updateOrCreate(
                ['key' => $key],
                [
                    'key' => $key,
                    'value' => $value
                ]
            );
        });
        return $this->respondWithData($tmp);
    }

}
