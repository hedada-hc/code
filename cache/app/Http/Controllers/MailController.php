<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
class MailController extends Controller{
	public function send(){
		Mail::raw("恭喜你注册成功",function($message){
			$message->subject("提醒激活邮件");
			$message->to("183844707@qq.com");
		});
	}

}