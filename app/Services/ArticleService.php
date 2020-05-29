<?php
namespace App\Services;
use App\Repositories\ArticleRepositorie;
class ArticleService{
	public function getArticleList(){
		$articleRepositorie = new ArticleRepositorie;
		$list = $articleRepositorie->getArticleList();
		$clickTimesList = $articleRepositorie->getClickTimesList();
		$newClickTimesList = [];
		if($clickTimesList){
			foreach ($clickTimesList as $key => $value) {
				$newClickTimesList[$value['article_id']] = $value['click_times'];
			}
		}
		if($list){
			foreach ($list as $key => $value) {
				$list[$key]['click_times'] = 0;
				if(isset($newClickTimesList[$value['id']])){
					$list[$key]['click_times'] = $newClickTimesList[$value['id']];
				}
			}
		}
		return $list;
	}
	public function delArticle(array $data){
		$articleRepositorie = new ArticleRepositorie;
		$result = $articleRepositorie->delArticle($data);
		return $result;
	}
	public function addArticle(array $data){
		$article = [];
		$article['title'] = htmlspecialchars(trim($data['title']));
		$article['content'] = htmlspecialchars(trim($data['content']));
		isset($data['id']) && $data['id']>0 && $article['id'] = $data['id'];
		$articleRepositorie = new ArticleRepositorie;
		$result = $articleRepositorie->addArticle($article);
		return $result;
	}
	//点击次数统计
	public function addClickTimes($id){
		$articleRepositorie = new ArticleRepositorie;
		return $articleRepositorie->addClickTimes($id);

	}
}