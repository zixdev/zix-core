<?php

namespace Zix\Core\Entities\Contact;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ContactReply
 * @package Zix\Core\Entities\Contact
 */
class ContactReply extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['subject', 'message', 'user_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
