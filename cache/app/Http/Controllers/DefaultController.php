<?php

namespace App\Http\Controllers;
use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Queue;
use App\Console\Commands\SendEmail;
class DefaultController extends Controller
{
    public function action(){
    	for ($i=0; $i < 100; $i++) { 
    		Queue::push(new SendEmail("ssss".$i));
    	}
    }
}
