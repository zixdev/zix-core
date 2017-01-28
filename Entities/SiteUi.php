<?php

namespace Zix\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Zix\Core\Helpers\Traits\Model\HasFiltrableTrait;
use Zix\Core\Helpers\Traits\Model\HasStatusTrait;

class SiteUi extends Model
{
    use HasStatusTrait, SoftDeletes, HasFiltrableTrait;
    /**
     * @var array
     */
    protected $fillable = ['scripts', 'code_size', 'assets_size', 'version', 'type', 'html'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
