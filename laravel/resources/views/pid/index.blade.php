@extends('layouts.home')
@section('seo_title', '设置PID 淘客助手-让推广更高效')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('statics/css/common.css') }}?v1.3">
<link rel="stylesheet" type="text/css" href="{{ asset('statics/css/pidcom.css') }}?v1.3">
<link rel="stylesheet" type="text/css" href="{{ asset('statics/css/setpid.css') }}?v1.3">
@endsection
@section('content')
	<!--hd结束-->
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
			<p class="title">PID设置</p>
			<div class="set-infro">
				<a href="/pid/create" class="addinfro">添&nbsp;加</a>
				<table>
					<tr class="td-back">
					  <td class="td1">分组名称</td>
					  <td class="td2">通用PID</td>
					  <td class="td2">鹊桥PID</td>
					  <td class="td3">操作</td>
					</tr>
					@if(count($pids))
					@foreach($pids as $pid)
					<tr>
					  <td class="td1">{{ $pid->name }}</td>
					  <td class="td2">{{ $pid->common_pid }}</td>
					  <td class="td2">{{ $pid->queqiao_pid }}</td>
					  <td class="td3">
							<a href="/pid/{{ $pid->id }}/edit">修改&nbsp;</a>|&nbsp;
							<form method="POST" action="/pid/{{ $pid->id }}">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<input type="hidden" name="_method" value="DELETE">
								<input type="submit" name="_method" value="删除" class="del">
							</form>
						</td>
					</tr>
					@endforeach
					@else
					<tr>
					  <td class="td1" colspan="4" style="text-align:center">您还没有设置推广PID哦</td>
					</tr>
					@endif
				</table>
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
<script>
$(function(){
	$('.del').click(function(){
		var _form = $(this).parent();
		layer.confirm('确定删除？不可恢复哦', function(index){
			layer.close(index);
			_form.submit();
		});
		return false;
	});
});
</script>
@endsection
