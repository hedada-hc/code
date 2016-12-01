<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Log;
use Redis;
class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';
    protected $msg;
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct($msg)
    {
        $this->msg = $msg;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        sleep(4);
        echo $this->msg."\t".date("Y-m-d H:i:s")."\n";
        Redis::set($this->msg,date("Y-m-d H:i:s"));
       Log::info($this->msg."\t".date("Y-m-d H:i:s")."\n");
    }
}
