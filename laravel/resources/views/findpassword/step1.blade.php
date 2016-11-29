@extends('findpassword.common')
@section('content')
	<div class="main-title">
		<p class="title-lf1">找回密码</p>
	</div>
	<div class="main-infro">
		<div class="infro-img">
			<i class="infro-img1"></i>
		</div>
		<p class="infro-mgc">通过注册手机号找回密码</p>
		<div class="content-landing">
			<form action="" method="post" id="findpassword">
				{{ csrf_field() }}
				<ul>
					<li class="clearfix" id="emailMatch_list">
						<label class="normal fl">手机号码：</label>
						<input class="normal-input fl" type="text" id="phone" name="phone"/>
						<div class="error-box fl" id="email_warn">
							<strong class="error" style="display:none"></strong>
							<p class="tip">请输入手机号码</p>
						</div>
					</li>
					<li>
						<label class="normal fl"></label>
						<div class="botn">
							<input type="submit" class="sub" value="下一步" >
						</div>
					</li>
				</ul>
			</form>
		</div>
	</div>
	<script>
		@if($errors->has('no_phone'))
			layer.alert('{{ $errors->first("no_phone") }}');
		@endif
	</script>
@endsection
@section('header_js')
<script type="text/javascript" src="{{ asset('statics/js/findpassword-additional-methods.js') }}?v32"></script>
<script type="text/javascript" src="{{ asset('statics/js/find-password1.js') }}?v32"></script>
@endsection