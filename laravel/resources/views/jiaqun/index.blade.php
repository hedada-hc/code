<?php
    $taokequn = Cache::remember('taokequns', 10, function(){
        return App\Models\Qun::where('name', '淘客')->first();
    });

    $zhaoshangqqs = Cache::remember('zhaoshangqqs', 10, function(){
        return App\Models\Qq::where('type', '招商')->where('status', 1)->get()->toArray();
    });

    $arr = [];
    foreach($zhaoshangqqs as $key=>$val){
        $arr[$key] = $val['weight'];
    }
    $k = rand_weight($arr);
    $zhaoshangqq = $zhaoshangqqs[$k];

    function rand_weight($arr){
        $ret = '';
        $sum = array_sum($arr);
        foreach($arr as $k=>$v){
            $r = mt_rand(1, $sum);
            if($r <= $v){
                $ret = $k;
                break;
            }else{
                $sum = max(0, $sum - $v);
            }
        }
        return $ret;
    } 
?> 
<p>大淘客交流群：<a href="{{ $taokequn['qun_link'] }}" target="_blank">{{ $taokequn['qun_num'] }}</a>（验证语：淘宝客） 招商负责人QQ：<a href="{{ $zhaoshangqq['qq_link'] }}" target="_blank">{{ $zhaoshangqq['qq_num'] }}</a>（验证语：店铺名）创始人达哥微信：datao801</p>