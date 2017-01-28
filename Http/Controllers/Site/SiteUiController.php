<?php

namespace Zix\Core\Http\Controllers\Site;

use Illuminate\Http\Request;
use ZipArchive;
use Zix\Core\Entities\Site;
use Zix\Core\Http\Requests\Site\SiteUploadVersionRequest;
use Zix\Core\Support\Traits\ApiResponses;
use Zix\Core\Support\Traits\CrudControllerTrait;

/**
 * Class SiteUiController
 * @package Zix\Core\Http\Controllers\Site
 * @resource Manage Sites
 */
class SiteUiController
{
    use ApiResponses, CrudControllerTrait;
    /**
     * @var Site
     */
    private $site;

    /**
     * SiteController constructor.
     * @param Site $site
     */
    public function __construct(Site $site)
    {
        $this->site = $site;
    }

    /**
     * Get Site Themes
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
//        return $this->respondBadRequest('fuck you');
        if($request->get('eloquent') == 'trashed')
        {
            return \Datatables::of($this->site->findOrFail($id)->uis()->onlyTrashed())->make(true);
        }

        return \Datatables::of($this->site->findOrFail($id)->uis()->get())->make(true);
    }

    /**
     * Upload Site Theme
     *
     * @param  SiteUploadVersionRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function store(SiteUploadVersionRequest $request, $id)
    {
        $zip = new ZipArchive;
        $zip->open($request->file('ui'));
        $zip->extractTo(storage_path('tmp/ui/tmp'));

        switch($request->get('type')) {
            case 'vue' : {
                return \Site::get($id)->addSiteVueUiScripts(storage_path('tmp/ui/tmp/dist'));
            }
            case 'angular': {
                return \Site::get($id)->addSiteAngularUiScripts(storage_path('tmp/ui/tmp/public'));
            }
            case 'react': {
                return \Site::get($id)->addSiteReactUiScripts(storage_path('tmp/ui/tmp/public'));
            }
        }
    }
}