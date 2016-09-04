<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'category_id', 'ticket_id', 'title', 'priority', 'message', 'status'
    ];

    /**
     * relation one to many,  a ticket can belong to a category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Category(){
        return $this->belongsTo(Category::class);
    }
}
