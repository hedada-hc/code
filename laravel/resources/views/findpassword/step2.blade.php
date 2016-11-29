@extends('findpassword.common')
@section('content')
	<div class="main-title">
		<p class="title-lf1">找回密码</p>
	</div>
	<div class="main-infro infro-height">
		<div class="infro-img">
			<i class="infro-img2"></i>
		</div>
		<p class="phone-text">淘客助手已向您的手机<span>{{ substr_replace(Session::get('findpassword_mobile'), '****', 3, 4) }}</span>发送了短信验证码，请及时查看！</p>
		<div class="content-landing themargin">
			<form action="" method="post" id="register">
				{{ csrf_field() }}
				<ul>
					<li  id="verify_display">
						<label class="normal fl">短信验证码：</label>
						<input class="normal-input code-input fl" id="code" name="code" type="text" placeholder="验证码">
						<button id="sendsms">点击获取验证码</button>
						<div class="error-box fl" id="code_warn">
							@if($errors->has('findpassword_code_error'))
								<p class="tip"><span style="color:red">{{ $errors->first("findpassword_code_error") }}</span></p>
							@else
								<p class="tip"></p>
							@endif
						</div>
					</li>
					<li>
						<label class="normal fl"></label>
						<div class="botn">
							<input type="submit" class="sub" value="确 定" >
						</div>
					</li>
				</ul>
			</form>
		</div>
	</div>
	<script>
		var djs = 60;
		function waitSend(){
			setTimeout(function(){
				if(djs > 0){
					$('#sendsms').attr('disabled','disabled');
					$('#sendsms').empty().text(djs + '秒后重新获取');
					djs--;
					waitSend();
				}else{
					$('#sendsms').removeProp('disabled');
					$('#sendsms').empty().text('获取验证码');
					djs = 60;
				}
			},1000);
		}
		@if(!$errors->has('findpassword_code_error'))
			$.get('/findpassword/sendsms', function(response){
				if(response.status == 'error'){
					djs = response.wait;
				}
				waitSend();
			});
		@endif
		$('#sendsms').on('click', function(){
			$.get('/findpassword/sendsms', function(response){
				if(response.status == 'error'){
					djs = response.wait;
				}
				waitSend();
			});
		});
	</script>
@endsection
@section('header_js')
<script type="text/javascript" src="{{ asset('statics/js/findpassword-additional-methods.js') }}?v3"></script>
<script type="text/javascript" src="{{ asset('statics/js/find-password2.js') }}?v3"></script>
@endsection