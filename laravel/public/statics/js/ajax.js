$(document).ready(function(){
	$.ajax({
		url:'index4-qq.html',
		type:'get',
		dataType:'html',
		success:function(result){
			$(".qq-weixin-case").html(result);
			$(".qq-weixin-case").css("background-image","none");
		}

	});
	$(".casenav").click(function(){
		$(".qq-weixin-case").html("");
		$(this).addClass('navactive').siblings().removeClass('navactive');
		$(".qq-weixin-case").css("background-image","url(images/loading.gif)");
		var pageurl=$(this).attr('page');			
		$.ajax({
			url:pageurl,
			type:'get',
			dataType:'html',
			success:function(result){
				$(".qq-weixin-case").html(result);
				$(".qq-weixin-case").css("background-image","none");		
			}
		});
	});
});