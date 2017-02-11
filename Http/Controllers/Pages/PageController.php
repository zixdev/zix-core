<?php

namespace Zix\Core\Http\Controllers\Pages;

use Zix\Core\Entities\Page;
use Zix\Core\Helpers\Traits\Controllers\HasSEOTrait;
use Zix\Core\Support\Traits\ApiResponses;

/**
 * Class PageController
 * @package Zix\Core\Http\Controllers\Pages
 * @resource Pages
 */
class PageController
{
    use ApiResponses, HasSEOTrait;

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
        $page = $this->model->with(['sites', 'seo'])->where('slug', $slug)->first();
        if($page) {
            $this->seo($page->seo);
            return site()->view('core::%s.pages.index', compact('page'));
        }
        return view('errors.404');
    }
}