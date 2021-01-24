<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['name', 'description', 'date_of_completion', 'intermediary_percentage', 'status', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
