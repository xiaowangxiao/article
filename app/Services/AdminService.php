<?php
namespace App\Services;
use App\Repositories\AdminRepositorie;
class AdminService{
	public function registerUser(array $user){
		$adminRepositories = new AdminRepositorie;
		$userInfo = $adminRepositories->checkUser($user);
		if($userInfo){
			return ['code'=>0,'msg'=>'用户已存在','data'=>[]];
		}
		$result = $adminRepositories->registerUser($user);
		return ['code'=>1,'msg'=>'注册成功','data'=>$result];
	}
	public function checkUser(array $user){
		$adminRepositories = new AdminRepositorie;
		$userInfo = $adminRepositories->checkUser($user);
		if(!$userInfo){
			return ['code'=>0,'msg'=>'用户不存在','data'=>[]];
		}
		//校验密码
		if(md5($user['password']) != $userInfo['password']){
			return ['code'=>0,'msg'=>'密码错误','data'=>[]];
		}

		return ['code'=>1,'msg'=>'登录成功','data'=>$userInfo];

	}
	public function checkLoginStatus($request){
		$value = $request->session()->get('user');
    	if($value == null || empty($value->name)){
    		return false;
    	}
		dump("欢迎你：".$value->name);
    	return true;
    	
	}
}