<?php

namespace App\Http\Controllers;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Cashier;
use Illuminate\Support\Facades\DB;


class HeatmapController extends Controller
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

    public function index()
    {

        return view('heatmap');
    }
}
