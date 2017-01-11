<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
