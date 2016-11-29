$(document).ready(function() {
    var validator=$("#register").validate({
        rules: {
          group_name: {
            required: true,
            groupname:''
          },
          common_pid: {
            validat_pid: ''
          },
          queqiao_pid: {
            validat_pid: ''
          },
          application_name:{
            required: true,
            groupname:''
          },
          apply_reason:{
            required: true,
            groupname:''
          },
          contact_qq:{
            required: true,
            groupname:''
          }
        },
        messages: {
          group_name:{
            required: "请输入分组名称"
          },
          common_pid: {
            required: "请输入正确的通用PID"
          },
          queqiao_pid: {
            required: "请输入正确的鹊桥PID"
          },
          application_name:{
            required: "请输入应用名称"
          },
          apply_reason:{
            required: "请输入申请理由"
          },
          contact_qq:{
            required: "请输入联系QQ"
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
        },
        submitHandler:function(form){  
        form.submit();
        }            
    });
});