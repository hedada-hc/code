<?php
namespace App\Http\Controllers\Personal;
use App\Http\Controllers\Controller;
use App\Models\Luck;
use Illuminate\Http\Request;
class LuckController extends Controller{
	public function index(Request $request){

		if($request->isMethod('post')) {
			//首先判断是否第一次
			$is_null = Luck::all();
			if($is_null->isEmpty()){
				for ($i=0; $i < 5; $i++){ 
					$data = [
						"time"=>strtotime(date("Y-m-d H:").(date("i",time())+$i).":00")
					];
					Luck::create($data);
				}
				return "two_ok!";
			}
			//增加一条
			$id = Luck::where("status",0)->orderBy("id","asc")->first();
			if(Luck::where('id',$id->id)->update($this->num())){
				Luck::create(["time"=>strtotime(date("Y-m-d H:").(date("i",time())+5).":00")]);
			}
			return "ok!";
		}

		$dd = Luck::orderBy('id',"desc")->paginate(25);
		//获取出现次数
		$arr=[];

		for ($i=0; $i < 28; $i++) { 
			$arr[$i] = Luck::where('total',$i)->count();
		}
		//paginate 获取分页
		return view("luck/index",compact('dd',"arr"));

	}

	public function num(){
		//生成随机
		$num1 = mt_rand(0,9);
		$num2 = mt_rand(0,9);
		$num3 = mt_rand(0,9);
		$t = $num1+$num2+$num3;

		$arr = [
			"num1"=>$num1,
			"num2"=>$num2,
			"num3"=>$num3,
			"total"=>$t,
			"status"=>1
		];
		return $arr;
	}

	public function weixin(){
		$url = "https://login.wx.qq.com/jslogin?appid=wx782c26e4c19acffb&redirect_uri=https%3A%2F%2Fwx.qq.com%2Fcgi-bin%2Fmmwebwx-bin%2Fwebwxnewloginpage&fun=new&lang=zh_CN&_=1479964136662";
		$header = [
			"Host:login.wx.qq.com",
			"Upgrade-Insecure-Requests:1",
			"User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2922.1 Safari/537.36"
		];
		$re = curl_init();
		curl_setopt($re,CURLOPT_URL,$url);
		curl_setopt($re,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($re,CURLOPT_HTTPHEADER,$header);
		$res = curl_exec($re);
		curl_close($re);
		echo $res;
	}



}


/**<span class="label label-primary">1号：{{$arr[1]}} 次</span>
		<span class="label label-success">2号：{{$arr[2]}} 次</span>
		<span class="label label-info">3号：{{$arr[3]}} 次</span>
		<span class="label label-warning">4号：{{$arr[4]}} 次</span>
		<span class="label label-danger">5号：{{$arr[5]}} 次</span>
		<span class="label label-default">6号：{{$arr[6]}} 次</span>
		<span class="label label-primary">7号：{{$arr[7]}} 次</span>
		<span class="label label-success">8号：{{$arr[8]}} 次</span>
		<span class="label label-info">9号：{{$arr[9]}} 次</span>
		<span class="label label-warning">10号：{{$arr[10]}} 次</span>
		<span class="label label-danger">11号：{{$arr[11]}} 次</span>
		<span class="label label-default">12号：{{$arr[12]}} 次</span>
		<span class="label label-primary">13号：{{$arr[13]}} 次</span>
		<span class="label label-success">14号：{{$arr[14]}} 次</span>
		<span class="label label-info">15号：{{$arr[15]}} 次</span>
		<span class="label label-warning">16号：{{$arr[16]}} 次</span>
		<span class="label label-danger">17号：{{$arr[17]}} 次</span>
		<span class="label label-default">18号：{{$arr[18]}} 次</span>
		<span class="label label-primary">19号：{{$arr[19]}} 次</span>
		<span class="label label-success">20号：{{$arr[20]}} 次</span>
		<span class="label label-info">21号：{{$arr[21]}} 次</span>
		<span class="label label-warning">22号：{{$arr[22]}} 次</span>
		<span class="label label-danger">23号：{{$arr[23]}} 次</span>
		<span class="label label-default">24号：{{$arr[24]}} 次</span>
		<span class="label label-primary">25号：{{$arr[25]}} 次</span>
		<span class="label label-success">26号：{{$arr[26]}} 次</span>
		<span class="label label-info">27号：{{$arr[27]}} 次</span>**/


		//\x00\x00\x00\x00\x1f\xa8\xd8\xd1

		// $.Encryption.getEncryption(n, pt.plogin.salt, i.verifycode, pt.plogin.armSafeEdit.isSafe),  加密函数