@extends('clan')

@section('content')
<h1>常見問題</h1>
<hr>
Q: 為什麼我查詢的部落沒有歷史記錄？<br>
A: 因資料量過於龐大, 預設只會追蹤符合以下條件的部落喔！<br>
<ul>
    <li>等級 7 以上</li>
    <li>人數 30 以上</li>
    <li>台灣部落</li>
</ul>
<hr>
Q: 如果我想關注的部落沒有被追蹤, 怎麼辦？<br>
A: <a href="{{ url('/userInputMonitoredClans/add') }}">沒問題! 點這來輸入您想關注的部落吧！</a>
<hr>
Q: 目前正在追蹤哪些部落？<br>
A: <a href="{{ url('/monitoredClans') }}">點我看追蹤中的部落列表</a>
<hr>
Q: 部落成員怎麼沒有歷史紀錄？ <br>
A: 部落成員的資料是跟著部落資料一起被記錄的.<br>
只要追蹤部落成員所屬的部落, 之後就會有記錄嚕！<br>

@stop

