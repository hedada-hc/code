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

class MyTopController extends Controller
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
        
        //取自己的商品ID
        $my_ids = Item::with('activities')->has('activities')->where('status', 1)->where('sort', '>', 1)->select('item_id')->get()->map(function($value){
            return $value['item_id'];
        })->toArray();;

        $item_ids = TwoHourVolume::where('expire_time', '>', date('1900-00-00 H:i:s'))->whereIn('item_id', $my_ids)->orderBy('two_hour_volume', 'desc')->select('item_id')->take(1000)->get()->map(function($value){
            return $value['item_id'];
        })->toArray();

        $query = Item::with('activities')->has('activities')->where('status', 1);

        $top_list = Cache::remember('my_top_list', 1, function() use($query ,$item_ids){
            $referenceIdsStr = implode(',', $item_ids);
            return $query->whereIn('item_id', $item_ids)->orderByRaw(DB::raw("FIELD(item_id, $referenceIdsStr)"))->take(1000)->get();
        });

        return view('top100.myindex', compact('item_count', 'cates', 'top_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
