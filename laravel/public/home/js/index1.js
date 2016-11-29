$(document).ready(function(e){
	var banner=$('.banner').unslider({
    	dots: true,
    	delay:2000
    });
    if(navigator.userAgent.match(/(iPhone|iPad|Android|ios)/i)){
        var theW=window.innerWidth
        || document.documentElement.clientWidth
        || document.body.clientWidth;
        $("body,html").css({"width": theW,"overflow-x":"hidden"});
    }
    
	$("ul").siblings('.message1').show();
	$(".right-nav1 a").css("background-color","#fff");
	$("ul").siblings('.message2').hide();
	$("ul").siblings('.message3').hide();

	$('.right-nav1').hover(function(){
		$("ul").siblings('.message1').show();
		$(".right-nav1 a").css("background-color","#fff");
		$(".right-nav2 a").css("background-color","#fafafa");
		$(".right-nav3 a").css("background-color","#fafafa");
        $("ul").siblings('.message2').hide();
        $("ul").siblings('.message3').hide();
    });

	$('.right-nav2').hover(function(){
		$("ul").siblings('.message2').show();
		$(".right-nav2 a").css("background-color","#fff");
		$(".right-nav1 a").css("background-color","#fafafa");
		$(".right-nav3 a").css("background-color","#fafafa");
        $("ul").siblings('.message1').hide();
        $("ul").siblings('.message3').hide();
    });
    $('.right-nav3').hover(function(){
		$("ul").siblings('.message3').show();
		$(".right-nav3 a").css("background-color","#fff");
		$(".right-nav1 a").css("background-color","#fafafa");
		$(".right-nav2 a").css("background-color","#fafafa");
        $("ul").siblings('.message1').hide();
        $("ul").siblings('.message2').hide();
    }); 

    $(window).scroll(function(){
        var sc=$(window).scrollTop();
        var rwidth=$(window).width()+$(document).scrollLeft();
        var rheight=$(window).height()+$(document).scrollTop();
        if(sc>0){
            $("#goTop").show();
        }else{
            $("#goTop").hide();
        }
    });
    $("#goTop").click(function(){
        $('body,html').animate({scrollTop:0},1000);
    }); 

    $("img.lazy").lazyload({
        effect:"fadeIn",
        placeholder:"images/waiting.png"
    });  


    $(".pricetrend").hide();
    $(".price").mouseenter(function(){
        $(".pricetrend").show();
        $(".pricetrend").find("a").css("border","none");
    });
    $(".price").mouseleave(function(){
        $(".pricetrend").hide();
    });

    $(".commission_rate_trend").hide();
    $(".commission").mouseenter(function(){
        $(".commission_rate_trend").show();
        $(".commission_rate_trend").find("a").css("border","none");
    });
    $(".commission").mouseleave(function(){
        $(".commission_rate_trend").hide();
    });  

    var HostUrl = document.URL.toLowerCase();//获取url地址，并全部小写化
    if (HostUrl.indexOf("page".toLowerCase())!=-1){//检测是否包含“page”字段
        window.location="#new" //若包含则跳转到指定页面
    }

    var sumError="";
    $('#error_type span').click(function(){
        if($(this).hasClass("active")){
            $(this).removeClass("active");            
            var errorVal=$(this).text();           
            sumError=sumError.replace(errorVal,'');
            $('#choose_errortype').val(sumError);
            //console.log($('#choose_errortype').val());
        }else{
            $(this).addClass("active");
            var errorVal=$(this).text();
            sumError+=errorVal;
            $('#choose_errortype').val(sumError);
            //console.log($('#choose_errortype').val());
        }
    });

    $('.goods-error').on('click', function(){
        var index=layer.open({
            type: 1,
            shade: [0.4, '#000'],
            shadeClose:true,
            btn:['提交','返回'],
            title: false, 
            area:'670px',
            content: $('.layer-error'),
            yes: function(index){
                layer.msg('感谢您的反馈', {icon: 6});
                layer.close(index); 
            },btn2:function(index){
                layer.close(index); 
            },
            cancel: function(index){
                $('#error_type li').removeClass("active");
                $("#layerform")[0].reset();
                layer.close(index);
            }           
        });     
    });
});