<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
//采集模型
class Curl extends Model{
	protected $table="curl";
	public $timestamps=false;
	protected $fillable = ['titles', 'urls','times','content'];
}