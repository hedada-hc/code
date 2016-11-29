<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pid extends Model
{
    protected $fillable = ['user_id', 'name', 'common_pid', 'queqiao_pid'];
}
