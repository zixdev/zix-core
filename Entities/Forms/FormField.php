<?php

namespace Zix\Core\Entities\Forms;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Zix\Core\Helpers\Traits\Model\HasFiltrableTrait;
use Zix\Core\Helpers\Traits\Model\HasStatusTrait;

/**
 * Class FormField
 * @package Zix\Core\Entities\Forms
 */
class FormField extends Model
{
    use HasStatusTrait, SoftDeletes, HasFiltrableTrait;
    /**
     * @var array
     */
    protected $fillable = [
        'model', 'name', 'label', 'type', 'placeholder'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function forms()
    {
        return $this->belongsToMany(Form::class);
    }

    public function rules()
    {
        return $this->belongsToMany(FormFieldRule::class, 'form_field_to_rule_field');
    }
}
