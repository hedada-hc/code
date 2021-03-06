<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    public function items(){
        return $this->belongsToMany('App\Models\Item');
    }
}
