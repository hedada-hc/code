<?php
namespace Yunxi\Alidayu;
use Config;
require_once 'Alisms.php';

class Alidayu{
    public function send($to, $template, $parames){
        date_default_timezone_set('PRC');
        //实例化类:两个参数分别为申请通过后的 App Key 和 App Secret
        $alisms = new Alisms(Config::get('alidayu.key'), Config::get('alidayu.secret'));

        //短信签名: API请求参数sms_free_sign_name的值
        $alisms->sms_sign(Config::get('alidayu.sign_name')); 

        //短信模板变量: API请求参数sms_param的值, 官方示例值为json格式字符串，而这里只需数组格式即可，会自动转换为json
        $alisms->sms_param($parames);

        //短信模板ID：API请求参数sms_template_code的值(如:SMS_12185895)
        $alisms->sms_template($template);

        //短信接收号码: API请求参数rec_num的值
        $alisms->sms_mobile($to);

        //发送短信: 返回boolean值 TRUE 为成功 FALSE 为失败或发生异常 
        $res = $alisms->send();

        //如发送失败，打印错误查看对应错误代码;
        if(!$res){
            print_r($alisms->error);
        }else{
            dd($res);
        }
    }
}
?>
