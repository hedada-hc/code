<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Cate;
use App\Models\Item;
use Cache;

class CateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
        //防止cc攻击
        if(Request()->input('page') > 100){
            return '';
        }

        //查找类目是否存在，不存在直接报错
        $cate_info = Cache::remember('cate:'.$id, 1, function() use($id){
            return Cate::where('id', $id)->firstOrFail();
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

        //条件筛选
        $query = Item::with('activities')->has('activities')->where('status', 1)->where('cate_id', $id);
        if(Request()->input('sort')){
            switch(Request()->input('sort')){
                case 'volume':
                    $query = $query->orderBy('volume', 'desc');
                    break;
                case 'commission_rate_asc':
                    $query = $query->orderBy('commission_rate', 'asc');
                    break;
                case 'commission_rate_desc':
                    $query = $query->orderBy('commission_rate', 'desc');
                    break;
                case 'price_asc':
                    $query = $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query = $query->orderBy('price', 'desc');
                    break;
            }            
        }else{
            $query = $query->orderBy('sort', 'desc');
        }

        if(Request()->input('is_tmall') == 1){
            $query = $query->where('shop_type', 1);
        }

        if(Request()->input('volume_start') > 0){
            $query = $query->where('volume', '>=', Request()->input('volume_start'));
        }

        if(Request()->input('commission_rate')){
            $commission_rate = explode('-', Request()->input('commission_rate'));
            if($commission_rate[0]){
                $query = $query->where('commission_rate', '>=', $commission_rate[0]);
            }
            if($commission_rate[1]){
                $query = $query->where('commission_rate', '<=', $commission_rate[1]);
            }
        }

        if(Request()->input('price')){
            $price = explode('-', Request()->input('price'));
            if($price[0]){
                $query = $query->where('price', '>=', $price[0]);
            }
            if($price[1]){
                $query = $query->where('price', '<=', $price[1]);
            }
        }

        //dd(Item::remember(1)->where('id', 1)->get());
        $cate_list = $query->orderBy('id', 'desc')->paginate(100);

        return view('cate.show', compact('cate_info', 'item_count', 'cates', 'cate_list'));
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
