<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Redis;
class RedisController extends Controller
{
    //
    public function test(){
    	Redis::set('a','1');
    	$user = Redis::get('a');
    	dd($user);
    }
}
