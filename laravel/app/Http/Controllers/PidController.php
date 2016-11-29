<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Redirect;
use Validator;
use App\Models\Pid;

class PidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pids = Pid::where('user_id', $request->user()->id)->get();
        return view('pid.index', compact('pids'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pid.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:pids,user_id,name',
            'common_pid' => 'required|regex:/^mm(_\d{5,}){3}$/',
            'queqiao_pid' => 'required|regex:/^mm(_\d{5,}){3}$/',
        ], [
            'name.required' => '分组名称不能为空',
            'name.unique' => '已存在该分组名称',
            'common_pid.required' => '通用PID不能为空',
            'common_pid.regex' => '通用PID格式不正确',
            'queqiao_pid.required' => '鹊桥PID不能为空',
            'queqiao_pid.regex' => '鹊桥PID格式不正确'
        ]);

        //验证注册信息是否正确
        if($validator->fails()){
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $data = [
            'user_id' => $request->user()->id,
            'name' => $request->get('name'),
            'common_pid' => $request->get('common_pid'),
            'queqiao_pid' => $request->get('queqiao_pid')
        ];

        Pid::create($data);

        return redirect('/pid');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pid = Pid::where('id', $id)->firstOrFail();
        return view('pid.edit', compact('pid'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'name' => 'required|unique:pids,user_id,name',
            'common_pid' => 'required|regex:/^mm(_\d{5,}){3}$/',
            'queqiao_pid' => 'required|regex:/^mm(_\d{5,}){3}$/',
        ], [
            'name.required' => '分组名称不能为空',
            'name.unique' => '已存在该分组名称',
            'common_pid.required' => '通用PID不能为空',
            'common_pid.regex' => '通用PID格式不正确',
            'queqiao_pid.required' => '鹊桥PID不能为空',
            'queqiao_pid.regex' => '鹊桥PID格式不正确'
        ]);

        //验证注册信息是否正确
        if($validator->fails()){
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $pid = Pid::find($id);
        $pid->user_id = $request->user()->id;
        $pid->name = $request->get('name');
        $pid->common_pid = $request->get('common_pid');
        $pid->queqiao_pid = $request->get('queqiao_pid');

        $pid->save();

        return redirect('/pid');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pid::where('id', $id)->delete();
        return redirect('/pid');
    }
}
