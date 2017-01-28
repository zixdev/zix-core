<?php

namespace Zix\Core\Http\Controllers\Pages;


use Zix\Core\Entities\Page;
use Zix\Core\Support\Traits\ApiResponses;

/**
 * Class PageController
 * @package Zix\Core\Http\Controllers\Pages
 * @resource Pages
 */
class PageController
{
    use ApiResponses;

    /**
     * PageController constructor.
     * @param Page $model
     */
    public function __construct(Page $model)
    {
        $this->model = $model;
    }

    /**
     * Get Page (slug)
     * @param $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        return $this->respondWithData($this->model->with(['sites', 'seo'])->where('slug', $slug)->first());
    }
}