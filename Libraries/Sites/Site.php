<?php namespace Zix\Core\Libraries\Sites;

use Exception;
use Illuminate\Http\Request;
use Zix\Core\Libraries\Sites\Traits\SiteUiTrait;
use Zix\Core\Entities\Site as SiteModel;
class Site
{
    use SiteUiTrait;

    protected $site;
    /**
     * Site constructor.
     */
    public function __construct()
    {
        $this->site = $this->current();
    }

    /*
     * TODO:: should be cached
     */
    public function current()
    {
        // if no site header in the request get the site by url
        if($site = SiteModel::where('url', url('/').'/')->Orwhere('url', url('/'))->first())
        {
            return $site;
        }

        // if no site from the request site & from the url return the default client site.
        return false;
    }

    public function getAll()
    {
        return SiteModel::all(); // TODO it should only get latest enabled websites.
    }

    public function get($id)
    {
        $this->site = SiteModel::find($id);
        return $this;
    }

    /**
     * @return string
     */
    public function handleMissingRoute()
    {
        if(site() && site()->uis()->count())
            return app()->make('Illuminate\Routing\ResponseFactory')->view('zexus.master-'.site()->activeUi()->type);
        return app()->make('Illuminate\Routing\ResponseFactory')->view('zexus.install-ui');
    }






}