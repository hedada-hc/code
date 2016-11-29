<!DOCTYPE html>
<html>
<head>
	<title>@section('seo_title') 淘客助手-让推广更高效 @show</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="{{ asset('statics/css/user-common.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('statics/css/find-password.css') }}?v3">
	<script src="{{ asset('statics/js/jquery-1.10.1.min.js') }}"></script> 
	<script type="text/javascript" src="{{ asset('statics/layer/layer.js') }}"></script>
    <script src="{{ asset('statics/js/jquery.validate.min.js') }}"></script> 
	@section('header_js')
	@show
	@section('header_css')
	@show
</head>
<body>
<body>
	<div class="header">
		<div class="logo wth">
			<div class="logoleft fl">
				<a href="/"><img src="{{ asset('statics/images/logo.png') }}"></a>
			</div>
			<div class="logoright fr">
				<img src="{{ asset('statics/images/logoright.png') }}">
			</div>
		</div>
	</div>
	<!--header结束-->
	<div class="main wth">
		@yield('content')	
	</div>
	<div class="foot wth">
		<p>武汉云析网络科技有限公司&nbsp;鄂ICP备13004955号-2&nbsp;|&nbsp;Copyright &copy;&nbsp;2010-2016&nbsp;Taokezhushou.com All Rights Reserved</p>
	</div>
</body>
</html>		