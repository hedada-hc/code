<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Cate;
use App\Models\Item;
use App\Models\Position;
use App\Models\ItemPosition;
use Cache;

class ZhuantiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
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

        //获取商品列表
        $top_list = Cache::remember('1111_list', 1, function() {
            $position_item_ids = ItemPosition::where('position_id', 2)->select('item_id')->get();
            $position_item_ids = $position_item_ids->map(function($item){
                return $item['item_id'];
            })->toArray();
            return Item::with('activities')->has('activities')->where('status', 1)->whereIn('id', $position_item_ids)->orderBy('sort', 'desc')->get();
        });

        return view('shuang11.index', compact('item_count', 'cates', 'top_list'));
    }
}
