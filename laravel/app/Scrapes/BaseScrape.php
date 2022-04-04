<?php

namespace App\Scrapes;

use App\Models\Item;
use Illuminate\Support\Facades\Http;

abstract class BaseScrape {

    private $url;

    abstract public function execute(); // 👈 ここは継承先で必ず定義しないとエラーになります

    public function setUrl($url) {

        $this->url = $url;

    }

    protected function getContent() {

        $url = $this->url;
        $response = Http::get($url);
        return $response->body();

    }

}
