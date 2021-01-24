<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $fillable = ['order_id', 'user_id', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
