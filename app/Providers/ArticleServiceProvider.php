<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Article;
use App\Repositories\ArticleRepositorie;
class ArticleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Article::creating(function ($article) {

        });
        Article::created(function ($article) {
            //
            $this->wirteViewDetail($article);
            $this->wirteViewList();

        });
        Article::updating(function ($article) {

        });
        Article::updated(function($article){
            $this->wirteViewDetail($article);
            $this->wirteViewList();
        });
         Article::deleted(function($article){
            $this->delViewDetail($article);
            $this->wirteViewList();
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    protected function wirteViewDetail($article){

        $dir = 'article/';
        if(!is_dir($dir)){
            mkdir($dir);
        }
        
        $htmlStrings = view('article.viewDetail',['list'=>$article])->__toString();
        file_put_contents($dir.$article['id'].'.html', $htmlStrings);
            
    }
    protected function delViewDetail($article){
        dump($article['id']);
        @unlink('article/'.$article['id'].'.html');
    }
    protected function wirteViewList(){
        $dir = 'article/';
        if(!is_dir($dir)){
            mkdir($dir);
        }
        $articleRepositorie = new ArticleRepositorie;
        $htmlStrings = view('article.viewList',['lists'=>$articleRepositorie->getArticleList()])->__toString();
        file_put_contents($dir.'viewList.html', $htmlStrings);
    }
}
