<!DOCTYPE html>
<html>
<head>
	<title>@section('seo_title') 淘客助手-让推广更高效 @show</title>
	<meta charset="utf-8" />
	<meta name="keywords" content="@section('seo_keywords')淘客助手、鹊桥活动、淘宝客、淘宝客活动、鹊桥查询@show"/>
	<meta name="description" content="@section('seo_description')淘客助手是一款淘宝客（鹊桥）活动商品查询软件，并集成强大的自定义筛选功能，帮您迅速找到高佣金高转化的推广商品。@show"/>
	<link rel="Bookmark" href="/favicon.ico" />
	<link rel="Shortcut Icon" href="/favicon.ico" />
	@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('statics/css/common.css') }}?v1.3">
	<link rel="stylesheet" type="text/css" href="{{ asset('statics/css/indexcom.css??v1.3') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('statics/css/index1.css') }}?v1.4">
	<link rel="stylesheet" type="text/css" href="{{ asset('/font/iconfont.css') }}">
	@show
	<script src="{{ asset('statics/js/jquery-1.10.1.min.js') }}"></script>  
	<script src="{{ asset('statics/js/jquery.lazyload.js') }}"></script>

	<!--[if (gte IE 6)&(lte IE 8)]>
      <script type="text/javascript" src="{{ asset('statics/js/selectivizr.js') }}"></script>
	<![endif]--> 
	@section('header_js')
	@show
</head>
<body>
	<div class="hd">
		<div class="hd1">
			<div class="hd1 wth">
			<div class="hd1_left fl">
				@include('jiaqun.index')
			</div> 
			<div class="hd1_right fr">
				<ul>
					@if(Auth::check())
					<li>当前登录用户：{{ substr_replace(Auth::user()->mobile,'****',3,4) }}</li>
					<li><a href="/pid">用户中心</a></li>
					<li><a href="/logout">退出登录</a></li>
					@else
					<li><a href="/login">登录</a></li>
					<li><a href="/register">免费注册</a></li>
					@endif
					<li><a href="#">收藏本站</a></li>
					<li><a href="#">设为首页</a></li>
				</ul>
			</div><!--hd1_right结束-->
			</div><!--hd1 wth结束-->
		</div><!--hd1结束-->
		<div class="logo">
			<div class="hd2 clearfix wth">
				<h1 class="hd2_left fl"><a href="/"><img src="{{ asset('statics/images/logo.png') }}" alt="淘客助手" width="207" height="60"></a></h1>
				<div class="hd2_search fl">
					<span><a href="/" class="search">站内搜索</a></span>
					<span><a href="http://queqiao.taokezhushou.com" target="_blank">鹊桥搜索</a></span>
					<form action="/search" method="get">
					<input type="text" class="search_text fl" placeholder="请输入您要搜索关键字或淘宝链接" name="q" value="{{ Request()->input('q') }}"/>
					<input type="submit" value="搜 索" class="search_btn fl">
					</form>
				</div>
				<div class="hd2_right fr"><img src="{{ asset('statics/images/logofr.png') }}" alt="让推广更高效" width="122" height="100"></div>
			</div><!--hd2 wth结束-->
			<div class="hd_nav wth">
					@section('header_title')
					<ul>
						<li class="nav1"><a href="/" class="navone">首页</a></li>
						<li><a class="hv" href="/top100">实时热推榜<i></i></a></li>
						<li><a class="hv" href="javascript:layer.alert('相关教程正在录制....');">淘客学院</a></li>
						<li><a class="hv" href="javascript:layer.alert('API接口暂未开放，测试稳定后我们会及时放出');">开放API</a></li>
						<li><a class="hv" href="javascript:layer.alert('圈子功能正在开发，上线还需要一点点时间');">淘客圈子</a></li>
					</ul>
					@show
			</div>
			<!--hd_nav wth结束-->
		</div>
	</div>
	<!--hd结束-->
	@yield('content')
	<div class="foot">
		<div class="foot1 wth">
			<ul>
			<li><img src="{{ asset('statics/images/foot1.png') }}" alt="二维码"></li>
			<li>帮助中心
				<ul><li><a href="#">淘宝助手安装指南</a></li></ul>
			</li>
			<li>常见问题
				<ul>
					<li><a href="#">招商规则</a></li>
					<li><a href="#">违规商家处罚</a></li>
					<li><a href="#">商家如何报名</a></li>
				</ul>
			</li>
			<li>投诉意见
				<ul>
					<li><a href="#">招商违规投诉</a></li>
					<li><a href="#">应用建议</a></li>
				</ul>
			</li>
			<li>关于我们
				<ul>
					<li><a href="#">关于我们</a></li>
					<li><a href="#">联系我们</a></li>
				</ul>
			</li>
			<li class="images_ft02"></li>
			</ul>
		</div>
		
		<div class="foot2">
			<div class="foot2_image wth">
				<ul>
					<li class="imageone"></li>
					<li class="imagetwo"></li>
					<li class="imagethree"></li>
					<li class="install"><a href="http://dl.taokezhushou.com" target="_blank"></a></li>
				</ul>	
			</div>
		</div>
	</div><!--foot结束-->
	<div id="goTop" class="goTop"></div>
	<script type="text/javascript" src="{{ asset('statics/layer/layer.js') }}?v1.3"></script>
	<script type="text/javascript" src="{{ asset('statics/js/common.js') }}?v1.3"></script>
	@section('footer_js')
	@show
	@if(env('OPEN_TAOKE_URL', false))
	<script type="text/javascript">
		(function(win,doc){
			var s = doc.createElement("script"), h = doc.getElementsByTagName("head")[0];
			if (!win.alimamatk_show) {
				s.charset = "gbk";
				s.async = true;
				s.src = "http://a.alimama.cn/tkapi.js";
				h.insertBefore(s, h.firstChild);
			};
			var o = {
				pid: "mm_14726460_18354212_65648203",/*推广单元ID，用于区分不同的推广渠道*/
				appkey: "",/*通过TOP平台申请的appkey，设置后引导成交会关联appkey*/
				unid: "",/*自定义统计字段*/
				type: "click" /* click 组件的入口标志 （使用click组件必设）*/
			};
			win.alimamatk_onload = win.alimamatk_onload || [];
			win.alimamatk_onload.push(o);
		})(window,document);
	</script>
	@endif
	<script>
		var _hmt = _hmt || [];
		(function() {
		var hm = document.createElement("script");
		hm.src = "//hm.baidu.com/hm.js?ea87033f35cb5b58a4cb26c5f661b891";
		var s = document.getElementsByTagName("script")[0]; 
		s.parentNode.insertBefore(hm, s);
		})();
	</script>
</body>
</html>