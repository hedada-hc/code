@extends('findpassword.common')
@section('content')
	<div class="main-title">
		<p class="title-lf1">找回密码</p>
	</div>
	<div class="main-infro">
		<div class="infro-img">
			<i class="infro-img3"></i>
		</div>
		<div class="content-landing landing-margin">
			<form action="" method="post" id="findpassword">
				{{ csrf_field() }}
				<ul>
					<li class="set-password clearfix">
						<label class="normal fl">新密码：</label>
						<input type="password" class="normal-input fl" id="password" name="password"/>
							<div class="error-box fl" id="password_warn">
							<strong class="error" style="display:none"></strong>
							<p class="tip" style="display:none">请输入新密码</p>
							<!-- <p class="msg_error" style="display:none"></p> -->
							</div>  
					</li>
					<li class="clearfix">
						<label class="normal fl">确认密码：</label>
						<input type="password" class="normal-input fl" id="password_confirmation" name="password_confirmation"/>
						<div class="error-box fl" id="confirm_password_warn">
							<strong class="error" style="display:none"></strong>
							<p class="tip" style="display:none">请再次输入密码</p>
						</div>   
					</li>
					<li>
						<label class="normal fl"></label>
						<div class="botn">
							<input type="submit" class="sub" value="确 认" >
						</div>
					</li>
				</ul>
			</form>
		</div>
	</div>
@endsection
@section('header_js')
<script type="text/javascript" src="{{ asset('statics/js/findpassword-additional-methods.js') }}?v32"></script>
<script type="text/javascript" src="{{ asset('statics/js/find-password3.js') }}?v31"></script>
@endsection