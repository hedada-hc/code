<?php
namespace App\Admin\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Curl;
//面板表单
use Encore\Admin\Form;
//表格
use Encore\Admin\Grid;
class CurlController extends Controller{
 		
 		public function index(){
 			return Admin::content(function(Content $content){
 				$content->header("curl采集测试");
 			});
 		}
}