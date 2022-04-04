<?php

namespace App\Console;

use App\Models\Item;
use App\Scrapes\BaseScrape;
use App\Scrapes\LowestPriceScrape;
use Illuminate\Console\Command;

use phpQuery;

class ScrapingCommand extends Command
{
    protected $signature = 'scraping';
    protected $description = 'Scrape external website regularly';

    public function handle()
    {
        $result = false;
        $item = Item::oldest('scraped_at')
            ->first(); // 一番前にスクレイピングされたデータを取得
        $scraping_class = $item->scraping_class;

        if(class_exists($scraping_class)) { // クラスが存在しているかチェック

            $scraping = new $scraping_class();

            if($scraping instanceof BaseScrape) { // 正しいクラスかチェック

                $scraping = new LowestPriceScrape();
                $scraping->setUrl($item->scraping_url);
                $lowest_price = $scraping->execute();

                $this->discountprice = 10; // 10円安くする
                $item->price = $lowest_price - $this->discountprice; //減算処理
                $result = $item->save();

            }

        }

        if($result === true) {

            $this->info('---------スクレイピング実行---------');
//            echo phpQuery::newDocument($html);
            $this->info('設定価格を'. $this->discountprice. "円安くして". $item->price. "円にしました");
            \Log::info('設定価格を'. $this->discountprice. "円安くして". $item->price. "円にしました"); // ログ出力
            $this->info('---------スクレイピング終了---------');

        } else {

            $this->error('Failed...');

        }

    }
}
