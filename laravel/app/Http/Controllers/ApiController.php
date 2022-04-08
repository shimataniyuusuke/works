<?php

namespace App\Http\Controllers;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{

    //記事カテゴリ
    //記事タイトルの文脈に応じてカテゴリ分けしようと思ったけどやめた
    private $category = [
        1 => "地域情報",
        2 => "経済",
        3 => "国内経済",
        4 => "世界経済",
        5 => "ウクライナ情勢",
        6 => "IT",
        7 => "ペット",
        8 => "ライフハック",
        9 => "ガジェット",
    ];

    public function __construct()
    {
        //ログインしてなければログイン画面へ飛ばす
        $this->middleware('auth');

    }

    public function index()
    {

        try {
            $url = config('newsapi.news_api_url')."top-headlines?country=jp&category=business&apiKey=".config(
                    'newsapi.news_api_key'
                );
            $method = "GET";
            $count = 15;

            $client = new Client();
            $response = $client->request($method, $url);

            $results = $response->getBody();
            $articles = json_decode($results, true);

            $news = [];

            //日時に謎のTとZの文字列が含まれているので削除用
            $replace_target_str = array(
                1 => "T",
                2 => "Z",
            );


            for ($id = 0; $id < $count; $id++) {

                array_push($news, [
                    'title'     => $articles['articles'][$id]['title'],
                    'url'       => $articles['articles'][$id]['url'],
                    'datetime'  => str_replace($replace_target_str, " ", $articles['articles'][$id]['publishedAt']),
                    'thumbnail' => $articles['articles'][$id]['urlToImage'],
                ]);
            }
            //リクエストの転送中にスローされる可能性のあるすべての例外をキャッチ
        } catch (RequestException $e) {
            //Guzzle7が提供しているGuzzleHttp\Psr7\Uriクラスを使用した、インターフェースの実装
            echo Psr7\Message::toString($e->getRequest());
            if ($e->hasResponse()) {
                echo Psr7\Message::toString($e->getResponse());
            }
        }


        return view('news/index', compact('news'));
    }
}
