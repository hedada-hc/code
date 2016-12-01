<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pous extends Model
{
    protected $table = "pous";
    protected $fillable=["lid","uid","number","time","status"];
}
