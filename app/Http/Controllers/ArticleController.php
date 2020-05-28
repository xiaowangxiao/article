<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Services\AdminServices;
use App\Services\ArticleServices;

use Validator;
class ArticleController extends Controller
{
	public function _construct(){
		$adminServices = new AdminServices;
		$res = $adminServices->checkLoginStatus();
		if(!$res){
			//跳转到登录页
			return false;
		}
	}
    //
    public function getArticleList(Request $request){
    	$articleServices = new ArticleServices();
    	$data = $articleServices->getArticleList();
    	
    	return view('article.list',['lists'=>$data]);
    }

    public function delArticle(Request $request){
    	$params = $request->all();
    	$articleServices = new ArticleServices;

    	$result = $articleServices->delArticle($params);
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
    	$articleServices = new ArticleServices;
    	$result = $articleServices->addArticle($params);

    	if(isset($params['id']) && $params['id']>0){
    		return view('article.edit',['result'=>$result]);
    	}else{
    		return view('article.add',['result'=>$result]);
    	}
    	
    }
    public function click(Request $request){
    	$id = $request->all()['id'];
    	if(intval($id)<=0){
    		die(json_encode(['code'=>0,'msg'=>'ID FAIL','data'=>[]]));
    	}
    	$articleServices = new ArticleServices;
    	$result = $articleServices->addClickTimes($id);
    	if($result){
    		//成功
    		die(json_encode(['code'=>1,'msg'=>'SUCCESS','data'=>[]]));
    	}else{
    		die(json_encode(['code'=>0,'msg'=>'FAIL','data'=>[]]));
    	}
    }

}
