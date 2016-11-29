<?php

namespace App\Http\Middleware;

use Closure;
use Redis;
use Request;

class WafMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $times_sec1_limit = 8;//每秒限制请求

        $times_min1_limit = 60;//每分钟限制请求

        $ban_pre = 'www-bloked:';//redis屏蔽前缀

        $ip = get_true_ip();
        
        $sec1_request_count = Redis::command('zCount', ['visit:'.date('Y-m-d').':'.$ip, microtime(true) - 1, microtime(true)]);//每秒请求次数
        $min1_request_count = Redis::command('zCount', ['visit:'.date('Y-m-d').':'.$ip, microtime(true) - 60, microtime(true)]);//每分钟请求次数
        
        if($sec1_request_count > $times_sec1_limit || $min1_request_count > $times_min1_limit){
            //记录异常请求IP
            $data = [
                'url' => Request::getUri().'?spm='.date('Y-m-d H:i:s'),
                'ua' => $_SERVER['HTTP_USER_AGENT'],
                'referer' => isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null,
            ];
            Redis::command('zAdd', [$ban_pre.date('Y-m-d-H').':'.$ip, microtime(true), json_encode($data)]);
            //设置过期时间为1个小时
            Redis::command('EXPIRE', [$ban_pre.date('Y-m-d-H').':'.$ip, 3600]);
            return response('<script>window.location.href = "http://robot.taokezhushou.com?from='. Request::getUri() .'"</script>');
        }else{
            //记录正常请求IP
            Redis::command('zAdd', ['visit:'.date('Y-m-d').':'.$ip, microtime(true), Request::getUri().'?spm='.date('Y-m-d H:i:s')]);
            //设置过期时间为1个小时
            Redis::command('EXPIRE', ['visit:'.date('Y-m-d').':'.$ip, 3600]);
        }
        return $next($request);
    }
}
