@extends('clan')

@section('content')
<h1>《菜菜子的部落衝突》最新消息</h1>
<hr>
[20170125] <br>
新功能 & 介面調整
<ul>
    <li>新增部落成員的科技資訊. <a href="{{ url('/players/%23VCCQGJJQ') }}">點我看範例</a></li>
    <li>以線上最新的資料為主, 歷史資料為輔</li>
    <li>簡化搜尋介面, 將 '查詢部落排名' & '查詢部落成員' 整合到<a href="{{ url('/query') }}">查詢部落</a>裡面嚕！</li>
</ul>
<br>
<hr>
[20161207] <br>
為了減輕伺服器負擔～<br>
目前只會追蹤七級以上的部落資訊 <br>
如有需要請多利用 <b>新增追蹤部落</b> 功能<br>
<hr>
[20161008] <br>
十月份更新來嚕！更新詳情請看<a href="https://clashofclans.com/zh/blog/release-notes/october-2016-update">官方部落格</a> <br>
裡面有提到遊戲內即將支援 < 透過玩家標籤搜尋玩家（可在玩家個人簡介頁面查看）> <br>
官方 API 也將提供更豐富的玩家資訊, 敬請期待接下來的更新. <br>
<hr>
[20160928] <br>
伺服器出了一些狀況, 經過昨天緊急修復後, 目前已恢復正常.<br>
造成的影響是 09/24~27 這三天會沒有記錄. 請大家見諒嚕～ <br>
<hr>
[20160923]<br>
新增功能
<ul>
    <li><a href="{{ url('/monitoredClans') }}">查詢追蹤中的部落</a></li>
    <li><a href="{{ url('/userInputMonitoredClans/add') }}">新增追蹤部落</a></li>
</ul>
<hr>
[20160915]<br>
正式上線, 提供以下功能
<ul>
    <li><a href="{{ url('/query') }}">查詢部落</a></li>
    <!--    <li><a href="{{ url('/queryClanRankings') }}">查詢部落排名</a></li>-->
    <!--    <li><a href="{{ url('/queryMember') }}">查詢部落成員</a></li>-->
</ul>
@stop

