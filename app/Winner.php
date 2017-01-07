<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Winner extends Model
{
   protected $table = 'auctionwinners';


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}