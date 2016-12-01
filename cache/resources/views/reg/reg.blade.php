@extends('common.head')
@section('content')
	<script type="text/javascript">
	$(function(){
	     jsonajax();
	});
//这里就要进行计算滚动条当前所在的位置了。如果滚动条离最底部还有100px的时候就要进行调用ajax加载数据
	 $(window).scroll(function(){    
	     //此方法是在滚动条滚动时发生的函数
	     // 当滚动到最底部以上100像素时，加载新内容
	     var $doc_height,$s_top,$now_height;
	     $doc_height = $(document).height();        //这里是document的整个高度
	     $s_top = $(this).scrollTop();            //当前滚动条离最顶上多少高度
	     $now_height = $(this).height();            //这里的this 也是就是window对象
	     if(($doc_height - $s_top - $now_height) < 100) jsonajax();    
	 });
	 num =1;
	  function jsonajax(){

	  	if(num==1){
	  		$.post("{{url('reg/loing')}}",{_token:"{{csrf_token()}}",id:'123'},function(){

	  		});
	  	}
	  	num=0;	
	  }

	</script>
	<div class="header">
		<div class="content">
			
		<a href="javascript:;" class="btn">更新缓存</a>	
		@foreach($dd as $k=>$v)
			<nav id="more">
				<a target="new" href="{{url('show/'.$v['id'])}}" rel="文章标题">{{$v['titles']}}</a>

				<p rel="发布时间">PHP识别二维码的方法(php-zbarcode安装与使用)PHP使用PHPExcel删除Excel单元格指定列的方法PHPExcel合并与拆分单元格的方法</p>
				<span href="" rel="发布时间">{{date('Y-m-d H:i:s',$v['times'])}}</span>
				<span href="" rel="发布时间">ID:{{$v['id']}}</span>
			</nav>
		@endforeach	
		<a href="javascript:;" class="get_more">::点击加载更多内容::</a>
		</div>
	</div>
	<script type="text/javascript">
		$(function(){
			alert(window.scrollTop());
			$('.btn').click(function(){
				$.post("{{url('/reg/ajax')}}",{_token:'{{csrf_token()}}',dr:1},function(db){
					alert(db.static);
				});
			})

			 if($(window).scrollTop()==($(document).height()-$(window).height())){
			 	$.post("{{url('/reg/ajax')}}",{_token:'{{csrf_token()}}',dr:1},function(db){
					alert(db.static);
				});
			 }
		})


</script>
		
	</script>
@endsection