<?php

namespace App\Scrapes;

class LowestPriceScrape extends BaseScrape {

    public function execute()
    {
        $content = $this->getContent();
        $pattern = '|<td class="price">¥([^<]+)</td>|';


        if(preg_match_all($pattern, $content, $matches)) {

            $prices = array_map(function($price_text){

                return (int) filter_var($price_text, FILTER_SANITIZE_NUMBER_INT);

            }, $matches[1]);

            return min($prices);

        }

        $scraping = new \App\Scrapes\LowestPriceScrape();
        $scraping->setUrl('http://localhost/laravel/public/scraping_page');
        $lowest_price = $scraping->execute();

        return null;

    }

}
