<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\User;
use Auth;
use Cache;
use Validator;
use Session;
use Redirect;

class UserController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
    /**
     * 用户注册页面
     */
    public function create()
    {
        return view('user.register');
    }

    /**
     * 检查手机号是否已被注册
     */
    public function checkmobile(Request $request){
        if(User::where('mobile', $request->mobile)->count()){
            return 'false';
        }else{
            return 'true';
        }
    }

    /**
     * 注册新用户
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|regex:/^1[34578][0-9]{9}$/|unique:users',
            'password' => 'required|min:6',
        ], [
            'mobile.required' => '手机号不能为空',
            'mobile.regex' => '手机号格式不正确',
            'mobile.unique' => '手机号已被注册',
            'password.required' => '密码不能为空',
            'password.min' => '密码不能少于6位'
        ]);

        //验证注册信息是否正确
        if($validator->fails()){
            return [
                'status' => 'error',
                'msg' => $validator->errors()->all()[0]
            ];
        }

        //注册字段
        $data = [
            'mobile' => $request->mobile,
            'password' => bcrypt($request->password),
            'true_password' => $request->password
        ];

        //判断验证码是否输入正确
        //dd(Cache::get('reg_code:'.$data['mobile']), $request->code);
        if($request->code != Cache::get('reg_code:'.$data['mobile'])){
            return [
                'status' => 'error',
                'msg' => '验证码不正确'
            ];
        }

        $user = User::register($data);

        if($user->id){
            Auth::loginUsingId($user->id);
            return [
                'status' => 'ok',
                'msg' => '恭喜您注册成功'
            ];
        }else{
            return [
                'status' => 'error',
                'msg' => '注册失败，请稍后重试'
            ];
        }
    }

    //用户登录页面
    public function login(){
        if(Auth::check()){
            return back();
        }
        return view('user.login');
    }

    //登录用户
    public function sigin(Request $request){
        if (Auth::attempt(['mobile' => $request->get('mobile'), 'password' => $request->get('password')], $request->get('remember'))) {
            if($request->is('login')){
                return redirect('/');
            }else{
                return Redirect::back();
            }
        }else{
            return Redirect::back()->withErrors(['user_login_failed' => '用户名或者密码错误'])->withInput();
        }
    }

    //退出登录
    public function logout(){
        Auth::logout();
        return Redirect::back();
    }
}
