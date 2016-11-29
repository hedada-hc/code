$(document).ready(function() {
   $("#pid").validate({
        rules: {
          name: {
            required: true,
            groupname:''
          },
          common_pid: {
            required: true,
            validat_pid: ''
          },
          queqiao_pid: {
            required: true,
            validat_pid: ''
          }
        },
        messages: {
          name:{
            required: "请输入分组名称"
          },
          common_pid: {
            required: "请输入正确的通用PID"
          },
          queqiao_pid: {
            required: "请输入正确的鹊桥PID"
          }   
        },
        focusCleanup: true,
        
        onfocusin: function(element){
            $(element).addClass('active');
            $(element).parent().find('.tip').css("color","#666").show();   
        },
        onfocusout: function(element) {
            $(element).parent().find('.tip').show();
            if($(element).valid()){
              $(element).parent().find('.tip').hide();  
            }
            else{
                $(element).removeClass('active');
                $(element).addClass('error_box');
                $(element).parent().find('.tip').css("color","#ff464e").show();
            }    
        },
        errorPlacement: function(error, element) {
            $(element).parent().find('.tip').html("");  
            $(element).parent().find('.tip').append(error).css("color","#ff464e").show();
            $(element).removeClass('active');
            $(element).addClass('error_box');
        }
    });
});