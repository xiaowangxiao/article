<?php
namespace App\Services;
use App\Repositories\ArticleRepositories;
class ArticleServices{
	public function getArticleList(){
		$articleRepositories = new ArticleRepositories;
		$list = $articleRepositories->getArticleList();
		$clickTimesList = $articleRepositories->getClickTimesList();
		$newClickTimesList = [];
		if($clickTimesList){
			foreach ($clickTimesList as $key => $value) {
				$newClickTimesList[$value['article_id']] = $value['click_times'];
			}
		}
		if($list){
			foreach ($list as $key => $value) {
				$list[$key]->click_times = 0;
				if(isset($newClickTimesList[$value['id']])){
					$list[$key]->click_times = $newClickTimesList[$value['id']];
				}
			}
		}
		return $list;
	}
	public function delArticle(array $data){
		$articleRepositories = new ArticleRepositories;
		$result = $articleRepositories->delArticle($data);
		if($result){
			$htmlStrings = view('article.viewList',['lists'=>$this->getArticleList()])->__toString();
			file_put_contents('article/viewList.html', $htmlStrings);
		}
		return $result;
	}
	public function addArticle(array $data){
		$article = [];
		$article['title'] = htmlspecialchars(trim($data['title']));
		$article['content'] = htmlspecialchars(trim($data['content']));
		isset($data['id']) && $data['id']>0 && $article['id'] = $data['id'];
		$articleRepositories = new ArticleRepositories;
		$result = $articleRepositories->addArticle($article);
		if($result){
			$dir = 'article/';
			if(!is_dir($dir)){
				mkdir($dir);
			}
			if(!isset($article['id'])){
				$article['id'] = $result;
			}
			$htmlStrings = view('article.viewDetail',['list'=>$article])->__toString();
			if(isset($article['id'])){
				file_put_contents($dir.$article['id'].'.html', $htmlStrings);
			}else{
				file_put_contents($dir.$result.'.html', $htmlStrings);
			}
			$htmlStrings = view('article.viewList',['lists'=>$this->getArticleList()])->__toString();
			file_put_contents($dir.'viewList.html', $htmlStrings);
    		
		}
		return $result;
	}
	//点击次数统计
	public function addClickTimes($id){
		$articleRepositories = new ArticleRepositories;
		return $articleRepositories->addClickTimes($id);

	}
}