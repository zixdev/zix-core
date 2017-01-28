<?php

namespace Zix\Core\Entities\Forms;

use Illuminate\Database\Eloquent\Model;

class FormResponseField extends Model
{
    protected $fillable = ['value', 'form_field_id'];
}
