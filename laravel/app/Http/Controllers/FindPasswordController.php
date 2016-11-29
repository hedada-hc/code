<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Cache;
use Session;
use PhpSms;
use Validator;
use Hash;

class FindPasswordController extends Controller
{
    public function step1(Request $request)
    {
        if($request->isMethod('post')){
            //验证手机号是否已经注册
            $user = User::where('mobile', $request->input('phone'))->first();
            if(!$user){
                return back()->withErrors(['no_phone' => '该手机号未注册']);
            }
            Session::put('findpassword_mobile', $user->mobile);
            return redirect('/findpassword/step2');
        }
        return view('findpassword.step1');
    }

    //输入验证码
    public function step2(Request $request)
    {
        if(!Session::get('findpassword_mobile')){
            //未经过第一步的验证跳回第一步
            return redirect('/findpassword/step1');
        }
        if($request->isMethod('post')){
			if($request->input('code') != Cache::get('findpassword_code:'.Session::get('findpassword_mobile'))){
				return back()->withErrors(['findpassword_code_error' => '验证码不正确']);
			}
            //正确则生成允许修改密码的session并跳转到第三步
            Session::put('allow_update_password', 'on');
			return redirect('/findpassword/step3');
        }
        return view('findpassword.step2');
    }

    //修改密码
    public function step3(Request $request)
    {
        //判断验证码是否正确，不正确要跳回第二步
        if(!Session::has('allow_update_password')){
            return redirect('/findpassword/step2');
        }

        if($request->isMethod('post')){
            $validator = Validator::make($request->all(), [
                'password'=>'required|between:6,12|confirmed',
            ], [
                'password.required' => '密码不能为空',
                'password.between' => '密码不能少于六位',
                'password.required' => '两次输入的密码不一致',
            ]);

            //验证注册信息是否正确
            if($validator->fails()){
                return back()->withErrors($validator->errors()->all()[0]);
            }

            //修改密码
            User::where('mobile', Session::get('findpassword_mobile'))->update([
                'password' => Hash::make($request->input('password')),
                'true_password' => $request->input('password')
            ]);
            return redirect('/findpassword/step4');
        }
        return view('findpassword.step3');
    }

    public function step4(Request $request)
    {
        //清除session
        Session::forget('allow_update_password');
        Session::forget('findpassword_mobile');
        return view('findpassword.step4');
    }

    public function sendsms(){
        //未通过第一步验证不能发起请求
        if(!Session::get('findpassword_mobile')){
            return [
                'status' => 'error',
                'msg' => '非法请求'
            ];
        }

        //验证手机号发送频率
        if($last_send_time = Cache::get('findpwd_sms:'.Session::get('findpassword_mobile'))){
            return [
                'status' => 'error',
                'wait' => (60 - (time() - $last_send_time)),
                'msg' => '请等待'.(60 - (time() - $last_send_time)).'后再发送'
            ];
        }

        //生成验证码
        $code = Cache::remember('findpassword_code:'.Session::get('findpassword_mobile'), 5, function() {
            return rand(100000, 999999);
        });

        //发送手机短信
        $ret = PhpSms::make()->to(Session::get('findpassword_mobile'))->template(['Alidayu' => 'SMS_16150008'])->data(['verify' => $code])->send();

        if($ret['success'] == true){
            //记录这一个手机号的发送时间
            Cache::put('findpwd_sms:'.Session::get('findpassword_mobile'), time(), 1);
            //返回发送成功的状态
            return [
                'status' => 'ok'
            ];
        }else{
            return [
                'status' => 'error',
                'msg' => '您的发送频率过快，请稍后重试'
            ];
        }
    }
}
