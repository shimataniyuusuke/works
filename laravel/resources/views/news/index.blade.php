<style>
    .news-list{
        list-style: none outside;
        margin: 0;
        padding: 0;
    }
    .news-list .item a{
        display: flex;
        flex-wrap: wrap;
        flex-wrap: nowrap;
        text-decoration: none;
        color: #333;
        border-bottom: 1px solid #CCC;
        padding: 20px 20px;
    }
    .news-list .item:first-child a{
        border-top: 1px solid #CCC;
    }

    .news-list .item .image{
        margin: 0;
        min-width: 140px;
        padding: 0 20px 0 0;
        width: 10%
    }

    .news-list .item .date{
        margin: 0;
        min-width: 140px;
        font-size: 16px;
        color: #999;
        padding: 0 20px 0 0;
    }

    .news-list .item .category{
        margin: 0;
        min-width: 140px;
        padding: 0 20px 0 0;
    }

    .news-list .item .category span{
        background: #999;
        color: #FFF;
        text-align: center;
        display: inline-block;
        padding: 5px 20px;
        font-size: 12px;
        line-height: 1;
    }
    .news-list .item .title{
        margin: 0;
        width: 100%;
    }
    .news-list .item a:hover .title{
        color: #00F;
    }

    @media screen and (max-width: 767px){
        .news-list .item a{
            flex-wrap: wrap;
        }
        .news-list .item .date{
            min-width: 100px;
        }
        .news-list .item .title{
            margin-top: 10px;
        }
    }

    /* 装飾 */

    *{
        box-sizing: border-box;
    }
    a{
        text-decoration: none;
    }
    body{
        margin: 20px;
    }
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

<h1>NEWS API デモ</h1>
<span>この記事一覧はNEWS_APIから取得したものを生成・表示しています</span>

<ul class="news-list">
    @foreach($news as $data)
    <li class="item">
        <a href="{{$data['url']}}">
            <img src="{{$data['thumbnail']}}" class="image">
            <p class="category"><span>お知らせ</span></p>
            <p class="date">{{$data["datetime"]}}</p>
            <p class="title">{{$data['title']}}</p>
        </a>
    </li>
    @endforeach
</ul>

</x-app-layout>
