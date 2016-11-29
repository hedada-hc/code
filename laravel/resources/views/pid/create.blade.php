@extends('layouts.home')
@section('seo_title', '设置PID 淘客助手-让推广更高效')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('statics/css/common.css') }}?v1.3">
<link rel="stylesheet" type="text/css" href="{{ asset('statics/css/pidcom.css') }}?v1.3">
<link rel="stylesheet" type="text/css" href="{{ asset('statics/css/addpid.css') }}?v1.3">
@endsection
@section('header_js')
<script src="{{ asset('statics/js/jquery.validate.min.js') }}?v1.3"></script>  
<script src="{{ asset('statics/js/additional-methods.js') }}?v1.3"></script>
<script type="text/javascript" src="{{ asset('statics/js/pidform.js') }}?v1.3"></script>  
@endsection
@section('content')
	<div class="pidmain clearfix">
		<div class="leftsidebar fl">
			<h2>账号设置</h2>
			<ul>
				<li class="pid1"><a href="/pid">
					<i class="img1"></i>
					<p class="con1">PID管理</p></a>
				</li>
				<li><a href="/updatepassword">
					<i class="img2"></i>
					<p class="con2">修改密码</p></a>
				</li>
			</ul>	
		</div>
		<div class="pid-set fl">
			<p class="title">添加PID</p>
			<div class="pid-infro">
				<form action="/pid" method="post" id="pid">
                {!! csrf_field() !!}
                <ul>
                    <li class="group-name clearfix">
                        <label class="normal fl">分组名称：</label>
                        <input type="text" class="normal-input fl" id="name" name="name" placeholder="请输入分组名称"/>
                         <div class="error-box fl">
                            @if($errors->first('name'))
                            <p class="tip" style="color:red">{{ $errors->first('name') }}</p>
                            @else
                            <p class="tip" style="display:none">请输入分组名称</p>
                            @endif
                         </div>  
                    </li>
                    <li class="clearfix">
                        <label class="normal fl">通用PID：</label>
                        <input type="text" class="normal-input fl" id="common_pid" name="common_pid" placeholder="请输入通用PID"/>
                         <div class="error-box fl">
                            @if($errors->first('common_pid'))
                            <p class="tip" style="color:red">{{ $errors->first('common_pid') }}</p>
                            @else
                            <p class="tip" style="display:none">请输入通用PID</p>
                            @endif
                         </div>   
                    </li>
                    <li class="clearfix">
                        <label class="normal fl">鹊桥PID：</label>
                        <input type="text" class="normal-input fl" id="queqiao_pid" name="queqiao_pid" placeholder="请输入鹊桥PID"/>
                        <div class="error-box fl">
                            @if($errors->first('queqiao_pid'))
                            <p class="tip" style="color:red">{{ $errors->first('queqiao_pid') }}</p>
                            @else
                            <p class="tip" style="display:none">请输入鹊桥PID</p>
                            @endif
                         </div>   
                    </li>   
                    <li>
                        <div class="botn1 fl">
                            <input type="submit" class="sub1" value="保 存" >
                        </div>
                        <div class="botn2 fl">
                            <button class="sub2" onclick="window.location.href = '/pid';return false;">取 消</button>
                        </div>
                    </li>       
                </ul>
            </form>
			</div>
			<div class="the-prompt">
				<div class="prompt-infro fl">
					<p class="infro1">温馨提示</p>
					<p class="infro2">普通PID：平时你在阿里后台转链打开后的三段式PID</p>
					<p class="infro3">鹊桥高佣PID：转链统一从联盟鹊桥高佣获取，和普通PID的获取方式一样。此项要求填写，一方面可以分别统计推广效果，另外可以分散风险！</p>
					<p class="infro4">示例：PID为三段式，如 mm_12311550_2344296_9002527</p>
				</div>
				<div class="fl">
					<img src="{{ asset('statics/images/girl.png') }}" alt="">
				</div>
			</div>
		</div>
	</div>
@endsection
@section('footer_js')
@endsection