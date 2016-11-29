@extends('layouts.home')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('statics/css/common.css?v1.0') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('statics/css/indexcom.css?v1.0') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('statics/css/index3.css?v1.0') }}">
@endsection
@section('seo_title', '实时热推榜，实时监控推广效果最佳商品 -淘客助手，让推广更高效')
@section('seo_keywords', '')
@section('seo_description', '')
@section('header_title')
<ul>
    <li class="nav1"><a href="/" class="navone">首页</a></li>
    <li><a class="hv" href="/top100" style="color:#ff464e">实时热推榜<i></i></a></li>
    <li><a class="hv" href="javascript:layer.alert('相关教程正在录制....');">淘客学院</a></li>
    <li><a class="hv" href="javascript:layer.alert('API接口暂未开放，测试稳定后我们会及时放出');">开放API</a></li>
    <li><a class="hv" href="javascript:layer.alert('圈子功能正在开发，上线还需要一点点时间');">淘客圈子</a></li>
</ul>
@endsection
@section('content')
<!--hd结束-->
<div class="subnav">
        <div class="subnav1 wth">
            <ul>
                <li @if(!Request()->input('cid'))class="sbnv1"@endif><a href="/top100">全部({{ $item_count }})</a></li>
                @foreach($cates as $cate)
                <li @if(Request()->input('cid') == $cate->id)class="sbnv1"@endif><a href="/cate/{{ $cate->id }}">{{ $cate->name }}({{ $cate->count }})</a></li>
                @endforeach
            </ul>
        </div><!--subnav1 wth结束-->					
</div><!--subnav结束-->
<div class="goods">
    <div class="sbanner">
        <div class="bannerimg">
            <img src="http://acdn.taokezhushou.com/taokezhushou/web/images/sbanner.jpg@95.src" alt="实时热推榜">
        </div>		
    </div>
    <div class="goods1 wth clearfix">
        <ul class="mg clearfix">
            @foreach($top_list as $key => $item)
            <li class="good1_one fl">
                <div class="goods-a">
                    <i class="topnum">
                        TOP<em>{{ $key + 1 }}</em>
                    </i>
                    <a href="/detail/{{ $item->id }}" target="_blank">
                    @if($key > 3)
                        <img src="{{ asset('statics/images/waiting.png') }}" class="lazy" data-original="http://acdn.taokezhushou.com/{{ $item->pic_url }}@1e_1c_0o_0l_287h_287w_100q.src" alt="{{ $item->title }}"/>
                    @else
                        <img src="http://acdn.taokezhushou.com/{{ $item->pic_url }}@1e_1c_0o_0l_287h_287w_100q.src" alt="{{ $item->title }}"/>
                    @endif
                    <div class="title">
                        <i class="tit{{ $item->shop_type }}"></i>
                        <p><a href="/detail/{{ $item->id }}" target="_blank">{{ str_limit($item->title, 32, '') }}</a></p>
                    </div>
                    <div class="coupon">优惠券<span class="num1 gd_wd1">{{ $item->activities[0]->amount }}</span>元，剩余数量<span class="num2 gd_wd1">{{ $item->activities[0]->surplus }}</span>/<span class="num3">{{ $item->activities[0]->receive + $item->activities[0]->surplus }}</span></div>
                    <div class="commission">
                        <ul>
                            <li class="com1 gd_wd2 fl">佣金<span>{{ round($item->commission_rate, 1) }}%</span></li>
                            <li class="com2 fl">{{ $item->plan_type }}</li>
                            <li class="com3 fl">{{ $item->review ? '审核' : '秒过'}}</li>
                            <li class="com4 fr">目前销量<span class="com4_num gd_wd2">{{ $item->volume }}</span></li>
                        </ul>
                    </div>
                    <div class="good_btm">
                        <ul>
                            <li class="btm1 fl">券后&nbsp;&yen;&nbsp;<span class="value">{{ round($item->price - $item->activities[0]->amount, 1) }}</span></li>
                            <li class="btm2 fl">&yen;{{ round($item->price, 1) }}</li>
                            <li class="btm3 fr"><a href="/detail/{{ $item->id }}" target="_blank">立即推广</a></li>
                        </ul>
                    </div>
                    <p class="salesnum">最近2小时销量：<span>{{ $item->two_hour_volume->two_hour_volume }}</span>笔<span style="float:right">{{ $item->item_id }}</span></p>
                </div>
            </li>
            @endforeach
        </ul>
    </div><!--goods1 wth结束-->
    <div class="goods-ft">
        <p><a href="/">点击查看更多领券商品&nbsp;&gt;</a></p>
    </div>
</div><!--goods结束-->
@endsection