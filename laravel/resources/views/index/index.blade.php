@extends('layouts.home')
@section('seo_title', '淘客助手-让推广更高效 大淘宝客首选，最强大的淘宝隐藏券搜索引擎|鹊桥搜索|大淘客联盟')
@section('seo_keywords', '淘宝客，淘客助手，大淘客，轻淘客，查淘客，鹊桥查询，隐藏优惠券，淘宝客软件')
@section('seo_description', '淘客助手是10万淘宝客推荐的免费软件!淘客助手涵盖淘宝全网商品一键查询淘宝客佣金,隐藏优惠券,自动申请高佣金计划等功能。使用淘客助手工具效率提升10倍以上,因为专业,所以信赖!')
@section('header_js')
<script type="text/javascript" src="{{ asset('statics/js/unslider.min.js') }}"></script> 
@endsection
@section('content')
<div class="main">
    <div class="main1 wth">
        <div class="main1_left fl">
            <ul class="clearfix">
                <li class="lis1">
                    <div class="ldicon icon1">
                        <i></i>
                        <h2><a href="http://dl.taokezhushou.com" target="_blank">浏览器插件</a></h2>
                        <p>佣金、优惠券快捷查询</p>
                    </div>
                </li>
                <li class="lis1">
                    <div class="ldicon bd-top icon2">
                        <i></i>
                        <h2><a href="javascript:layer.alert('紧张开发中，尽情期待');">PC客户端</a></h2>
                        <p>批量生成链接，一键群发</p>
                    </div>
                </li>
                <li class="lis1">
                    <div class="ldicon bd-top icon3">
                        <i></i>
                        <h2><a href="javascript:layer.alert('给我们一点点时间，我们能做得更好');">CMS系统</a></h2>
                        <p>0门槛建站，提升收益</p>
                    </div>
                </li>
                <li class="lis1">
                    <div class="ldicon bd-top icon4">
                        <i></i>
                        <h2><a href="javascript:layer.alert('给我们一点点时间，我们能做得更好');">手机APP</a></h2>
                        <p>微信推广方便快捷</p>
                    </div>
                </li>
            </ul>
        </div>
        <!--main1_left结束-->
        <div class="main1_center fl">
            <div class="banner">
                <ul>
                    @foreach($ad_list as $item)
                    <li><a href="{{ $item->url }}" target="{{ $item->target }}"><img src="http://acdn.taokezhushou.com/{{ $item->pic_url }}@1e_1c_0o_0l_375h_650w_85q.src" alt="{{ $item->title }}"></a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!--main1_center结束-->
        <div class="main1_right fr">
            @if(Auth::check())
            <div class="main1_right3">
                <p>已登录账户:</p>
                <div class="rootload3">
                    <img src="{{ asset('statics/images/user.png') }}">
                    <h3>{{ substr_replace(Auth::user()->mobile, '****', 3, 4) }}<span><a href="/logout">[退出]</a></span></h3>
                    <p><a href="/pid">进入用户中心</a></p>
                    <ul>
                        <li><a href="/pid">设置PID</a></li>
                        <li class="rt-bd"><a href="/updatepassword">修改密码</a></li>
                        <li class="rt-bd"><a href="#">收藏中心</a></li>
                    </ul>
                </div>									
            </div>
            @else
            <div class="main1_right1">
                <div class="rootload ">
                    <ul>
                        <li><a href="/login">用户登录</a></li>
                        <li class="rootld"><a href="/register">用户注册</a></li>
                    </ul>
                </div>
                <div class="right2">
                    <form action="/login" method="post">
                        {!! csrf_field() !!}
                        <p>登录名: </p>
                        <div class="error"></div>
                        <input type="text" name="mobile" value="" />
                        <p>登录密码:<span class="ft-pw"><a href="/findpassword/step1">忘记登录密码？</a></span></p>
                        <input type="password" name="password" />
                        @if($errors->has('user_login_failed'))
                        <p class="tip" style="color:red">{{ $errors->first('user_login_failed') }}</p>
                        <p class="loading" style="margin-top:-11px"><input type="submit" value="登 录"/></p>
                        @else
                        <p class="loading"><input type="submit" value="登 录"/></p>
                        @endif
                    </form>
                </div>
            </div>
            @endif
            <div class="main1_right2">
                <ul class="right2-nav">
                    <li class="right-nav1"><a href="#">公告</a></li>
                    <li class="right-nav2"><a href="#">推荐</a></li>
                    <li class="right-nav3"><a href="#">教程</a></li>
                </ul>
                <div class="right2_btm">
                    <ul class="message1">
                        @foreach($news_list[1] as $item)
                        <li><a href="/articles/{{ $item->id }}" target="_blank">{{ $item->title }}</a></li>
                        @endforeach
                    </ul> 
                    <ul class="message2">
                        @foreach($news_list[2] as $item)
                        <li><a href="/articles/{{ $item->id }}" target="_blank">{{ $item->title }}</a></li>
                        @endforeach
                    </ul> 
                    <ul class="message3">
                        @foreach($news_list[3] as $item)
                        <li><a href="/articles/{{ $item->id }}" target="_blank">{{ $item->title }}</a></li>
                        @endforeach
                    </ul> 
                </div>
            </div>
        </div>
        <!--main1_right结束-->
    </div>
    <!--main1 wth结束-->
    <div class="main2 wth">
        <div class="main2_doc clearfix">
            <i class="fl"></i>
            <ul>
                <li><a href="/" class="all">全部({{ $item_count }})</a></li>
                @foreach($cates as $cate)
                <li><a href="/cate/{{ $cate->id }}">{{ $cate->name }}({{ $cate->count }})</a></li>
                @endforeach
            </ul>	
            <button type="button" class="searchbtn fr" style="display:none;"></button>
            <input type="text" class="searchword fr" placeholder="搜索商品" style="display:none;">
        </div>                                      
    </div><!--main2 wth结束-->	
</div>
<!--main wth结束-->
</div>
<!--main结束-->
<div class="goods clearfix">
    <div class="goods1 wth clearfix">
        <div class="newdays1 newds1 clearfix">
            <i></i>
            <p>每天10点上新</p>
        </div>
        <!--newdays1结束-->
        <ul class="mg clearfix">
            @foreach($position_list as $item)
            <li class="good1_one fl">
                <div class="goods-a">
                    <a href="/detail/{{ $item->id }}" target="_blank"><img src="http://acdn.taokezhushou.com/{{ $item->pic_url }}@1e_1c_0o_0l_287h_287w_100q.src" width="287" height="287"></a>
                    @if($item->created_at->format('Y-m-d H:i:s') > date('Y-m-d 00:00:00'))
                        <div class="newdays2 newd2"></div>
                    @endif
                    <div class="title">
                        <i class="tit{{ $item->shop_type }}"></i>
                        <p><a href="/detail/{{ $item->id }}" target="_blank">{{ str_limit($item->title, 32, '') }}</a></p>
                    </div>
                    <div class="coupon">优惠券<span class="num1 gd_wd">{{ $item->activities[0]->amount }}</span>元，剩余数量<span class="num2 gd_wd">{{ $item->activities[0]->surplus }}</span>/<span class="num3">{{ $item->activities[0]->receive + $item->activities[0]->surplus }}</span></div>
                    <div class="commission">
                        <ul>
                            <li class="com1 gd_wd2 fl">佣金<span>{{ $item->commission_rate }}%</span></li>
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
    </div>
    <!--goods1 wth结束-->
    <a name="new" id="new"></a>
    <div class="goods2 wth clearfix">
        <div class="goods1">
            <div class="newdays1 newds2">
                <i></i>
                <p>每天10点上新</p>
            </div>
            <!--newdays1结束-->
            <ul class="mg clearfix">
                @foreach($home_list as $key => $item)
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
        </div>
        <!--goods1 wth结束-->
    </div>
    <!--goods2结束-->
    <div class="pages wth">
    {!! with(new \App\Foundations\Pagination\CustomerPresenter($home_list->fragment('new')))->render() !!}
    </div>
</div>
@endsection
@section('footer_js')
<script type="text/javascript" src="{{ asset('statics/js/index1.js?v1.0') }}"></script>
@endsection

