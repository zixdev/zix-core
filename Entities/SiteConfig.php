<?php

namespace Zix\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Zix\Core\Helpers\Traits\Model\HasStatusTrait;

/**
 * Class SiteConfig
 * @package Zix\Core\Entities
 */
class SiteConfig extends Model
{
    use HasStatusTrait, SoftDeletes;

    protected $fillable = ['key', 'value', 'status'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
