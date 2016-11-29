<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::group(['middleware' => []], function(){
    Route::get('/', 'IndexController@index');
    Route::get('/cate/{id}', 'CateController@show')->where('id', '[0-9]+');
    Route::get('/detail/{id}', 'DetailController@show')->where('id', '[0-9]+');
    Route::get('/articles/{id}', 'ArticleController@show')->where('id', '[0-9]+');
    Route::get('/search', 'SearchController@index');
    Route::get('/top100', 'TopController@index');
    Route::get('/1111', 'ZhuantiController@index');
    Route::get('/jiaqun/taoke', 'JiaqunController@taoke');
    Route::get('/jiaqun/shangjia', 'JiaqunController@shangjia');
    Route::get('/register', 'UserController@create');
    Route::post('/register', 'UserController@store');
    Route::post('/checkmobile', 'UserController@checkmobile');
    Route::get('/login', 'UserController@login');
    Route::post('/login', 'UserController@sigin');
    Route::get('/logout', 'UserController@logout');
    Route::get('/geetest', 'GeetestController@index');
    Route::post('/sms', 'SmsController@sendsms');
    Route::any('/findpassword/step1', 'FindPasswordController@step1');
    Route::any('/findpassword/step2', 'FindPasswordController@step2');
    Route::any('/findpassword/step3', 'FindPasswordController@step3');
    Route::any('/findpassword/step4', 'FindPasswordController@step4');
    Route::get('/findpassword/sendsms', 'FindPasswordController@sendsms');
    Route::get('/mytop', 'MyTopController@index');
});

Route::group(['middleware' => ['auth']], function(){
    Route::resource('pid', 'PidController');
    Route::post('/wenan', 'WenanTemplateController@store');
    Route::get('/mail', 'WenanTemplateController@send');
    Route::post('/goodserror', 'GoodsErrorController@error');
    Route::get('/g', 'GoodsErrorController@store');
    Route::get('/wenan/create', 'WenanTemplateController@create');
    Route::post('/wenan/del_temp', 'WenanTemplateController@del_temp');
    Route::get('/curl', 'CurlController@curl');
    //Addtemp  luck
    Route::post('/wenan/transform', 'WenanTemplateController@transform');
    Route::get('/updatepassword', 'UpdatePasswordController@edit');
    Route::post('/updatepassword', 'UpdatePasswordController@update');
});







