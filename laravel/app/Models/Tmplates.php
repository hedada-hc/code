<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tmplates extends Model
{
	protected $table = "Tmplates";
    protected $fillable = ['name',  'content'];
}
