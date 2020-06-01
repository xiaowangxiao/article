<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use App\Services\AdminService;
use App\Services\ArticleService;
use Redirect;
use Validator;
use Illuminate\Support\Facades\Redis;
class ArticleController extends Controller
{
	public function _construct(){

	}
    public function getArticleList(){
    	$articleService = new ArticleService();
    	$data = $articleService->getArticleList();
    	
    	return view('article.list',['lists'=>$data]);
    }

    public function delArticle($id){
    	$params['id'] = $id;
    	$articleService = new ArticleService;

    	$result = $articleService->delArticle($params);
    	return view('article.del',['result'=>$result]);
    }
    public function addArticle(Request $request){
        $params = $request->all();
    	$messages = [
    		'title.required'=>'标题不能为空',
    		'content.required'=>'文章内容不能为空',
    	];
    	$validator = Validator::make($params,[
    		'title'=>'required',
    		'content'=>'required'
    	],$messages);
    	if($validator->fails()){
    		return back()->withErrors($validator)->withInput();
    	}
    	$articleService = new ArticleService;
    	$result = $articleService->addArticle($params);
    	if(isset($params['id']) && $params['id']>0){
    		return view('article.edit',['result'=>$result]);
    	}else{
    		return view('article.add',['result'=>$result]);
    	}
    	
    }
    public function click(Request $request){
    	$id = $request->all()['id'];
    	if(intval($id)<=0){
            return response()->json(['code'=>0,'msg'=>'ID FAIL','data'=>[]]);
    	}
        $ip = $request->getClientIp();
        $key = 'articleClickTimes';
        $clickIpList = 'clickIpList';

        $ipList = Redis::hKeys($clickIpList);
        // if(in_array($ip,$ipList)){
        //     return response()->json(['code'=>1,'msg'=>'SUCCESS','data'=>[]]);
        // }

        //添加到IP列表
        Redis::hSet($clickIpList,$ip,'1');

        $expireTime = strtotime(date("Y-m-d",strtotime("+1 day")))-time(); 
        Redis::EXPIRE($clickIpList,$expireTime);
        //文章计数器自增1
        $result = Redis::HINCRBY($key,$id,1);

        if($result){
            //成功
            return response()->json(['code'=>1,'msg'=>'SUCCESS','data'=>[]]);
        }else{
            return response()->json(['code'=>0,'msg'=>'FAIL','data'=>[]]);
        }
    }

}
