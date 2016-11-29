<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Ad;

use App\Models\Article;

use App\Models\Item;

use App\Models\Position;

use App\Models\Cate;

use App\Models\ItemPosition;

use Cache;

use DB;

use Auth;

class IndexController extends Controller
{
    public function index(){
        //防止cc攻击
        if(Request()->input('page') > 100){
            return '';
        }
        
        //获取banner信息
        $ad_list = Cache::remember('ad_list', 1, function() {
            return Ad::where('status', 1)->orderBy('sort', 'asc')->get();
        });

        //获取新闻信息
        $news_list = Cache::remember('news_list', 1, function() {
            for($i = 1;$i <= 3; $i++){
                $news_list[$i] = Article::where('article_cate_id', $i)->where('status', 1)->orderBy('sort', 'asc')->take(4)->get(); 
            }
            return $news_list;
        });

        //获取所有宝贝的数量
        $item_count = Cache::remember('item_count', 1, function(){
            return Item::has('activities')->where('status' ,1)->count();
        });

        //获取所有的分类信息,并缓存10分钟
        $cates = Cache::remember('cates', 1, function(){
            $cates = Cate::orderBy('sort', 'asc')->get();
            $cates->map(function($item, $key){
                //获取该分类的宝贝数量
                return $item->count = Item::has('activities')->where('cate_id', $item->id)->count();
            });
            return $cates;
        });

        //获取今日推荐
        $position_list = Cache::remember('position_list', 1, function() {
            $position_item_ids = ItemPosition::where('position_id', 1)->select('item_id')->get();
            $position_item_ids = $position_item_ids->map(function($item){
                return $item['item_id'];
            })->toArray();
            return Item::with('activities')->has('activities')->where('status', 1)->whereIn('id', $position_item_ids)->orderBy('sort', 'desc')->take(4)->get();
        });

        //获取首页的商品
        if(Request()->input('page')){
            $home_list = Item::with('activities')->has('activities')->where('status', 1)->orderBy('id', 'desc')->paginate(100);
        }else{
            $home_list = Cache::remember('home_list', 1, function(){
                return Item::with('activities')->has('activities')->where('status', 1)->orderBy('id', 'desc')->paginate(100);
            });
        }
        
        return view('index.index', compact('ad_list', 'news_list', 'position_list', 'home_list', 'cates', 'item_count'));
    }
}
