<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Redis;

use App\Models\ClickStatic;

class ArticleClickStatic extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:clickStatic';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //统计入库
        $key = 'articleClickTimes';
        $articleList = Redis::hKeys($key);
        if(!empty($articleList)){
            foreach ($articleList as $value) {
                $clickTimes = Redis::hGet($key,$value);
                $click = ClickStatic::where('article_id',$value)->first();
                
                if(!$click){
                    $click = new ClickStatic;
                    $click->article_id = $value;
                    $click->click_times= $clickTimes;
                }else{
                    $click->click_times = $click['click_times'] + $clickTimes;
                }
                $result = $click->save();
                if($result){
                    Redis::hDel($key,$value);
                }
                return $result;
            }
        }
    }
}
