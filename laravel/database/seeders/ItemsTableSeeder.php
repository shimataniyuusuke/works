<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $item = new Item();
        $item->name = 'インドの青鬼';
        $item->price = 8000;
        $item->scraping_class = 'App\Scrapes\LowestPriceScrape';
        $item->scraping_url = 'http://localhost/laravel/public/scraping_page'; // スクレイピングするURL
        $item->scraped_at = now();
        $item->save();
    }
}
