<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentsItem extends Model
{
    protected $table = 'comments_item';
    const UPDATED_AT = null;
    protected $fillable = [
        'item_id', 'buyer_id','comment'
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Item()
    {
        return $this->belongsTo(Item::class,'item_id');
    }
}
