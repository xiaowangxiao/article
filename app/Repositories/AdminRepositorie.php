<?php
namespace App\Repositories;
use App\Models\Admin;
class AdminRepositorie{
	public function registerUser(array $user){
		$admin = new Admin;
		$admin->name = $user['username'];
		$admin->password = md5($user['password']);
		return $admin->save();
	}
	public function checkUser(array $user){
		return Admin::where('name',$user['username'])->first();
	}
}