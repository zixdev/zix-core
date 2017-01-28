<?php

namespace Zix\Core\Entities\Forms;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Zix\Core\Entities\Site;
use Zix\Core\Helpers\Traits\Model\HasFiltrableTrait;
use Zix\Core\Helpers\Traits\Model\HasStatusTrait;

/**
 * Class FormResponse
 * @package Zix\Core\Entities\Forms
 */
class FormResponse extends Model
{
    use HasStatusTrait, SoftDeletes, HasFiltrableTrait;
    /**
     * @var array
     */
    protected $fillable = ['identifier', 'site_id', 'viewed', 'responded'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function fields()
    {
        return $this->hasMany(FormResponseField::class);
    }
}
