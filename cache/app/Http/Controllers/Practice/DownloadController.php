<?php
namespace App\Http\Controllers\Practice;
use App\Http\Controllers\Controller;
//下载laravel视频教程
class DownloadController extends Controller{
	public function index(){
		$this->login();
	}

	/**
	* @param $url 登录地址
	* @param $data 登录时提交数据
	* @return 登录与否
	*/
	public function login(){
		$url = "https://laravist.com/user/login";
		$data = "_token=Zt6eNKbNrKa973vbw5WjdFyAxQgqwMVMeO3LPjl8&email=lidaemail%40qq.com&password=laravel123";
		$header = [
			"Host:laravist.com",
			"Origin:https://laravist.com",
			"Referer:https://laravist.com/user/login?redirect_url=https://laravist.com",
			"User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.87 Safari/537.36"
		];
		$file_cookie= dirname(__FILE__).'\hdd_cookie.txt';
		$re = curl_init();
		curl_setopt($re,CURLOPT_URL,$url);
		curl_setopt($re,CURLOPT_RETURNTRANSFER,1);
		// curl_setopt($re,CURLOPT_POST,1);
		// curl_setopt($re,CURLOPT_POSTFIELDS,$data);
		// curl_setopt($re,CURLOPT_HTTPHEADER,$header);
		// curl_setopt($re,CURLOPT_COOKIESESSION,true);
		// curl_setopt($re,CURLOPT_COOKIEFILE,$file_cookie); 
		// curl_setopt($re,CURLOPT_COOKIEJAR,$file_cookie);
		// curl_setopt($re,CURLOPT_COOKIE,session_name().'='.session_id());
		// curl_setopt($re,CURLOPT_FOLLOWLOCATION,1);
		$res = curl_exec($re);
		curl_close($re);
		dd($res);
		// if($res){
		// 	return true;
		// }
		// return false;
	}

	public function down(){

	}
}

/**
微信登录流程所有post/get数据


*/

