<?php

namespace Zix\Core\Http\Controllers\Pages;

use Illuminate\Http\Request;
use Zix\Core\Events\Seo\CreateSeoRelation;
use Zix\Core\Events\Seo\UpdateSeoRelation;
use Zix\Core\Events\Site\CreateSiteRelation;
use Zix\Core\Http\Requests\Pages\UpdatePageRequest;
use Zix\Core\Support\Traits\CrudControllerTrait;
use Zix\Core\Entities\Page;
use Zix\Core\Http\Requests\Pages\CreatePageRequest;
use Zix\Core\Support\Traits\ApiResponses;

/**
 * Class ManagePageController
 * @package Zix\Core\Http\Controllers\Pages
 * @resource Manage Pages
 */
class ManagePageController
{
    use ApiResponses, CrudControllerTrait;

    /**
     * PageController constructor.
     * @param Page $model
     */
    public function __construct(Page $model)
    {
        $this->model = $model;
    }

    /**
     * Create Page
     *
     * @param CreatePageRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePageRequest $request)
    {
        $page = $this->model->create($request->all());

        event(new CreateSeoRelation($page, $request));
        event(new CreateSiteRelation($page, $request));

        return $this->respondDataCreated($page);
    }

    /**
     * Get Page
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->respondWithData($this->model->with(['sites', 'seo'])->find($id));
    }

    /**
     * Update Page
     * @param UpdatePageRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdatePageRequest $request, $id)
    {
        $model = $this->model->find($id);
        event(new CreateSiteRelation($model, $request));
        event(new UpdateSeoRelation($model, $request));
        return $this->respondRequestAccepted($model->update($request->all()));
    }


}