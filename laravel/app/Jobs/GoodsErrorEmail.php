<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\GoodsError;
use Mail;
class GoodsErrorEmail extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    protected $goods;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(GoodsError $goods)
    {
        $this->goods = $goods;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = 'ceshi';
        Mail::send('email.emil',['user'=>$user],function($message) use ($user){
            $message->to("183844707@qq.com")->subject('商品纠错');
        })
        
    }
}
