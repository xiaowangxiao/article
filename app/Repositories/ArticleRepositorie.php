<?php
namespace App\Repositories;
use App\Models\Article;
use App\Models\ClickStatic;
class ArticleRepositorie{
	public function getArticleList(){
		$article = new Article;
		return $article->orderBy('id', 'ASC')->get()->toArray();;
	}
	public function getClickTimesList(){
		return ClickStatic::all();
	}
	public function delArticle(array $data){
		return Article::destroy($data['id']);
	}
	public function addArticle(array $data){
		if(isset($data['id'])){
			$article = Article::where('id',$data['id'])->first();
			$article->title = $data['title'];
			$article->content = $data['content'];
			return $article->save();
		}else{
			$article = new Article;
			$article->title = $data['title'];
			$article->content = $data['content'];
			$res = $article->save();
			if($res){
				return $article->getQueueableId();
			}
		}
		
	}
	public function addClickTimes($id){
		$clickInfo = ClickStatic::where('article_id',$id)->first();
		$click = new ClickStatic;
		if(!$clickInfo){
			$click->article_id = $id;
			$click->click_times= 1;
			return $click->save();
		}
		return $click->where('id',$clickInfo['id'])->update(['click_times'=>$clickInfo['click_times']+1]);
	}
}