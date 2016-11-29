<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
//商品纠错模型
class GoodsError extends Model{
	protected $table = "goods_error";
	protected $fillable = ['error_type','goods_id','depict','qq'];
}