<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Geetest;
use Cache;
use PhpSms;
use Validator;

class SmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendsms(Request $request)
    {
        //判断是否通过了极验验证
        if(!Geetest::verify()){
            return [
                'status' => 'error'
            ];
        }

        //验证ip发送频率
        if($last_send_time = Cache::get('sms_ip:'.get_true_ip())){
            return [
                'status' => 'error',
                'msg' => '请等待'.(60 - (time() - $last_send_time)).'后再发送'
            ];
        }

        //验证手机号码
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|regex:/^1[34578][0-9]{9}$/|unique:users',
        ], [
            'mobile.required' => '手机号不能为空',
            'mobile.regex' => '手机号格式不正确',
            'mobile.unique' => '手机号已被注册'
        ]);

        if($validator->fails()){
            return [
                'status' => 'error',
                'msg' => $validator->errors()->all()[0]
            ];
        }else{
            //生成验证码
            $code = Cache::remember('reg_code:'.$request->input('mobile'), 15, function() {
                return rand(100000, 999999);
            });
            //发送手机短信
            $ret = PhpSms::make()->to($request->input('mobile'))->template(['Alidayu' => 'SMS_16150008'])->data(['verify' => $code])->send();

            if($ret['success'] == true){
                //记录这一个ip的发送时间
                Cache::put('sms_ip:'.$request->ip(), time(), 1);
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
}
