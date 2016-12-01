<?php
namespace App\Http\Controllers;
use App\Models\Curl;
use App\Jobs\Myjob;
use Illuminate\Http\Request;
use App\Http\Requests;
use Redis;
header("Content-Type:text/html;charset=utf8");
class CurlController extends Controller{
	protected $url;
	//开采啦
	public function index(Request $request){
		if($request->all()){

		//http://www.jb51.net/list/list_15_3.htm
		$preg = '/上页<\/a><strong>1<\/strong><a href="\/list\/list_15_2.htm">2<\/a><a href="\/list\/list_15_3.htm">3<\/a><a href=\/list\/list_15_2.htm title="下页">下页<\/a><a href=\/list\/list_15_(\d+).htm title="末页">末页<\/a><\/div>/';

		$url = "http://www.jb51.net/list/list_15_1.htm";
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		$res = curl_exec($ch);
		$res = mb_convert_encoding($res,'utf-8','gb2312');
		curl_close($ch);
		preg_match_all($preg,$res,$arr);
		

		//获取页码
		$peg = $request->all();
		
		for ($i=$peg['num']; $i <$peg['nums']  ; $i++) { 

			$create = $this->get($i,$i);

			if(!$create){
				return "采集失败啦-->".$i;
			}
			$peg['num']=$peg['num']+1;
			echo "<script type='text/javascript'>window.location.href='http://localhost/cache/public/curl?num=".$peg['num']."&nums=".$peg['nums']."'</script>";
		}
		//统计总共多少

		echo "<p style='font-size:20px;text-align:center;'>成功采集到 ".Curl::count()."条文章 </p>";
		}
		echo "请传递参数 示例 ?num=1&nums=10";
		
	}

	//获取文章列表
	public function get($list_id,$num){

		$preg = '/<DT><span>日期:(.*)<\/span><a href="(.*)" title="(.*)" target="_blank">(.*)<\/a><\/DT>/';

		$this->url = "http://www.jb51.net/list/list_15_".$list_id.".htm";

		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$this->url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.87 Safari/537.36');
		$res = curl_exec($ch);

		curl_close($ch);

		/* 转换utf-8为gb2312 */
		$res = mb_convert_encoding($res, "utf-8", "gb2312");
		// $res=mb_convert_encoding($res, 'UTF-8', 'UTF-8,GBK,GB2312,BIG5');  // 对页面内容进行编码  
		preg_match_all($preg,$res,$arr);
		
		//循环写入到数据库  strtotime("2016-10-19")  2016-10-24
		$tmp=[];
		foreach ($arr[2] as $key => $value) {

			$tmp['titles'] = $arr[3][$key];
			$tmp['urls']   = "http://www.jb51.net".$arr[2][$key];
			$tmp['times']  = strtotime($arr[1][$key]);
			//采集文章内容
			$con = $this->get_con("http://www.jb51.net".$arr[2][$key]);
			$tmp['content'] = $con[1][0];
			if($tmp['content']){
				//存数据库
				if(Curl::create($tmp)){
					//
					echo "<p style='text-align:center;color:red;'>成功采集第 ".$list_id." 页 --> 第 ".$key." </p>";
				}else{
					dd("数据库写入错误");
				}
				//序列化数组
				
				//存缓存
				// $red = Redis::set('article'.$key,json_encode($tmp));
				// if($red){
				// 	echo "<script>document.write('成功采集第 ".$list_id." 页 --> 第 ".$key." ')</script>";
				// }

			}else{
				dd("文章采集失败");
			}
			
			
		}

		return true;
	}
//

	//获取文章内容
	public function get_con($url){
		// http://www.jb51.net/article/95267.htm
		$preg = '/<div id="contents">(.*)<div class="art_xg">/isU';
		
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.87 Safari/537.36');
		$res = curl_exec($ch);

		curl_close($ch);

		/* 转换utf-8为gb2312 */
		$res = mb_convert_encoding($res, "utf-8", "gb2312");
		// $res=mb_convert_encoding($res, 'UTF-8', 'UTF-8,GBK,GB2312,BIG5');  // 对页面内容进行编码  
		preg_match_all($preg,$res,$arr);

		return $arr;	
	}

}

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>

<body>
	<div id="text"></div>
</body>
</html>