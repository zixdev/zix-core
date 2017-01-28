<?php

namespace Zix\Core\Http\Controllers\Site;

use Illuminate\Http\Request;
use Zix\Core\Entities\Site;
use Zix\Core\Http\Requests\Site\SiteCreateRequest;
use Zix\Core\Http\Requests\Site\SiteUpdateRequest;
use Zix\Core\Support\Traits\ApiResponses;
use Zix\Core\Support\Traits\CrudControllerTrait;

/**
 * Class SiteController
 * @package Zix\Core\Http\Controllers\Site
 * @resource Manage Sites
 */
class SiteController
{
    use ApiResponses, CrudControllerTrait;

    /**
     * SiteController constructor.
     * @param Site $model
     */
    public function __construct(Site $model)
    {
        $this->model = $model;
    }


    /**
     * Create Site
     *
     * @param SiteCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SiteCreateRequest $request)
    {
        return $this->respondDataCreated($this->model->create($request->all()));
    }

    /**
     * Get Site
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->respondWithData($this->model->findOrfail($id));
    }

    /**
     * Update Site
     *
     * @param SiteUpdateRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(SiteUpdateRequest $request, $id)
    {
        return $this->respondRequestAccepted($this->model->find($id)->update($request->all()));
    }

}