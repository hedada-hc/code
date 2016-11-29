<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function activities(){
        return $this->belongsToMany('App\Models\Activity');
    }

    public function positions(){
        return $this->belongsToMany('App\Models\Position');
    }

    public function two_hour_volume(){
        return $this->hasOne('App\Models\TwoHourVolume', 'item_id', 'item_id');
    }
}
