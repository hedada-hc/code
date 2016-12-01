<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Curl;
use Cache;
use Redis;
use Log;

class RegsController extends Controller{
    public function index(Request $request){
    	// dd($this->row());
    	//文件缓存-->写入缓存
    	// $dd = Cache::remember('con',5,function(){
    	// 	return Curl::orderBy('id','DESC')->take(5)->get();
    	// });
    	// dd(Cache::tags('xiha')->get(5));

    	//字符串缓存
    	if(!Redis::exists('cons')){
    		Redis::set('cons',json_encode(Curl::orderBy('times','DESC')->take(100)->get()));
    		$dd = json_decode(Redis::get('cons'));
    		return view('reg/reg',compact('dd'));
    	}
    	//redis 集合缓存
    	if(!Redis::exists('xiha')){
    		$dd = Curl::orderBy('times','DESC')->take(200)->get();
    		foreach ($dd as $key => $value) {
    			Redis::hset('xiha',$value->id,$dd[$key]);
    		}
    		//
    		return view('reg/reg',compact('dd'));
    	}

		$dd = $this->hset(Redis::hgetall('xiha'));
		$dd = array_slice($dd,10,100);
    	return view('reg/reg',compact('dd'));
    }

    /*
	因为从redis取出来的hset集合 第一层是数组但里面的所有内容都是json数据所以我发解析
	采用到了这个转换成数组返回出去供前台调用
    */
    //处理json
    public function hset($json_all){
    	$json_all = json_encode($json_all);
    	$json_all = json_decode($json_all,true);
    	$tmp=[];
    	foreach ($json_all as $key => $value) {
    		$tmp[]=json_decode($json_all[$key],true);	
    	}
    	return $tmp;
    }

    //更新redis缓存 ajax
    public function redis_ajax(Request $request){
    	//更新redis缓存
    	if($request->input('dr')==1){
    		if(Redis::del('xiha')){
    			return ['success'=>1,'static'=>'缓存更新成功！'];
    		}else{
    			return ['success'=>0,'static'=>'删除失败，找不到该键值！'];
    		}
    	}
    }
    //redis集合缓存
    public function sadd(){
    	$key = 'posts:title';
    	$variable = [
    		['title'=>'php 多文件上传的实现实例','url'=>'http://www.baidu.com'],
    		['title'=>'详解php中空字符串和0之间的关系','url'=>'http://www.baidu.com'],
    		['title'=>'详解PHP编码转换函数应用技巧','url'=>'http://www.baidu.com'],
    		['title'=>'PHP实现Google plus的好友拖拽分组效果','url'=>'http://www.baidu.com']
    	];
    	foreach ($variable as $key => $value) {
    		Redis::sadd($key,[$value['title'],$value['url']]);
    	}
    	
    	$nums = Redis::scard($key);
    	if($nums>0){
		  //从指定集合中随机获取三个标题
		  $post_titles = Redis::srandmember($key,3);
		  return $post_titles;
		}
    }

    //下拉加载更多数据
    public function loing(Request $request){
    	dd($request->all());
    }


    public function row($id=null){
    	$a = [
    		['id'=>1,'name'=>'hedada'],
    		['id'=>2,'name'=>'hedasdda'],
    		['id'=>3,'name'=>'hesddada'],

    	];
    	foreach ($a as $key => $value) {

    		$b = Redis::hset("favorites",$value['id'],$value['name']);
    	}
    	
    	dd(Redis::hget("favorites",'1'));
    	$redis = Redis::connection('default');
        $cacheUsers = $redis->get('userList');
        if( $cacheUsers ){
            $users = $cacheUsers;
            dd($users.'获取用户列表，通过redis');
            Log::info('获取用户列表，通过redis');
        }else{
            $users = Curl::find(10);
            $redis->set('userList', $users->times);
            dd($users.'获取用户列表，通过msyql');
            Log::info('获取用户列表，通过msyql');
        }

    }

    //分配文章
    public function show($id){
    	$dd = Redis::hget('xiha',$id);
    	$dd = json_decode($dd,true);

    	return view('reg/show',compact('dd'));

    }
}


// $key = 'posts:title';
// $posts = Post::all();
// foreach ($posts as $post) {
//   //将文章标题存放到集合中
//   Redis::sadd($key,$post->title);
// }
// //获取集合元素总数(如果指定键不存在返回0)
// $nums = Redis::scard($key);
// if($nums>0){
//   //从指定集合中随机获取三个标题
//   $post_titles = Redis::srandmember($key,3);
//   dd($post_titles);
// }
// 注：集合与列表的区别在于集合中是不允许重复元素出现的，没错，这就是数学中集合的互异性的体现；有序集合与集合的区别在于有序集合是有序的，这则是数学集合无序性的体现。
