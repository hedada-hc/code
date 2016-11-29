<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\GoodsError;
use Illuminate\Http\Request;
use App\Http\Requests;
use Storage;
use App\Jobs\GoodsErrorEmail;
use App\Models\Users;
use App\Jobs\SendReminderEmail;
use Mail;
//商品纠错
class GoodsErrorController extends Controller{

	public function error(Request $request){
		
		if($request->isMethod('post')){
			$error_email = $request->all();
			$tmp = '';
			foreach ($error_email['error_type'] as $key => $value) {
				$tmp .= $error_email['error_type'][$key]."、";
			}

			$this->dispatch(new SendReminderEmail($error_email['depict'],$error_email['qq'],$error_email['goods_id'],$tmp));
		}
		
	}

	public function GoodsErrorEmail(Request $request,$id){
		$user = GoodsError::findOrFail($id);
		dd($user);
	}


	public function store(Request $request){
		$email = $request->all();
		$this->dispatch(new SendReminderEmail($email['depict'],$email['qq'],$email['goods_id']));
		return 'hdd ok！';
	}


}

