<?php

namespace Zix\Core\Entities\Forms;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Zix\Core\Entities\Site;
use Zix\Core\Helpers\Traits\Model\HasFiltrableTrait;
use Zix\Core\Helpers\Traits\Model\HasStatusTrait;

/**
 * Class Form
 * @package Zix\Core\Entities\Forms
 */
class Form extends Model
{
    use HasStatusTrait, SoftDeletes, HasFiltrableTrait;
    /**
     * @var array
     */
    protected $fillable = ['title', 'slug', 'submit_text'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fields()
    {
        return $this->belongsToMany(FormField::class, 'field_to_form');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sites()
    {
        return $this->belongsToMany(Site::class);
    }

    public function responses()
    {
        return $this->hasMany(FormResponse::class);
    }
}
