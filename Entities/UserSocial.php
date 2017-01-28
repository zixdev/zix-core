<?php

namespace Zix\Core\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserSocial
 * @package Zix\Core\Entities
 */
class UserSocial extends Model
{
    protected $fillable = ['token', 'type', 'email'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
