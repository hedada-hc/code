<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WenanTemplate extends Model
{
	protected $table ="wenans";
    protected $fillable = ['qudao',  'pid_id', 'user_id', 'tmplate_id', 'is_default'];

    public function pid(){
        return $this->belongsTo('App\Models\Pid');
    }

    public function test(){
        return $this->belongsTo('App\Models\Tmplates');
    }

    public function tmp_id(){
    	return $this->hasOne('App\Models\Tmplates', 'id','is_default');
    }

    public function tmplate_id(){
    	return $this->hasOne('App\Models\Tmplates', 'id','tmplate_id');
    }
}
