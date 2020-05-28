<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;

use App\Services\AdminService;
class AdminController extends Controller
{

    //展示登录界面
    public function login(){
    	return view('admin.login');
    }
    //注册
    public function registerUser(Request $request){
    	$params = $request->all();
    	$messages = [
    		'username.required'=>'用户名不能为空',
    		'password.required'=>'密码不能为空',
    	];
    	$validator = Validator::make($params,[
    		'username'=>'required',
    		'password'=>'required'
    	],$messages);
    	if($validator->fails()){
    		return redirect('admin/login')->withErrors($validator)->withInput();
    	}
    	$adminServices = new AdminService();
    	$result = $adminServices->registerUser($params);
    	if($result['code'] === 1){
    		return view('admin/register',['result'=>$result['data']]);
    	}else{
    		return redirect('admin/login')->withInput()->withErrors([$result['msg']]);
    	}
    }
    //登录
    public function checklogin(Request $request){
    	$params = $request->all();
    	$messages = [
    		'username.required'=>'用户名不能为空',
    		'password.required'=>'密码不能为空',
    	];
    	$validator = Validator::make($params,[
    		'username'=>'required',
    		'password'=>'required'
    	],$messages);
    	if($validator->fails()){
    		return redirect('admin/login')->withErrors($validator)->withInput();
    	}

    	$adminServices = new AdminService();
    	$result = $adminServices->checkUser($params);
    	if($result['code'] === 1){
    		session(['user' => $result['data']]);//存session，文章操作验证
    		return view('admin/index',['user'=>$result['data']]);
    	}else{
    		return redirect('admin/login')->withInput()->withErrors([$result['msg']]);
    	}
    }

}
