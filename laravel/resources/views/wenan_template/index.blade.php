
<div class="layer-qqbox" id="layerform2">
    <div class="qqlayer-infro clearfix">

        <h2><i></i>自定义QQ群模板</h2>
        <div id="form_model1">
            <div class="clearfix" style="margin-top:8px;">
                <p class="pid-infro fl">
                    <span><em>*</em>选择PID：</span>
                </p>
                <div class="pidtype fl select_pid" id="pidtype1">
                    @if(count($pids))
                        @foreach($pids as $pid)
                        <a style="position:relative;" class="select" data-id="{{ $pid->id }}" @if(isset($wenans['qq']) && isset($wenans['qq'][1]) && $wenans['qq'][1][0]['pid_id'] == $pid->id) class="active" @endif><b class="pitch"></b>{{ $pid->name }}</a>
                        @endforeach
                    @else
                        <a href="/pid/create">请先设置三段式PID</pid>
                    @endif
                </div>
            </div>
            <div class="clearfix" style="margin-top:8px;">
                <p class="pid-infro fl">
                    <span><em>*</em>选择模板：</span>
                </p>
                <div class="pidtype fl temp after" id="pidtype1">

                    @if(count($temp_tmp))
                        @foreach($temp_tmp as $key => $value)
                            @if(isset($temp_tmp[$key]['is_default']))
                            <span class="tag" style="position: relative;display: inline-block;" default_id="{{ isset($temp_tmp[$key]['id'])? $value['id'] :"系统默认模板" }}">
                                <i style="cursor:pointer;" class="del_ico" onclick="remove_temp(this)"></i>
                                <b class="pitch"></b>
                                <input  data-id="{{ $pid->id }}" vals="{{isset($temp_tmp[$key]['content'])? $value['content'] :''}}" default_id="{{ isset($temp_tmp[$key]['id'])? $value['id'] :"系统默认模板" }}" onclick="load(this)" class="active temp_tpl" value="{{ isset($temp_tmp[$key]['name'])? $value['name'] :"系统默认模板" }}" />
                            </span>
                            @else
                            <span class="tag" style="position: relative;display: inline-block;" default_id="{{ isset($temp_tmp[$key]['id'])? $value['id'] :'' }}">
                                <i onclick="remove_temp(this)" style="cursor:pointer;" class="del_ico_on"></i>
                                <b></b>
                                <input  type="text" onclick="load(this)" vals="{{isset($temp_tmp[$key]['content'])? $value['content'] :''}}" default_id="{{ isset($temp_tmp[$key]['id'])? $value['id'] :'' }}" value="{{ isset($temp_tmp[$key]['name'])? $value['name'] :"系统默认模板" }}"  data-id="{{ $pid->id }}" />
                            </span>
                            @endif
                        @endforeach
                        <ico href="javascript:;" style="font-size:18px;width:45px;border-radius:6px;color:#2e8cec;border:none;    cursor: pointer;" class="iconfont icon-tianjia1" ></ico>
                    @else    
                        <a href="/pid/create">请先设置三段式PID</a>
                    @endif
                </div>622848  0059352320275
            </div>
            <div class="share clearfix">
                <span class="fl">分享内容：</span>
                <!-- $temp_tmp[$key]['is_default'] -->
                @if($is_key!=null)
                    <textarea class="qqtext fl template">{{$temp_tmp[$is_key]['content']}}</textarea>
                @else
                    <textarea class="qqtext fl template">{商品图片}{换行符}{短标题}{换行符}领券后{券后价}元{包邮}{换行符}领券下单：{二合一模式下单链接}{换行符}{介绍文案}</textarea>
                @endif
                <span class="f-color fl">（必填）</span>
            </div>
            <p class="qqcopy">
                <a>[<span>商品图片</span>]</a><a>[<span>原标题</span>]</a><a>[<span>短标题</span>]</a><a>[<span>介绍文案</span>]</a><a>[<span>店铺类型</span>]</a><a>[<span>原价</span>]</a><a>[<span>券后价</span>]</a><a>[<span>销量</span>]</a><a>[<span>包邮</span>]</a><a>[<span>佣金比例</span>]</a><a>[<span>领券链接</span>]</a><a>[<span>换行符</span>]</a><a>[<span>空格符</span>]</a><a>[<span>券满</span>]</a><a>[<span>券减</span>]</a><a>[<span>优惠券剩余数量</span>]</a><a>[<span>传统模式下单链接</span>]</a><a>[<span>二合一模式下单链接</span>]</a>
            </p>
        </div>
    </div>
</div>
<script>

$('.icon-tianjia1').click(function(){

    if($(this).prev().attr('re') !=1){
        var res = $('.after span').last();
        $tag = '<span class="tag" re="1" style="position: relative;display: inline-block;" default_id="0"><i onclick="remove_temp(this)" style="cursor:pointer;" class="del_ico_on" ></i><b></b><input onclick=load(this) vals="" default_id="0" placeholder="请输入模板标题" /></span>';
        res.after($tag);
        $(".template").html('')
        is  = 1;
    }else{
        layer.msg('请先保存当前模板!');
    }

})

var is  = 1;
var add = function(num){
    $('.after span input').removeClass('active');
    $('.after span b').removeClass('pitch');
    $(num).addClass('active');
    $('.after span b').addClass('pitch');
    if(is == 1){
        $(num).addClass('temp_title');
        $(num).html('');
        is-- 
    }
       
}

//删除模板  change
var remove_temp = function(This){
    var res = $('.after span').size();
    var default_id = $(This).parent().attr('default_id');
    if(default_id != 0){
        if(res>1){
            layer.confirm('你确定要删除该模板吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $(This).parent().remove();
            $.post("{{url('/wenan/del_temp')}}",{id:default_id},function(msg_data){
                if(msg_data.status == 'ok'){
                    layer.msg(msg_data.msg, {icon: 6});
                }else{
                    layer.msg(msg_data.msg, {icon: 5});
                }
            })
        }, function(){
          layer.msg('取消成功！', {
            time: 2000, //2s后自动关闭
          });
        });
        }else{
            layer.msg('模板最少保留一个！');
        }
    }else{
        $(This).parent().remove(); 
    }
    
}

var load=function(This){
    
    $('.after span input').removeClass('active');
    $('.after b').removeClass("pitch");
    $('.after i').attr('class',"del_ico_on");
    $(This).prev().addClass('pitch');
    $(This).prev().prev().attr('class','del_ico');
    
    $(This).addClass('active');
    var text = $(This).attr('vals');
    $('.template').val(text);
    //加载数据  del_ico_on
    $('.temp_tpl').removeClass('temp_tpl');
    $('.after .active').addClass('temp_tpl');
}


$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
});

var postdata = {
    default:'',
    qudao: 'qq',
    user_id:{{$pids[0]['user_id']}},
    name: '',
    pid_id: {{ isset($wenans['qq']) && isset($wenans['qq'][1]) ? $wenans['qq'][1][0]['pid_id'] : '0' }},
    template: '{{ isset($wenans['qq']) && isset($wenans['qq'][1]) ? json_encode($wenans['qq'][1][0]['template']) : '{商品图片}{换行符}{短标题}{换行符}领券后{券后价}{包邮}{换行符}领券下单：{二合一模式下单链接}{换行符}{介绍文案}' }}'
};
$('.pidtype a').click(function(){
    $(this).addClass("active").siblings().removeClass("active");
    $(this).children('b').addClass("on").siblings().removeClass("on");
    postdata.pid_id = $(this).attr('data-id');
    if($(this).hasClass("active")){
        $(this).siblings().removeClass("active");
    }else{
        $(this).siblings().addClass("active");
    } 
});

    // $(This).prev().removeClass("active");
    // $(This).prev().addClass('pitch');


$('.qqcopy a span').click(function(){
    var point1 = $(this); 
    var textareaHtml1=$(".template").val();             
    var textA1 ="{"+point1.text()+"}";
    $(".template").val(textareaHtml1+textA1);
});          
</script>
