<?php

namespace Zix\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Zix\Core\Helpers\Traits\Model\HasFiltrableTrait;
use Zix\Core\Helpers\Traits\Model\HasSeoTrait;
use Zix\Core\Helpers\Traits\Model\HasStatusTrait;
use Zix\Core\Libraries\Sites\Traits\HasMultiSitesTrait;

/**
 * Class Site
 * @package Zix\Core\Entities
 */
class Site extends Model
{
    use HasMultiSitesTrait, HasStatusTrait, SoftDeletes, HasFiltrableTrait, HasSeoTrait;

    /**
     * @var array
     */
    protected $fillable = ['name', 'url', 'ui', 'status'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function uis()
    {
        return $this->hasMany(SiteUi::class);
    }

    /**
     * @param null $name
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function config($name = null)
    {
        if($name)
            return $this->hasMany(SiteConfig::class)->where('key', $name)->enabled()->first();
        return $this->hasMany(SiteConfig::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pages()
    {
        return $this->belongsToMany(Page::class);
    }

    /**
     * @param $view
     * @param array $data
     * @param array $headers
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view($view, $data = [], $headers = [])
    {
        if(view()->exists(str_replace('::', '.', sprintf($view, $this->ui)))) {
            return view(str_replace('::', '.', sprintf($view, $this->ui)), $data, $headers);
        }
        if(view()->exists(sprintf($view, $this->ui))) {
            return view(sprintf($view, $this->ui), $data, $headers);
        }
        return view(sprintf($view, 'default'), $data, $headers);
    }
    public function partial($view)
    {
        if(view()->exists(str_replace('::', '.', sprintf($view, $this->ui)))) {
            return str_replace('::', '.', sprintf($view, $this->ui));
        }
        if(view()->exists(sprintf($view, $this->ui))) {
            return sprintf($view, $this->ui);
        }
        return sprintf($view, 'default');
    }
}
