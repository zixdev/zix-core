<?php

namespace Zix\Core\Entities;

use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    protected $fillable = ['title', 'description', 'keywords'];
}
