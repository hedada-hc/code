<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Foundations\OpenSearch;
use App\Models\Item;
use App\Models\Cate;
use Cache;
use DB;
use FilterManager;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchController extends Controller
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

        $opensearch = new OpenSearch();
        $search_obj = $opensearch->connect();

        $search_obj->addFilter('status=1');

        if(Request()->input('q')){
            //判断输入的是不是链接
            if(filter_var(trim(Request()->input('q')), FILTER_VALIDATE_URL)){
                $search_obj->addFilter('item_id='.get_params(urldecode(Request()->input('q')), 'id'));
            }else{
                $search_obj->setQueryString("default:".str_replace(' ', '', Request()->input('q')));
            }
        }else{
            abort(404);
        }

        if(Request()->input('cid')){
            $search_obj->addFilter('cate_id='.Request()->input('cid'));
        }

        if(Request()->input('sort')){
            switch(Request()->input('sort')){
                case 'volume':
                    $search_obj->addSort('volume', '-');
                    break;
                case 'price_asc':
                    $search_obj->addSort('price', '+');
                    break;
                case 'price_desc':
                    $search_obj->addSort('price', '-');
                    break;
                case 'commission_rate_asc':
                    $search_obj->addSort('commission_rate', '+');
                    break;
                case 'commission_rate_desc':
                    $search_obj->addSort('commission_rate', '-');
                    break;
            }
        }

        if(Request()->input('is_tmall')){
            $search_obj->addFilter('shop_type=1');
        }

        if(Request()->input('volume_start')){
            $search_obj->addFilter('volume>='.Request()->input('volume_start'));
        }

        if(Request()->input('commission_rate')){
            $commission_rate = explode('-', Request()->input('commission_rate'));
            if($commission_rate[0] > 0){
                $search_obj->addFilter('commission_rate>='.$commission_rate[0]);
            }
            if($commission_rate[1] > 0){
                $search_obj->addFilter('commission_rate<='.$commission_rate[1]);
            }
        }

        if(Request()->input('price')){
            $price = explode('-', Request()->input('price'));//dd($price);
            if($price[0] > 0){
                $search_obj->addFilter('price>='.$price[0]);
            }
            if($price[1] > 0){
                $search_obj->addFilter('price<='.$price[1]);
            }
        }

        //设置分页
        $page = Request()->input('page') > 0 ? Request()->input('page') : '1';
        $search_obj->setStartHit(($page - 1) * 100);
        $search_obj->setHits(100);

        $json = $search_obj->search();
        // 将json类型字符串解码
        $result = json_decode($json, true);
        //如果结果不为空
        if($result['status'] == 'OK' && $result['result']['total'] > 0 && $result['result']['items']){
            $result_ids = $result['result']['items'];
            $ids = [];
            foreach($result_ids as $id){
                $ids[] = $id['id'];
            }
            $referenceIdsStr = implode(',', $ids);
            $search_list = Item::with('activities')->has('activities')->where('status', 1)->whereIn('id', $ids)->orderByRaw(DB::raw("FIELD(id, $referenceIdsStr)"))->get();
            $search_list->is_empty = false;
            
            //获取当前页
            $currentPage = LengthAwarePaginator::resolveCurrentPage();

            //每页显示几个
            $perPage = 100;

            //Create our paginator and pass it to the view
            $paginatedSearchResults = new LengthAwarePaginator(null , $result['result']['total'], $perPage, $currentPage, [
                'path' => '/search'
            ]);

            $paginate = $paginatedSearchResults->appends([
                'sort' => Request()->input('sort'),
                'price' => Request()->input('price'),
                'commission_rate' => Request()->input('commission_rate'),
                'volume_start' => Request()->input('volume_start'),
                'is_tmall' => Request()->input('is_tmall'),
                'q' => Request()->input('q'),
            ])->render();
        }else{
            //未搜索到任何商品
            $search_list = Item::with('activities')->has('activities')->where('sort', '>', 1)->take(100)->get();
            $paginate = '';
            $search_list->is_empty = true;
        } 
        
        return view('search.index', compact('item_count', 'cates', 'search_list', 'paginate'));
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
