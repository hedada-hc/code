@extends('layouts.home')
@section('seo_title', '修改密码 淘客助手-让推广更高效')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('statics/css/common.css') }}?v1.3">
<link rel="stylesheet" type="text/css" href="{{ asset('statics/css/pidcom.css') }}?v1.3">
<link rel="stylesheet" type="text/css" href="{{ asset('statics/css/passwordpid.css') }}?v1.3">
@endsection
@section('header_js')
<script src="{{ asset('statics/js/jquery.validate.min.js') }}?v1.3"></script>  
<script src="{{ asset('statics/js/additional-methods.js') }}?v1.3"></script>
<script type="text/javascript" src="{{ asset('statics/js/passwordpid.js') }}?v1.3"></script>  
@endsection
@section('content') 
	<div class="pidmain clearfix">
		<div class="leftsidebar fl">
			<h2>账号设置</h2>
			<ul>
				<li><a href="/pid">
					<i class="img1"></i>
					<p class="con1">PID管理</p></a>
				</li>
				<li class="pid1"><a href="/updatepassword">
					<i class="img2"></i>
					<p class="con2">修改密码</p></a>
				</li>
			</ul>	
		</div>
		<div class="change-password fl">
			<p class="title">修改密码</p>
			<form action="" method="post" id="register">
                {{ csrf_field() }}
                <ul>
                    <li class="old-password clearfix">
                        <label class="normal fl">原始密码：</label>
                        <input type="password" class="normal-input fl" id="old_password" name="old_password" placeholder="请输入原始密码"/>
                         <div class="error-box fl">
                            @if($errors->has('old_password_error'))
                              <p class="tip" style="color:red">{{ $errors->first('old_password_error') }}</p>
                            @endif
                            <p class="tip" style="display:none">请输入原始密码</p>
                         </div>  
                    </li>
                    <li class="new-password clearfix">
                        <label class="normal fl">新密码：</label>
                        <input type="password" class="normal-input fl" id="password" name="password" placeholder="请输入新密码(6-16位)"/>
                         <div class="error-box fl">
                            <p class="tip" style="display:none">请输入新密码</p>
                         </div>   
                    </li>
                    <li class="clearfix">
                        <label class="normal fl">确认新密码：</label>
                        <input type="password" class="normal-input fl" id="confirm_password" name="confirm_password" placeholder="请再次输入新密码"/>
                        <div class="error-box fl">
                            <p class="tip" style="display:none">请再次输入新密码</p>
                         </div>   
                    </li>   
                    <li>
                        <div class="botn1 fl">
                            <input type="submit" class="sub1" value="保 存" >
                        </div>
                        <div class="botn2 fl">
                            <input type="reset" class="sub2" value="取 消">
                        </div>
                    </li>       
                </ul>
            </form>
		</div>
	</div>
@endsection
@section('footer_js')
@endsection