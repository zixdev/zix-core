<?php

namespace Zix\Core\Entities;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name',
        'phone_number', 'mobile_number',
        'address_line_1', 'address_line_2',
        'subrub', 'post_code', 'state', 'country'
    ];
}
