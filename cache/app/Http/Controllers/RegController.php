<?php
namespace App\Http\Controllers;
use App\Controllers\Controller;
//注册页面
class RegController extends Controller{
	public function index(){
		return view('reg/reg');
	}
}