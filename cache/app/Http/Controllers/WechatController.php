<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class WechatController extends Controller{
	protected $skey ='';
	protected $pass_ticket ='';
	protected $sid ='';
	protected $uin ='';
	protected $uuid ='';
	protected $cookieFile = '';
	public function uuid(){
		header('Content-Type:text/html;charset=utf-8');
		/**
		 * @param string $uuid 用于获取二维码
		 */
		$time = time().substr(microtime(),2,3);
		$url = "https://login.wx2.qq.com/jslogin?appid=wx782c26e4c19acffb&redirect_uri=https%3A%2F%2Fwx2.qq.com%2Fcgi-bin%2Fmmwebwx-bin%2Fwebwxnewloginpage&fun=new&lang=zh_CN&_=".$time;
		$uuid = file_get_contents($url);
		$str = strpos($uuid,'uuid = "')+8;
		$str2 = strpos($uuid,'";');
		$uuids = substr($uuid,$str,$str2-$str);

		/**
		 * 组合二维码地址 https://login.weixin.qq.com/qrcode/{$uuid}
		 */
		$code = "https://login.weixin.qq.com/qrcode/".$uuids;
		return view("wechat/index",compact("code",'uuids'));
	}

	public function code_status($uuid){
		$time = time().substr(microtime(),2,3);
		$url = "https://login.wx2.qq.com/cgi-bin/mmwebwx-bin/login?loginicon=true&uuid={$uuid}&tip=0&r=".time()."&_={$time}";
		$re = curl_init();
		curl_setopt($re,CURLOPT_URL,$url);
		curl_setopt($re,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($re, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
		curl_setopt($re, CURLOPT_SSL_VERIFYPEER, false);
		$res = curl_exec($re);
		curl_close($re);
		return ['data'=>$res];
		
	}

	/**
	 * 获取秘钥/令牌
	 */
	public function key(Request $request){
		//cookie文件保存地方
		$this->cookieFile = dirname(__FILE__).'\WechatCookie.txt';
		$header = [
			'Host:wx.qq.com',
			'Referer:https://wx.qq.com/',
			'User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2922.1 Safari/537.36'
		];
		$re = curl_init();
		curl_setopt($re,CURLOPT_URL,$request->input('url'));
		curl_setopt($re,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($re,CURLOPT_HTTP_VERSION,CURL_HTTP_VERSION_1_0);
		curl_setopt($re,CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($re,CURLOPT_HTTPHEADER,$header);
		curl_setopt($re,CURLOPT_COOKIESESSION,true);
		curl_setopt($re,CURLOPT_COOKIEJAR,$this->cookieFile);
		curl_setopt($re,CURLOPT_COOKIEFILE,$this->cookieFile);
		$res = curl_exec($re);
		curl_close($re);
		$xml = simplexml_load_string($res);
		if($xml->ret > 1){return ["msg"=>"秘钥为空，可能原因是账号登录次数过多！"];}
		$this->pass_ticket = $xml->pass_ticket;
		$this->uin = $xml->wxuin;
		$this->sid = $xml->wxsid;
		$this->skey = $xml->skey;
		if($this->pass_ticket != ""){
			$login = $this->login();
			return $login;
		}
		return ["msg"=>"登录失败啊！"];
	}

	/**
	 * 登录wechat 
	 */
	public function login(){
		$url = "https://wx.qq.com/cgi-bin/mmwebwx-bin/webwxinit?r=-1747024806&lang=zh_CN&pass_ticket={$this->pass_ticket}";
		$header=[
			'Host:wx.qq.com',
			'Origin:https://wx.qq.com',
			'Referer:https://wx.qq.com/',
			'User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2922.1 Safari/537.36'
		];
		$re = curl_init();
		curl_setopt($re,CURLOPT_URL,$url);
		curl_setopt($re,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($re,CURLOPT_HTTP_VERSION,CURL_HTTP_VERSION_1_0);
		curl_setopt($re,CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($re,CURLOPT_HTTPHEADER,$header);
		curl_setopt($re,CURLOPT_COOKIESESSION,true);
		curl_setopt($re,CURLOPT_COOKIEJAR,$this->cookieFile);
		curl_setopt($re,CURLOPT_COOKIEFILE,$this->cookieFile);
		$res = curl_exec($re);
		curl_close($re);
		return $res;
	}

	public function test(){
		$cookieFile = dirname(__FILE__).'/WechatCookie.txt';
		file_put_contents($cookieFile,"test");
		dd($cookieFile);
	}
}