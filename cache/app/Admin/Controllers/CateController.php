<?php
namespace App\Admin\Controllers;
use App\Models\Cate;
use App\Models\Curl;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\AdminController;

class CateController extends Controller{
		use AdminController;

		public function index(){
			return Admin::content(function(Content $content){
				$content->header("商品分类");
				$content->description("测试啊。。。");
				$content->body($this->grid());

			});
		}

		public function grid(){
			return Admin::grid(Curl::class,function(Grid $grid){
				$grid->id('id')->sortable();
				$grid->titles('文章标题')->sortable()->editable();
				$grid->urls('链接')->sortable()->editable();
				$grid->times('发布时间')->sortable()->editable();
      
			});
		}


		public function form(){
			return Admin::form(Curl::class,function(Form $form){
				$form->display('id','ID');
				$form->text('titles','分类名称:')->rules('required|max:18');
				$form->textarea('urls','SEO描述:')->rules('max:200');
	            $form->number('times','发布时间:');
			});
		}


}	