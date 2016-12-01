<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Luck extends Model
{
	protected $table = "luck";
    protected $fillable=["num1","num2","num3","total","time","status"];
}
