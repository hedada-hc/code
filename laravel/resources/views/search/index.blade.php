@extends('layouts.home')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('statics/css/common.css?v1.0') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('statics/css/indexcom.css?v1.0') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('statics/css/index3.css?v1.0') }}">
@endsection
@section('content')
<!--hd结束-->
<div class="subnav">
        <div class="subnav1 wth">
            <ul>
                <li @if(FilterManager::isActive('cid')) class="sbnv1" @endif>
                    <a href="{{FilterManager::url('cid')}}">
                        全部({{ $item_count }})
                    </a>
                </li>
                @foreach($cates as $cate)
                <li @if(Request()->input('cid') == $cate->id)class="sbnv1"@endif><a href="{{FilterManager::url('cid', $cate->id)}}">{{ $cate->name }}({{ $cate->count }})</a></li>
                @endforeach
            </ul>
        </div><!--subnav1 wth结束-->					
</div><!--subnav结束-->
@if($search_list->is_empty)
<div class="wth">
    <div class="searchfail">
        <i></i>
        <p class="pfail">抱歉！没有找到与<span>“{{ Request()->input('q') }}” </span>相关的宝贝。</p>
        <p>别担心，我们在下面给您推荐了一些优质商品，或者您也可以<a href="/">返回首页</a></p>
    </div>
</div>
@endif
<div class="goods">
    <div class="goods1 wth clearfix">
        @if(!$search_list->is_empty)
        <div class="menu">
            <div class="menu1 clearfix">
                <ul>
                    <li @if(FilterManager::isActive('sort') || FilterManager::isActive('sort', 'default')) class="mu1" @endif><a href="{{ FilterManager::url('sort', \Toplan\FilterManager\FilterManager::ALL) }}" class="awidth">默认排序</a></li>
                    <li class="price @if(FilterManager::isActive('sort', 'price_asc') || FilterManager::isActive('sort', 'price_desc')) mu1 @endif">
                        <a href="#" class="awidth">
                            @if(FilterManager::isActive('sort', 'price_desc')) 价格从高到低 @elseif(FilterManager::isActive('sort', 'price_asc')) 价格从低到高 @else 价格 @endif
                        </a>
                        <div class="pricetrend">
                                <p><a href="{{FilterManager::url('sort', 'price_desc')}}">价格从高到低</a></p>
                                <p><a href="{{FilterManager::url('sort', 'price_asc')}}" class="pricetrend2">价格从低到高</a></p>
                        </div>
                    </li>
                    <li @if(FilterManager::isActive('sort', 'volume')) class="mu1" @endif>
                        <a href="{{ FilterManager::url('sort', 'volume') }}" class="awidth">
                            @if(FilterManager::isActive('sort', 'volume')) 销量从高到低 @else 销量 @endif
                        </a>
                    </li>
                    <li class="commission @if(FilterManager::isActive('sort', 'commission_rate_asc') || FilterManager::isActive('sort', 'commission_rate_desc')) mu1 @endif">
                        <a href="#" class="awidth">
                            @if(FilterManager::isActive('sort', 'commission_rate_desc')) 佣金从高到低 @elseif(FilterManager::isActive('sort', 'commission_rate_asc')) 佣金从低到高 @else 佣金 @endif
                        </a>
                        <div class="commission_rate_trend">
                            <p><a href="{{ FilterManager::url('sort', 'commission_rate_desc') }}">佣金从高到低</a></p>
                            <p><a href="{{ FilterManager::url('sort', 'commission_rate_asc') }}" class="commission2">佣金从低到高</a></p>
                        </div>
                    </li>	
                </ul>
                <div class="menu-last"><a href="#">&lt;</a>&nbsp;&nbsp;1/100&nbsp;&nbsp;<a href="#">&gt;</a></div>
            </div>
            <div class="menu2 clearfix">
                <ul>
                    <li class="input1"><input id="is_tmall" type="checkbox" name="is_tmall" @if(FilterManager::isActive('is_tmall', 1)) checked @endif  onclick="window.location.href='{{ FilterManager::url('is_tmall', FilterManager::isActive('is_tmall', 1) ? 0 : 1) }}'"/>&nbsp;<label for="is_tmall">天猫旗舰店</label></li>
                    <li class="input2 btn1">月销量&nbsp;
                        <input type="text" id="volume_start" value="{{ Request()->input('volume_start') }}"/>&nbsp;<span class="ipt-color">笔及以上</span>
                        <button type="button" class="sure1" id="volume_start_btn">确定</button>
                    </li>
                    <li class="input2 btn2">收入比率&nbsp;
                        <?php
                            $commission_rate = explode('-', Request()->input('commission_rate'));
                        ?>
                        <input type="text" id="commission_rate_start" value="{{ isset($commission_rate[0]) ? $commission_rate[0] : '' }}"/>
                        <span class="ipt-color">&nbsp;%&mdash;&nbsp;
                        <input type="text" id="commission_rate_end" value="{{ isset($commission_rate[1]) ? $commission_rate[1] : '' }}"/>&nbsp;%</span>
                        <button type="button" class="sure2" id="commission_rate_btn">确定</button>
                    </li>
                    <li class="input2 btn3">价格&nbsp;
                        <?php
                            $price = explode('-', Request()->input('price'));
                        ?>
                        <input type="text" id="price_start" value="{{ isset($price[0]) ? $price[0] : '' }}"/>
                        <span class="ipt-color">&nbsp;元&mdash;
                        <input type="text" id="price_end" value="{{ isset($price[1]) ? $price[1] : '' }}"/>&nbsp;元</span>
                        <button type="button" class="sure3" id="price_btn">确定</button>
                    </li>
                </ul>
            </div>
        </div>
        @endif
        <ul class="mg clearfix">
            @foreach($search_list as $key => $item)
            <li class="good1_one fl">
                <div class="goods-a">
                    <a href="/detail/{{ $item->id }}" target="_blank">
                    @if($key > 3)
                        <img src="{{ asset('statics/images/waiting.png') }}" class="lazy" data-original="http://acdn.taokezhushou.com/{{ $item->pic_url }}@1e_1c_0o_0l_287h_287w_100q.src" alt="{{ $item->title }}"/>
                    @else
                        <img src="http://acdn.taokezhushou.com/{{ $item->pic_url }}@1e_1c_0o_0l_287h_287w_100q.src" alt="{{ $item->title }}"/>
                    @endif
                    @if($item->created_at->format('Y-m-d H:i:s') > date('Y-m-d 00:00:00'))
                        <div class="newdays2 newd2"></div>
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
                </div>
            </li>
            @endforeach
        </ul>
    </div><!--goods1 wth结束-->
    <div class="pages wth">
    {!! $paginate !!}
    </div>
</div><!--goods结束-->
@endsection
@section('footer_js')
<script>
    $(".pricetrend").hide();
    $(".price").mouseenter(function(){
        $(".pricetrend").show();
        $(".pricetrend").find("a").css("border","none");
    });
    $(".price").mouseleave(function(){
        $(".pricetrend").hide();
    });

    $(".commission_rate_trend").hide();
    $(".commission").mouseenter(function(){
        $(".commission_rate_trend").show();
        $(".commission_rate_trend").find("a").css("border","none");
    });
    $(".commission").mouseleave(function(){
        $(".commission_rate_trend").hide();
    });
    $('#volume_start_btn').click(function(){
        if($('#volume_start').val() > 0){            
            window.location.href = "{!! FilterManager::url('timestamp', microtime()) !!}&volume_start=" + $('#volume_start').val();
        }else{
            window.location.href = "{!! FilterManager::url('volume_start') !!}";
        }
    });
    $('#commission_rate_btn').click(function(){
        if($('#commission_rate_start').val() > 0 || $('#commission_rate_end').val() > 0){
            window.location.href = "{!! FilterManager::url('timestamp', microtime()) !!}&commission_rate=" + $('#commission_rate_start').val() + '-' + $('#commission_rate_end').val();
        }else{
            window.location.href = "{!! FilterManager::url('commission_rate') !!}";
        }
    });
    $('#price_btn').click(function(){
        if($('#price_start').val() > 0 || $('#price_end').val() > 0){
            window.location.href = "{!! FilterManager::url('timestamp', microtime()) !!}&price=" + $('#price_start').val() + '-' + $('#price_end').val();
        }else{
            window.location.href = "{!! FilterManager::url('price') !!}";
        }
    });
</script>
@endsection