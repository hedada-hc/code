<!DOCTYPE html>
<html>
<head>
	<title>用户登录 淘客助手-让推广更高效</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="{{ asset('statics/css/user-common.css') }}?v1.3">
	<link rel="stylesheet" type="text/css" href="{{ asset('statics/css/login.css') }}?v1.3">
	<script src="{{ asset('statics/js/jquery-1.10.1.min.js') }}?v1.3"></script> 
    <script type="text/javascript" src="{{ asset('statics/layer/layer.js') }}?v1.3"></script>
    <script src="{{ asset('statics/js/jquery.validate.min.js') }}?v1.3"></script> 
    <script src="{{ asset('statics/js/additional-methods.js') }}?v1.3"></script>
    <script src="{{ asset('statics/js/login.js') }}?v1.3"></script> 
    <script>
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
        });
    </script>
</head>
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
		<div class="main-title">
			<p class="title-lf1 fl">老用户登录</p>
			<p class="title-lf2 fl">/</p>
			<p class="title-lf3 fl">尊敬的淘客助手用户，欢迎您回来</p>
			<p class="title-rt1 fr">还没有账号?<span class="title-rt2"><a href="/register">立即去注册</a></span></p>
		</div>
		<div class="main-infro">
 			<div class="infro-left fl">		
				<div class="content-landing">
	                <form action="" method="post" id="register">
                        {!! csrf_field() !!}
	                    <ul>
	                        <li id="emailMatch_list">
	                            <div class="clearfix">
	                                <label class="normal fl">手机号码：</label>
	                                <input class="normal-input fl" type="text" id="phone" name="mobile"/>
	                                <div class="error-box fl" id="email_warn">
	                                    <strong class="error" style="display:none"></strong>
	                                    <p class="tip">请输入手机号码</p>
	                                </div>
	                            </div>
	                        </li>
	                        <li class="set-password clearfix">
                                <label class="normal fl">密码：</label>
                                <input type="password" class="normal-input fl" id="password" name="password"/>
                                 <div class="error-box fl" id="password_warn">
                                    <strong class="error" style="display:none"></strong>
                                    <p class="tip" style="display:none">请输入密码</p>
                                    @if($errors->has('user_login_failed'))
                                    <p class="tip" style="color:red">{{ $errors->first('user_login_failed') }}</p>
                                    @endif
                                 </div>  
	                        </li>
	                        <li class="logintime clearfix">
                                <label>
		                            <input type="checkbox" class="ck fl" name="remember" checked>两周内免登录
		                            <span><a href="/findpassword/step1">忘记密码？</a></span>
                          		</label>  
	                        </li>
	                        <li class="login-botn">
	                            <label class="normal fl"></label>
	                            <div class="botn">
	                                <input type="submit" class="sub" value="立即登录" >
	                            </div>
	                        </li>   
	                    </ul>
	                </form>
	            </div>
                <!--
				<div class="qq-wx">
					<span class="fl">合作网站账号登录:</span>
					<a href="#" class="qq"></a>
					<a href="#" class="weixin"></a>
					<a href="#" class="weibo"></a>
				</div>-->
			</div>	
			<div class="infro-right fr">
				<img src="{{ asset('statics/images/mainfr.png') }}" alt="淘客助手，让推广更高效" style="width:372px;height:207px;">
			</div>
		</div>
	</div>
	<div class="foot wth">
		<p>武汉云析网络科技有限公司&nbsp;鄂ICP备10209250号&nbsp;|&nbsp;ICP许可证号：鄂B1-20150109&nbsp;|&nbsp;Copyright &copy;&nbsp;2010-2016&nbsp;taokezhushou.com All Rights Reserved</p>
	</div>
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