<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Services\AdminService;
use App\Services\ArticleService;
use Redirect;
use Validator;
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
    public function addArticle($params){

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
    		die(json_encode(['code'=>0,'msg'=>'ID FAIL','data'=>[]]));
    	}
    	$articleService = new ArticleService;
    	$result = $articleService->addClickTimes($id);
    	if($result){
    		//成功
    		die(json_encode(['code'=>1,'msg'=>'SUCCESS','data'=>[]]));
    	}else{
    		die(json_encode(['code'=>0,'msg'=>'FAIL','data'=>[]]));
    	}
    }

}
