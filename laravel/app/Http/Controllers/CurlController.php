<?php
namespace App\Http\Controllers;
class CurlController extends Controller{
	public function curl(){
		$url = "https://www.tmall.com/";
		$re = curl_init();
		curl_setopt($re,CURLOPT_URL,$url);
		curl_setopt($re,CURLOPT_RETURNTRANSFER,1);
		$res = curl_exec($re);
		curl_close($re);
		dd($res);

	}
}