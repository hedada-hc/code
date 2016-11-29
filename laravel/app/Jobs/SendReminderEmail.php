<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use App\Models\Users;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;
use Log;
class SendReminderEmail extends Job implements SelfHandling
{
    use InteractsWithQueue, Queueable, SerializesModels;
    public $depict;
    public $goods_id;
    public $qq;
    public $error_type;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($depict,$qq,$goods_id,$error_type)
    {
        $this->depict = $depict;
        $this->goods_id = $goods_id;
        $this->qq = $qq;

        $this->error_type = $error_type;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        

        //href="http://sadmin.taokezhushou.com/admin/items/'.$this->goods_id.'/edit
        $content = [
            'depict'=>$this->depict,
            'goods_id'=>$this->goods_id,
            'qq'=>$this->qq,
            'error_type'=>$this->error_type,
        ];

        $res = Mail::send('email.emil', ['content' => $content], function ($m){
            $m->from('183844707@qq.com', '淘客助手官方');
            $m->to('hedada0313@163.com','纠错改正')->subject($this->error_type);
        });

    }
}


