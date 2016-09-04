<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Ticket;
use App\User;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ticket_id', 'user_id', 'comment'
    ];

    /**
     * Relation one to many, a comment belongs to a Ticket
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    /**
     * A comment belongs to a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
