@extends('clan')

@section('content')
<h1>《菜菜子的部落衝突》最新消息</h1>
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
    <li><a href="{{ url('/queryClans') }}">查詢部落</a></li>
    <li><a href="{{ url('/queryClanRankings') }}">查詢部落排名</a></li>
    <li><a href="{{ url('/queryMember') }}">查詢部落成員</a></li>
</ul>
@stop

