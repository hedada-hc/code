<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Qun;
use App\Models\Qq;
use Cache;

class JiaqunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function taoke()
    {
        $qun_link = Qun::where('name', '淘客')->value('qun_link');
        return redirect($qun_link);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function shangjia()
    {
        /*
        $qun_link = Qun::where('name', '商家')->value('qun_link');
        return redirect($qun_link);*/
        $qqs = Qq::where('type', '招商')->where('status', 1)->get()->toArray();
        $arr = [];
        foreach($qqs as $key=>$val){
            $arr[$key] = $val['weight'];
        }
        $k = $this->rand($arr);
        return redirect($qqs[$k]['qq_link']);
    }

    //按权重生成随机值
    /*
        $arr = [
            'a' =>10,
            'b' =>20,
            'c' =>30,
            'd' =>40
        ];
    */
    private function rand($arr)
    {
        $ret = '';
        $sum = array_sum($arr);
        foreach($arr as $k=>$v)
        {   
            $r = mt_rand(1, $sum);
            if($r <= $v) 
            {   
                $ret = $k; 
                break;
            }else{
                $sum = max(0, $sum - $v);
            }   
        }   
        return $ret;
    }
}
