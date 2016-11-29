@extends('layouts.home')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('statics/css/common.css?v1.0') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('statics/css/newspage.css?v1.0') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('statics/css/markdown.css') }}">
@endsection
@section('seo_title', $article->title.'-淘客助手，让推广更高效')
@section('content')
<div class="main wth clearfix">
    <div class="maintop">
        <p><i></i>我的位置：<a href="#">首页</a>&nbsp;&gt;&nbsp;最新公告</p>
    </div>
    <div class="news clearfix">
        <div class="newsleft fl">
            <ul>
                <li><h2 class="cement">最新公告</ha></li>
                @foreach($new_articles as $item)
                <li>
                    <a href="/articles/{{ $item->id }}"><p>{{ str_limit($item->title, 32, '') }}</p>
                        <span class="time">{{ date('Y-m-d H:i:s', strtotime($item->created_at)) }}</span>
                    </a>
                </li>
                @endforeach
            </ul>
            <div class="cementbtn">
                <a href="#"><i></i><p>更多</p></a>
            </div>	
        </div>
        <div class="newsbox fr">
            <h2 class="newstitle">{{ $article->title }}</h2>
            <p class="newsinfo">发布于：{{ date('Y-m-d H:i:s', strtotime($article->created_at)) }}</p>
            <div class="newscontent markdown-body">
                {!! $article->content !!}
            </div>
        </div>
    </div>
    <!--news结束-->
</div>
@endsection