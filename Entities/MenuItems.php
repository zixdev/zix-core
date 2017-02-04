<?php

namespace Zix\Core\Entities;

use Illuminate\Database\Eloquent\Model;

class MenuItems extends Model
{
    public function childrens()
    {
        return $this->hasMany(MenuItems::class, 'parent_id');
    }
}
