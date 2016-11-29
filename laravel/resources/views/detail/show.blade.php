@extends('layouts.home')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('statics/css/common.css') }}?v1.3">
<link rel="stylesheet" type="text/css" href="{{ asset('statics/css/indexcom.css') }}?v1.3">
<link rel="stylesheet" type="text/css" href="{{ asset('statics/css/index4.css') }}?v1.3">
<link rel="stylesheet" type="text/css" href="{{ asset('/font/iconfont.css') }}">
@endsection
@section('seo_title', $item['title'].'-淘客助手，让推广更高效')
@section('content')
<!--hd结束-->

<div class="subnav">
        <div class="subnav1 wth">
            <ul>
                <li class="sbnv1"><a href="/">全部({{ $item_count }})</a></li>
                @foreach($cates as $cate)
                <li><a href="/cate/{{ $cate->id }}">{{ $cate->name }}({{ $cate->count }})</a></li>
                @endforeach
            </ul>
        </div><!--subnav1 wth结束-->					
</div><!--subnav结束-->
<div class="goods clearfix">
    <div class="detail wth clearfix">
        <div class="dl-title">
            <i></i>
            <p>我的位置：<a href="/">首页</a>&nbsp;&gt;&nbsp;详情页</p>
        </div>
        <div class="dl-goods clearfix">
            <div class="goods-img fl">
                <a href="{{ 'https://item.taobao.com/item.htm?id='.$item->item_id }}" biz-itemid="{{ $item->item_id  }}" isconvert="1" target="_blank"><img src="http://acdn.taokezhushou.com/{{ $item->pic_url }}@1e_1c_0o_0l_395h_395w_100q.src" width="395" height="395"></a>
            </div>
            <div class="goods-intro fr">
                <div class="intro">
                    <div class="title">

                        <i class="tit{{ $item->shop_type }}"></i>
                        <h3>{{ str_limit($item->title, 76, '') }}</h3>
                    </div>
                    <p>{{ $item->intro ? $item->intro : '小编太懒，什么都没写~~~' }}</p>
                </div>
                <div class="intro1">
                    <ul>
                        <li class="tro1 fl">券后价&nbsp;&yen;&nbsp;<span>{{ round($item->price - $item->activities[0]->amount, 1) }}</span></li>
                        <li class="tro2 fl">在售价&nbsp;&yen;&nbsp;{{ round($item->price, 1) }}</li>
                        <li class="tro3 fl">目前销量：{{ $item->volume }}</li>
                        <li class="tro5 fr"><a href="javascript:layer.alert('此功能需要PC客户端的配合，我们正在紧张开发中，尽请期待');">加入推广</a></li>
                        <li class="tro4 fr"><a href="{{ $item->shop_type ? 'https://detail.tmall.com/item.htm?id='.$item->item_id : 'https://item.taobao.com/item.htm?id='.$item->item_id }}" biz-itemid="{{ $item->item_id  }}" isconvert="1" target="_blank">查看详情</a></li>
                    </ul>
                </div>
                <div class="intro2 clearfix">
                    <p class="int1 fl">优惠券&nbsp;<span>{{ $item->activities[0]->amount }}</span>&nbsp;元</p>
                    <p class="int2 fl">*单笔满{{ $item->activities[0]->applyAmount }}元可用，每人限领{{ $item->activities[0]->limit }}张</p>
                </div>

                <div class="intro3 clearfix">
                    <p class="int3 fl">优惠券剩余&nbsp;<span>{{ $item->activities[0]->surplus }}</span>&nbsp;张，已领券{{ $item->activities[0]->receive }}张，过期时间{{ date('Y/m/d', strtotime($item->activities[0]->effectiveEndTime)) }}</p>
                    <p class="int4 fr"><a href="javascript:void(0);" class="goods-error">商品有误？纠错</a></p>
                        <div class="layer-error" style="display:none;">
                            <form action="" method="post" id="layerform">
                                <input type="hidden" name="errorinfro" value="" id="choose_errortype">
                                <p class="error-title"><i></i>商品信息纠错</p>
                                <p class="error-goods"><label for="error_correction">纠错商品：</label><a href="#" id="error_correction">小白鞋女夏季平底休闲白色帆布鞋移交蹬女鞋透气懒人</a></p>
                                <div class="error-infro clearfix">
                                    <p class="e-infro1 fl">
                                        <label for="error_tyle"><em>*</em>纠错类型：<span>（可多选）</span></label>
                                    </p>
                                    <div class="fl" id="error_type">
                                        <span><strong error_id='0'>价格错误</strong><b></b></span>
                                        <span><strong error_id='1'>优惠券错误</strong><b></b></span>
                                        <span><strong error_id='2'>佣金不准</strong><b></b></span>
                                        <span><strong error_id='3'>计划失效</strong><b></b></span>
                                        <span><strong error_id='4'>商品伪劣/虚假</strong><b></b></span>
                                        <span><strong error_id='5'>其他</strong><b></b></span>
                                    </div>
                                </div>
                                <div class="text2">
                                    <span>简要描述：</span>
                                    <textarea class="depict" name="intro"></textarea>
                                </div>  
                                <p class="yoursqq"><label for="qq" >您的QQ：</label><input type="text" name="qq" id="qq">
                                    <span><i></i>淘客助手对长期参与维权的朋友给予奖励</span>
                                </p>
                            </form>
                        </div>
                </div>
                <div class="intro4">
                    <div class="intro4-left fl">
                        <ul class="clearfix">
                            <li class="intr1">佣金&nbsp;<span>{{ $item->commission_rate }}%</span></li>
                            <li class="intr2">{{ $item->plan_type }}计划</li>
                            <li class="intr3">{{ $item->review ? '人工审核' : '自动通过' }}</li>
                            @if($item->plan_type == '定向')
                                <li class="intr4"><a href="{{ $item->jihua_link }}" target="_blank">[点击申请计划]</a></li>
                            @elseif($item->plan_type == '鹊桥')
                                <li class="intr4"><a href="http://pub.alimama.com/promo/item/channel/index.htm?q=https%3A%2F%2Fitem.taobao.com%2Fitem.htm%3Fid%3D{{ $item->item_id }}&channel=qqhd" target="_blank">[点击获取鹊桥链接]</a></li>
                            @endif
                        </ul>
                        <p>PC端优惠券：<a href="https://taoquan.taobao.com/coupon/unify_apply.htm?sellerId={{ $item->activities[0]->seller_id }}&activityId={{ $item->activities[0]->activity_id }}&scene=taobao_shop" target="_blank">点击领取</a>&nbsp;&nbsp;手机端优惠券：<a href="http://shop.m.taobao.com/shop/coupon.htm?seller_id={{ $item->activities[0]->seller_id }}&activity_id={{ $item->activities[0]->activity_id }}" target="_blank">点击领取</a></p>
                        <p>商品链接：<a href="{{ $item->shop_type ? 'https://detail.tmall.com/item.htm?id='.$item->item_id : 'https://item.taobao.com/item.htm?id='.$item->item_id }}" biz-itemid="{{ $item->item_id  }}" isconvert="1" target="_blank"> {{ $item->shop_type ? 'https://detail.tmall.com/item.htm?id='.$item->item_id : 'https://item.taobao.com/item.htm?id='.$item->item_id }}</a></p>
                    </div>
                    <div class="intro4-right fr">
                        <img src="{{ asset('statics/images/erweima.png') }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="examplecase clearfix">
            <div class="casetitle">
                <p><i></i>发群模板示例</p>
            </div>
            <div class="exampleleft fl">
                <div id="wenan">
                    <img class="tui_pic" src="http://acdn.taokezhushou.com/{{ $item->pic_url }}@1e_1c_0o_0l_304h_304w_100q.src" copy-src="http://acdn.taokezhushou.com/{{ $item->pic_url }}" alt="牛仔裤"/><br/>
                    {{ $item->title }}<br/>
                    领券后{{ round($item->price - $item->activities[0]->amount, 1) }}元包邮<br/>
                    {{ $item->activities[0]->amount }}元内部券: <a class="exampleleft-a" href="http://shop.m.taobao.com/shop/coupon.htm?seller_id={{ $item->activities[0]->seller_id }}&activity_id={{ $item->activities[0]->activity_id }}">http://shop.m.taobao.com/shop/coupon.htm?seller_id={{ $item->activities[0]->seller_id }}&activity_id={{ $item->activities[0]->activity_id }}</a><br/>
                    下单链接: <a class="exampleleft-a" href="{{ $item->shop_type ? 'https://detail.tmall.com/item.htm?id='.$item->item_id : 'https://item.taobao.com/item.htm?id='.$item->item_id }}" biz-itemid="{{ $item->item_id  }}" isconvert="1" target="_blank">{{ $item->shop_type ? 'https://detail.tmall.com/item.htm?id='.$item->item_id : 'https://item.taobao.com/item.htm?id='.$item->item_id }}</a><br>
                    {{ $item->intro ? $item->intro : '小编太懒，什么也没写~~~' }}
                </div>
                <a href="javascript:void(0);" class="qq-box"><button type="button">自定义QQ群模板</button></a><button type="button" class="copy">生成文案并复制</button>
            </div>
        </div>
    </div>
    <div class="goods-hd wth">
        <i></i>
        <p><a href="#">查看更多&gt;&gt;</a></p>
    </div>
    <div class="goods1 wth clearfix">	
        <ul class="mg clearfix">
            @foreach($rand_items as $rand_item)
            <li class="good1_one fl mrgin">
                <div class="goods-a">
                    <a href="/detail/{{ $rand_item->id }}">
                        <img src="{{ asset('statics/images/waiting.png') }}" class="lazy" data-original="http://acdn.taokezhushou.com/{{ $rand_item->pic_url }}@1e_1c_0o_0l_287h_287w_100q.src" alt="{{ $rand_item->title }}" width="287" height="287"/>
                    </a>
                    @if($item->created_at->format('Y-m-d H:i:s') > date('Y-m-d 00:00:00'))
                        <div class="newdays2 newd2"></div>
                    @endif
                    <div class="title">
                        <i class="tit{{ $rand_item->shop_type }}"></i>
                        <p><a href="/detail/{{ $rand_item->id }}">{{ str_limit($rand_item->title, 32, '') }}</a></p>
                    </div>
                    <div class="coupon">优惠券<span class="num1 gd_wd">{{ $rand_item->activities[0]->amount }}</span>元，剩余数量<span class="num2 gd_wd">{{ $rand_item->activities[0]->surplus }}</span>/<span class="num3">{{ $rand_item->activities[0]->receive + $rand_item->activities[0]->surplus }}</span></div>
                    <div class="commission">
                        <ul>
                            <li class="com1 gd_wd2 fl">佣金<span>{{ round($rand_item->commission_rate, 1) }}%</span></li>
                            <li class="com2 fl">{{ $rand_item->plan_type }}</li>
                            <li class="com3 fl">{{ $rand_item->review ? '审核' : '秒过'}}</li>
                            <li class="com4 fr">目前销量<span class="com4_num gd_wd2">{{ $rand_item->volume }}</span></li>
                        </ul>					
                    </div>
                    <div class="good_btm">
                        <ul>
                            <li class="btm1 fl">券后&nbsp;&yen;&nbsp;<span class="value">{{ $rand_item->price - $rand_item->activities[0]->amount }}</span></li>
                            <li class="btm2 fl">&yen;{{ $rand_item->price }}</li>
                            <li class="btm3 fr"><a href="/detail/{{ $rand_item->id }}">立即推广</a></li>
                        </ul>
                    </div>
                </div>
            </li><!--good1_one结束-->	
            @endforeach
        </ul>
    </div><!--goods1 wth结束-->
    <div class="goods-ft">
        <p><a href="/">点击查看更多领券商品&nbsp;&gt;</a></p>
    </div>
</div><!--goods结束-->
@endsection
@section('footer_js')
<script>
var error_type = [];
var sumError="";
    $('#error_type span').click(function(){
        
        if($(this).hasClass("active")){
            $(this).removeClass("active");  
            var errorVal=$(this).text();   
            var errorCon=$(this).children('strong').text();  

            for (var i=0;i<error_type.length;i++){
                if(error_type[i] == errorCon){
                    delete error_type[i];
                }
            }
            console.log(error_type);

            sumError=sumError.replace(errorVal,'');
            $('#choose_errortype').val(sumError);
            //console.log($('#choose_errortype').val());  delete error_type[2];  
            //var arrList = ['a','b','c','d'];         arrList.splice(jQuery.inArray('b',arrList),1); 
        }else{
            $(this).addClass("active");
            var errorVal=$(this).text();//strong   t.push({'a':3});//增
            
            $("#error_type .active strong").each(function(i,dom){
                error_type[i] = $(this).text();
            });
            console.log(error_type);

            sumError += errorVal;
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
                //抓取反馈信息

                var depict = $(".depict").val();
                var qq = $("#qq").val();
                $.post("{{url('/goodserror')}}",{_token:"{{csrf_token()}}",depict:depict,qq:qq,goods_id:"{{$item->id}}",error_type:error_type},function(data){

                })
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


$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
});
@if(Auth::check())
    var is_login = true;
@else
    var is_login = false;
@endif
</script>
<script type="text/javascript" src="{{ asset('statics/js/layerbox.js') }}?v1.3"></script>
<script type="text/javascript" src="{{ asset('statics/js/clipboard.min.js') }}?v1.3"></script>
<script>
$(function(){
    var clipboard = new Clipboard('.copy', {
        /*
        text: function() {
            return $('.wenan').text().trim().replace(/(^\s*)|(\s*$)/gim, "");;
        }*/
        target: function() {
            if(is_login){
                var response = {};
                $.ajax({
                    url: '/wenan/transform',
                    type: 'POST',
                    data: {
                        id: {{ $item->id }}
                    },
                    async: false,
                    success: function(data){
                        response = data;
                    }
                });
                if(response.status == 'ok'){
                    $('#wenan').empty().html(response.data);
                    $('.tui_pic').attr('src', $('.tui_pic').attr('copy-src'));
                    if(response.plan_type == '定向'){
                        layer.confirm('该商品最高佣金为定向计划，请在复制后手动申请计划，避免出现推广所得不是最高佣金的情况。',{
                            btn: ['好的我知道了']
                        });
                    }
                }else{
                    if(response.msg == '请先设置PID'){
                        layer.confirm('您还没有设置PID，推广不能获得佣金，是否马上设置?', function(){
                            window.location.href = '/pid/create';
                        }, function(index){
                            layer.close(index);
                        });
                    }else{
                        layer.msg(response.msg);
                    }
                    return false;
                }
            }else{
                layer.confirm('未登录复制推广不能获得佣金哦！',{
                    btn: ['好的我知道了']
                });
            }
            return document.querySelector('#wenan');
        }
    });
    clipboard.on('success', function(){
        layer.tips('复制成功', '.copy', {
            tips: [1, '#0FA6D8'] //还可配置颜色
        });
    });
    clipboard.on('error', function(){
        layer.tips('复制失败,请尝试升级您的浏览器', '.copy', {
            tips: [1, '#0FA6D8'] //还可配置颜色
        });
    });     


});
</script>
@endsection
