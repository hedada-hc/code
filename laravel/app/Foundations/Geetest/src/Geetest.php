<?php 
namespace Yunxi\Geetest;
use Session;
require_once dirname(dirname(__FILE__)) . '/src/lib/class.geetestlib.php';
require_once dirname(dirname(__FILE__)) . '/src/config/config.php';

class Geetest{
    public function getstr(){
        $GtSdk = new GeetestLib(CAPTCHA_ID, PRIVATE_KEY);
        $user_id = "test";
        $status = $GtSdk->pre_process($user_id);
        Session::put('gtserver', $status);
        Session::put('user_id', $user_id);
        return $GtSdk->get_response_str();
    }

    public function verify(){
        $GtSdk = new GeetestLib(CAPTCHA_ID, PRIVATE_KEY);
        $user_id = Session::get('user_id');
        if (Session::get('gtserver') == 1) {
            $result = $GtSdk->success_validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode'], $user_id);
            if ($result) {
                return true;
            } else{
                return false;
            }
        }else{
            if($GtSdk->fail_validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode'])) {
                return true;
            }else{
                return false;
            }
        }
    }
}