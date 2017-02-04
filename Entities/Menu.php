<?php

namespace Zix\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Zix\Core\Helpers\Traits\Model\HasFiltrableTrait;
use Zix\Core\Helpers\Traits\Model\HasSiteTrait;

class Menu extends Model
{
    use SoftDeletes, HasFiltrableTrait, HasSiteTrait;
    protected $fillable = ['name'];

    public function links()
    {
        return $this->hasMany(MenuItems::class);
    }
}
