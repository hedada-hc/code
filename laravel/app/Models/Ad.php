<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    public function ad_positions(){
        return $this->belongsTo('App\Models\AdPosition');
    }
}
