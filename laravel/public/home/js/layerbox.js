$(document).ready(function(){
    $('.qq-box').on('click', function(){
        $('#form_model1').show();
        $('#form_model2').hide();
        var textArea1=$("#qqtext1").val();
        var textArea2=$("#qqtext2").val();
        var index=layer.open({
            type: 1,
            closeBtn:1,
            shade: [0.4,'#000'],
            shadeClose:true,
            btn:['保存','恢复默认设置'],
            title: false, 
            area:'695px',
            content: $('.layer-qqbox'),
            yes: function(index){
                layer.msg('保存成功', {icon: 6});
                if($('#form_model1').css("display")!="none"){
                    $("#qqtext1").val(textArea1);
                }else{
                    $("#qqtext2").val(textArea2);
                }                
                layer.close(index); 
                
            },btn2:function(index){
                if($('#form_model1').css("display")!="none"){
                    $("#qqtext1").val(textArea1);
                }else{
                    $("#qqtext2").val(textArea2);
                }       
            },
            cancel: function(index){
               if($('#form_model1').css("display")!="none"){
                    $("#qqtext1").val(textArea1);
                }else{
                    $("#qqtext2").val(textArea2);
                }     
                layer.close(index); 
            }           
        });
    });
    $('#normal_model').click(function(){
        var normalValue=$('#normal_model a').text();
        $('#model').val(normalValue);
        $('#normal_model').addClass("active");
        $('#traditional').removeClass("active");
        $('#form_model1').show();
        $('#form_model2').hide();        
    });
    $('#traditional').click(function(){
        var traValue=$('#traditional a').text();
        $('#model').val(traValue);
        $('#traditional').addClass("active");
        $('#normal_model').removeClass("active");
        $('#form_model2').show();
        $('#form_model1').hide();            
    });    
    $('#pidtype1 span').click(function(){
        $(this).addClass("active").siblings().removeClass("active");
        var pidValue1=$(this).text();
        $('#pid').val(pidValue1);
        // if($(this).hasClass("active")){
        //     $(this).siblings().removeClass("active");
        // }else{
        //     $(this).siblings().addClass("active");
        // } 
    });
    $('#qqcopy1 a span').click(function(){
        var point1 = $(this); 
        var textareaHtml1=$("#qqtext1").val();             
        var textA1 ="{"+point1.text()+"}";
        $("#qqtext1").val(textareaHtml1+textA1);
    });
    $('#pidtype2 span').click(function(){
        $(this).addClass("active").siblings().removeClass("active");
        var pidValue2=$(this).text();            
        $('#pid').val(pidValue2);
        // if($(this).hasClass("active")){
        //     $(this).siblings().removeClass("active");
        // }else{
        //     $(this).siblings().addClass("active");
        // } 
    }); 
    $('#qqcopy2 a span').click(function(){
        var point2 = $(this); 
        var textareaHtml2=$("#qqtext2").val();             
        var textA2="{"+point2.text()+"}";
        $("#qqtext2").val(textareaHtml2+textA2);
    });               
});
