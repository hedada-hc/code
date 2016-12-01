<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/q','DefaultController@action');
Route::get('/curl',"CurlController@index");
Route::get('/queue',"CurlController@test");
Route::get('mail/send','MailController@send');
Route::get('/msg','CurlController@msg');

//限制访问频率
Route::group(['prefix'=>'api','middleware'=>'throttle:5,1'],function(){
	Route::get('users',"FrequencyController@index");
});
//注册页面访问频率限制路由
Route::get('reg','RegsController@index');
Route::get('show/{id}','RegsController@show');
Route::post('reg/ajax','RegsController@redis_ajax');
Route::post('reg/loing','RegsController@loing');
// Route::group(['middleware'=>'throttle:100,1'],function(){
// 	Route::get('reg','RegsController@index');
// });
Route::get('down','Practice\DownloadController@index');

//luck  mac os extended(journaled)
Route::any('/luck','Personal\LuckController@index');
Route::get('/weixin','Personal\LuckController@weixin');
//
Route::get('/luck/pour/{id}','Personal\LuckController@pour');
Route::get('/wechat','WechatController@uuid');
Route::get('/wechat/status/{uuid}','WechatController@code_status');
Route::any('/wechat/key',"WechatController@key");
Route::any('/wechat/test',"WechatController@test");