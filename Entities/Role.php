<?php

namespace Zix\Core\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Role as SpatieRole;
use Zix\Core\Helpers\Traits\Model\HasFiltrableTrait;

class Role extends SpatieRole
{
    use SoftDeletes, HasFiltrableTrait;
}
