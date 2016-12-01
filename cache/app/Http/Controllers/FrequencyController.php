<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
//访问频率例子
class FrequencyController extends Controller{
	public function index(){
		$json = "{id:123}{id:456}{id:789}";
		$arr = ['id'=>123,'ids'=>456];
		dd(json_encode($arr));
	}
}