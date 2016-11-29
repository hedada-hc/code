<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\WenanTemplate;
use App\Models\Tmplates;
use App\Models\Pid;
use App\Models\Item;
use Auth;
use Validator;
use Mail;

class WenanTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function transform(Request $request)
    {

        $item = Item::with('activities')->has('activities')->where('id', $request->id)->first()->toArray();

        if(!$item){
            return [
                'status' => 'error',
                'msg' => '抱歉，该商品券已被领完'
            ];
        }

        //dd($item);

        $wenan_template = WenanTemplate::where('user_id', Auth::user()->id)->where('qudao', 'qq')->where('is_default', 1)->first();
        if(!$wenan_template){
            return [
                'status' => 'error',
                'msg' => '请先设置文案模板'
            ];
        }

        $pid = Pid::where('id', $wenan_template['pid_id'])->first();

        if(!$pid){
            return [
                'status' => 'error',
                'msg' => '请先设置PID'
            ];
        }

        //选择默认模板
        $default = WenanTemplate::where('user_id',Auth::user()->id)->where('is_default',1)->first()->toArray();

        $templates = Tmplates::where('id',$default['tmplate_id'])->first();  
        if($item['plan_type'] == '鹊桥'){
            $pid = $pid['queqiao_pid'];
            $erheyi_url = '<a class="exampleleft-a" href="http://uland.taobao.com/coupon/edetail?activityId='.$item['activities'][0]['activity_id'].'&pid='.$pid.'&itemId='.$item['item_id'].'&src=tkzs_tkzsa" target="_blank">http://uland.taobao.com/coupon/edetail?activityId='.$item['activities'][0]['activity_id'].'&pid='.$pid.'&itemId='.$item['item_id'].'&src=tkzs_tkzsa</a>';
        }else{
            $pid = $pid['common_pid'];
            $erheyi_url = '<a class="exampleleft-a" href="http://uland.taobao.com/coupon/edetail?activityId='.$item['activities'][0]['activity_id'].'&pid='.$pid.'&itemId='.$item['item_id'].'&src=tkzs_tkzsa&dx=1" target="_blank">http://uland.taobao.com/coupon/edetail?activityId='.$item['activities'][0]['activity_id'].'&pid='.$pid.'&itemId='.$item['item_id'].'&src=tkzs_tkzsa&dx=1</a>';
        }

        $template = preg_replace([
            '/\{商品图片\}/',
            '/\{原标题\}/',
            '/\{短标题\}/',
            '/\{介绍文案\}/',
            '/\{店铺类型\}/',
            '/\{原价\}/',
            '/\{券后价\}/',
            '/\{销量\}/',
            '/\{包邮\}/',
            '/\{佣金比例\}/',
            '/\{领券链接\}/',
            '/\{换行符\}/',
            '/\{空格符\}/',
            '/\{券满\}/',
            '/\{券减\}/',
            '/\{优惠券剩余数量\}/',
            '/\{传统模式下单链接\}/',
            '/\{二合一模式下单链接\}/',
        ], [
            '<img class="tui_pic" src="http://acdn.taokezhushou.com/'.$item['pic_url'].'@1e_1c_0o_0l_304h_304w_100q.src" copy-src="http://acdn.taokezhushou.com/'.$item['pic_url'].'"/>',
            $item['search_title'],
            $item['title'],
            $item['intro'],
            $item['shop_type'] ? '天猫' : '淘宝',
            $item['price'],
            $item['price'] - $item['activities'][0]['amount'],
            $item['volume'],
            '包邮',
            $item['commission_rate'],
            '<a class="exampleleft-a" href="http://shop.m.taobao.com/shop/coupon.htm?seller_id='.$item['activities'][0]['seller_id'].'&activity_id='.$item['activities'][0]['activity_id'].'">http://shop.m.taobao.com/shop/coupon.htm?seller_id='.$item['activities'][0]['seller_id'].'&activity_id='.$item['activities'][0]['activity_id'].'</a>',
            '<br/>',
            '&nbsp;&nbsp;',
            $item['activities'][0]['applyAmount'],
            $item['activities'][0]['amount'],
            $item['activities'][0]['surplus'],
            $item['shop_type'] ? '<a class="exampleleft-a" href="https://detail.tmall.com/item.htm?id='.$item['item_id'].'">https://detail.tmall.com/item.htm?id='.$item['item_id'].'</a>' : '<a class="exampleleft-a" href="https://item.taobao.com/item.htm?id='.$item['item_id'].'">https://item.taobao.com/item.htm?id='.$item['item_id'].'</a>',
            $erheyi_url
        ], $templates['content']);

        return [
            'status' => 'ok',
            'plan_type' => $item['plan_type'],
            'data' => $template
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pids = Pid::where('user_id', Auth::user()->id)->get();
        if(!count($pids)){
            return [
                'status' => 'error',
                'msg' => 'nopid'
            ];
        }

        //第一次设置模板 获取默认模板
        if(!WenanTemplate::where('user_id',Auth::user()->id)->first()){
            $temp_tmp[0] = [
                'id'      => 0,
                'name'    => "系统默认模板",
                'content' => "{商品图片}{换行符}{短标题}{换行符}领券后{券后价}元{包邮}{换行符}领券下单：{二合一模式下单链接}{换行符}{介绍文案}"
            ];
            return [
            'status' => 'ok',
            'data' => view('wenan_template.index', compact('pids','temp_tmp'))->render()
            ];
        }

        //获取所有模板
        $temp_all = WenanTemplate::where('user_id',Auth::user()->id)->where('qudao','qq')->get()->toArray();

        $temp_tmp=[];
        $is_key='';
        foreach ($temp_all as $key => $value) {

            if($value['is_default'] == 1){

                $tmp = Tmplates::where('id',$value['tmplate_id'])->first();
                $tmp['is_default'] = 1;
                $temp_tmp[] = $tmp;
                $is_key = $key;
            }else{
                $temp_tmp[] = Tmplates::where('id',$value['tmplate_id'])->first();
            }
        }
        return [
            'status' => 'ok',
            'data' => view('wenan_template.index', compact('pids','temp_tmp','is_key'))->render()
        ];
    }
    //''
    /** 'is_default'
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'qudao' => 'required',
            'name' => 'required',
            'pid_id' => 'required|exists:pids,id',
        ], [
            'pid_id.required' => '请选择一个PID',
            'pid_id.exists' => '请选中一个PID',
            'name.required' => '模板名称不能为空',
        ]);

        //验证注册信息是否正确
        if($validator->fails()){
            return [
                'status' => 'error',
                'msg' => $validator->errors()->all()[0]
            ];
        }

        $db = $request->all();

        //判断是否是修改
        if($db['default'] == null || $db['default'] == 0){
            // dd($db);
            //添加模板 Tmplates
            $tmp['name'] = $db['name'];
            $tmp['content'] = $db['template'];
            $res = Tmplates::create($tmp);
            $db['tmplate_id']=$res->id;
            WenanTemplate::where('user_id',$db['user_id'])->update(['is_default'=>0]);
            $db['is_default']=1;
            WenanTemplate::create($db);
        }else{
            // dd($db);
            //设置默认模板 修改模板
            WenanTemplate::where('user_id',$db['user_id'])->update(['is_default'=>0]);
            WenanTemplate::where('tmplate_id',$db['default'])->where('user_id',$db['user_id'])->update(['is_default'=>1]);
            //修改模板
            $res = Tmplates::where('id',$db['default'])->update([
                'name'    => $db['name'],
                'content' => $db['template']
                ]);
            if(!$res){
                return [
                    'status' => 'error',
                    'msg' => '修改失败！',
                    'error_data' => $db,
                    'code' => $res
                ];
            }
        }

        return [
            'status' => 'ok',
            'msg' => '保存成功'
        ];

    }

    //删除模板  
    public function del_temp(Request $request){
        if(WenanTemplate::where('tmplate_id',$request->all('id'))->delete() && Tmplates::where('id',$request->all('id'))->delete()){
            return [
                'status' => 'ok',
                'msg'    => '模板删除成功！'
            ];
        }

        return [
                'status' => 'error',
                'msg'    => '删除失败'
            ];
    }


    public function luck(Request $request){

        $login_url   = "http://www.juxiangyou.com/login/auth";
        $code_url    = "http://www.juxiangyou.com/verify/";
        $cookie_file = dirname(__FILE__).'/cookie.txt';
        $data        = "jxy_parameter=%7B%22c%22%3A%22index%22%2C%22fun%22%3A%22login%22%2C%22account%22%3A%221006123126%40qq.com%22%2C%22password%22%3A%22hedada0313%22%2C%22verificat_code%22%3A%22".$request->input('vcode')."%22%2C%22is_auto%22%3Afalse%7D";
        $header      = [
            "Host:www.juxiangyou.com",
            "Origin:http://www.juxiangyou.com",
            "Referer:http://www.juxiangyou.com/login/index",
            "User-Agent:Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.104 Safari/537.36 Core/1.53.1708.400 QQBrowser/9.5.9635.400",
            "X-Requested-With:XMLHttpRequest"
        ];

        $cookieVerify = dirname(__FILE__)."/verify.tmp";
        $cookieSuccess = dirname(__FILE__)."/1769.tmp";

        // 获取cookie并保存
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$login_url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieVerify);
        $rs = curl_exec($ch);

        // 带上cookie抓取验证码，必须带上cookie，否则验证码不对应
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$code_url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieVerify);
        $rs = curl_exec($ch);

        // 把验证码在本地生成，二次拉取验证码可能无法通过验证
        @file_put_contents("verify.jpg",$rs);
        // 手工验证码表单
        echo "<form action=\"\" method=\"post\"><input type=\"text\" name=\"vcode\"><img src=\"verify.jpg\" /><br><input type=\"submit\" value=\"ok\"> ".csrf_field()."</form>";

        if($request->isMethod('post')){
            curl_setopt($ch, CURLOPT_URL, $login_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieVerify);
            curl_setopt($ch, CURLOPT_HEADER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieSuccess);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            $result= curl_exec($ch);
            curl_close($ch);
            echo $result;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd($id);
    }
}
