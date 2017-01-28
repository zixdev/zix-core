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
}
