<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Cate;
use App\Models\Item;
use App\Models\TwoHourVolume;
use Cache;
use DB;

class TopController extends Controller
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
        
        //获取两小时销量排名前100的商品ID,因为部分商品可能已失效，所以取150条
        $item_ids = Cache::remember('two_hour_volume_ids', 3,function(){
            return TwoHourVolume::where('expire_time', '>', date('Y-m-d H:i:s'))->orderBy('two_hour_volume', 'desc')->select('item_id')->take(150)->get()->map(function($value){
                return $value['item_id'];
            })->toArray();
        });

        //采集服务器故障可能没有正常工作，宕机时从缓存中获取旧数据
        if(count($item_ids) < 100){
            $top_list = Cache::get('top_list_forever');
        }else{
            $query = Item::with('activities')->has('activities')->with('two_hour_volume')->where('status', 1);

            $top_list = Cache::remember('top_list', 3, function() use($query ,$item_ids){
                $referenceIdsStr = implode(',', $item_ids);
                return $query->whereIn('item_id', $item_ids)->orderByRaw(DB::raw("FIELD(item_id, $referenceIdsStr)"))->take(100)->get();
            });

            Cache::forever('top_list_forever', $top_list);
        }

        return view('top100.index', compact('item_count', 'cates', 'top_list'));
    }
}
