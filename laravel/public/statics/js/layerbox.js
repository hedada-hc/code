var default_template = '{商品图片}{换行符}{短标题}{换行符}领券后{券后价}元{包邮}{换行符}领券下单：{二合一模式下单链接}{换行符}{介绍文案}';
$(document).ready(function(){
    $('.qq-box').on('click', function(){
        if(is_login){
            $.get('/wenan/create', function(data){
                if(data.status == 'ok'){
                    var index = layer.open({
                        type: 1,
                        closeBtn:1,
                        shade: [0.4,'#000'],
                        shadeClose:true,
                        btn:['保存','恢复默认设置'],
                        title: false, 
                        area:'695px',
                        content: data.data,
                        yes: function(index){
                            postdata.name = $('.temp_tpl').val();
                            postdata.default = $('.temp_tpl').attr('default_id');
                            if(postdata.default==null){
                                postdata.default=0;
                            }
                            postdata.template = $('.template').val();
                            $.post('/wenan', postdata, function(data){
                                if(data.status == 'ok'){
                                    layer.msg('保存成功', {icon: 6});
                                    layer.close(index); 
                                    window.location.reload();
                                }else{
                                    layer.msg(data.msg);
                                }
                            });
                        },btn2:function(index){
                            $(".template").val(default_template);
                        },
                        cancel: function(index){
                            $(".template").val(default_template);
                            layer.close(index); 
                        }
                    });
                }else{
                    if(data.msg = 'nopid'){
                        layer.confirm('您还没有设置PID，不能自定义模板，是否马上设置?', function(){
                            window.location.href = '/pid/create';
                        }, function(index){
                            layer.close(index);
                        });
                    }
                }
            });
        }else{
            layer.confirm('自定义模板功能需要登录才能使用，马上登录？', function(){
                window.location = '/login';
            }, function(index){
                layer.close(index);
            });
        }
    });
});
