<!DOCTYPE html>
<html>
<head>
	<title>用户注册 淘客助手-让推广更高效</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="{{ asset('statics/css/user-common.css') }}?v1.3">
    <link rel="stylesheet" type="text/css" href="{{ asset('statics/css/register.css') }}?v1.3">
	<script src="{{ asset('statics/js/jquery-1.10.1.min.js') }}?v1.3"></script> 
    <script type="text/javascript" src="{{ asset('statics/layer/layer.js') }}?v1.3"></script>
    <script src="{{ asset('statics/js/jquery.validate.min.js') }}?v1.3"></script> 
    <script src="{{ asset('statics/js/additional-methods.js') }}?v1.3"></script> 
    <script>
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
        });
    </script>
    <!-- 引入封装了failback的接口--initGeetest -->
    <script src="http://static.geetest.com/static/tools/gt.js"></script>
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
			<p class="title-lf1 fl">新用户注册</p>
			<p class="title-lf2 fl">/</p>
			<p class="title-lf3 fl">注册淘客助手，高效推广</p>
			<p class="title-rt1 fr">已有账号,<span class="title-rt2"><a href="/login">立即登录</a></span></p>
		</div>
		<div class="main-infro clearfix">
            <div class="geetest" style="width:365px;margin-top:20px;float:left;display:none">
                <div id="embed-captcha"></div>
                <p id="wait" class="show">正在加载验证码，如果长时间不出来，请刷新页面......</p>
                <p id="notice" class="hide">请先拖动验证码到相应位置</p>
            </div>
            <div class="content-landing fl">
                <form id="register">
                    <ul>
                        <li id="emailMatch_list">
                            <div class="clearfix">
                                <label class="normal fl">手机号码：</label>
                                <input class="normal-input fl" type="text" id="phone" name="phone"/>
                                <div class="error-box fl" id="email_warn">
                                    <strong class="error" style="display:none"></strong>
                                    <p class="tip">请输入手机号码</p>
                                </div>
                            </div>
                        </li>                     
                        <li  id="verify_display">
                            <label class="normal fl">验证码：</label>
                            <input class="normal-input code-input fl" id="code" name="code" type="text" placeholder="验证码" autocomplete="off"/>
                            <button id="sendVerifySmsButton">点击获取验证码</button>
                            <div class="error-box fl" id="code_warn">
                                <p class="tip"></p>
                            </div>
                        </li>
                        <li class="set-password clearfix">
                            <label class="normal fl">登录密码：</label>
                            <input type="password" class="normal-input fl" id="password" name="password"/>
                                <div class="error-box fl" id="password_warn">
                                <strong class="error" style="display:none"></strong>
                                <p class="tip" style="display:none">请输入密码</p>
                                <!-- <p class="msg_error" style="display:none"></p> -->
                                </div>  
                        </li>
                        <li>
                            <label class="normal fl"></label>
                            <div class="botn">
                                <input type="submit" class="sub" value="立即注册" >
                            </div>
                        </li>
                        <li class="agreement">
                            <div class="agree">
                                <span>
                                    <label>
                                        <input type="checkbox" class="ck fl" name="agree" checked="checked">
                                        同意<a href="#" target="_blank" >《淘客助手网络服务使用协议》</a>
                                    </label>
                                </span>
                            </div>
                        </li>
                    </ul>
                </form>
            </div>
            
			<div class="infro-right fr">
				<a href="#"><img src="{{ asset('statics/images/main_fr.png') }}" alt="淘客助手，让推广更高效"></a>
                <!--
				<div class="qq-wx">
					<p>无需注册，快捷登录</p>
					<a href="#" class="qq"></a>
					<a href="#" class="weixin"></a>
					<a href="#" class="weibo"></a>
				</div>-->
			</div>
		</div>
	</div>
	<div class="foot wth">
		<p>武汉云析网络科技有限公司&nbsp;鄂ICP备10209250号&nbsp;|&nbsp;ICP许可证号：鄂B1-20150109&nbsp;|&nbsp;Copyright &copy;&nbsp;2010-2016&nbsp;taokezhushou.com All Rights Reserved</p>
	</div>
    <script src="{{ asset('statics/js/register.js') }}?v1.3"></script> 
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