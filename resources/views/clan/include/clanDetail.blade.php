<div class="row">
    <div class="col-xs-3 col-md-2">名稱</div>
    <div class="col-xs-3 col-md-2">{{$clan->name}}</div>
    <div class="col-xs-3 col-md-2 col-md-offset-1">標籤</div>
    <div class="col-xs-3 col-md-2">{{$clan->tag}}</div>
</div>
<div class="row">
    <div class="col-xs-3 col-md-2">成員</div>
    <div class="col-xs-3 col-md-2">{{$clan->members}}</div>
    <div class="col-xs-3 col-md-2 col-md-offset-1">需要獎杯數</div>
    <div class="col-xs-3 col-md-2">{{$clan->requiredTrophies}}</div>
</div>
<div class="row">
    <div class="col-xs-3 col-md-2">部落位置</div>
    <div class="col-xs-3 col-md-2">{{$clan->locationName}}</div>
    <div class="col-xs-3 col-md-2 col-md-offset-1">總捐兵數</div>
    <div class="col-xs-3 col-md-2">{{$clan->donations}}</div>
</div>
<div class="row">
    <div class="col-xs-3 col-md-2">等級</div>
    <div class="col-xs-3 col-md-2">{{$clan->clanLevel}}</div>
    <div class="col-xs-3 col-md-2 col-md-offset-1">總分數</div>
    <div class="col-xs-3 col-md-2">{{$clan->clanPoints}}</div>
</div>
<!--<div class="row">-->
<!--    <div class="col-md-2">類型</div>-->
<!--    <div class="col-md-2">{{$clan->type}}</div>-->
<!--    <div class="col-md-2 col-md-offset-1">對戰頻率</div>-->
<!--    <div class="col-md-2">{{$clan->warFrequency}}</div>-->
<!--</div>-->
<div class="row">
    <div class="col-xs-3 col-md-2">對戰連勝次數</div>
    <div class="col-xs-3 col-md-2">{{$clan->warWinStreak}}</div>
    <div class="col-xs-3 col-md-2 col-md-offset-1">對戰勝利</div>
    <div class="col-xs-3 col-md-2">{{$clan->warWins}}</div>
</div>
<hr>
<div class="row">
    <div class="col-md-2">部落介紹</div>
    <div class="col-md-6">{{$clan->description}}</div>
</div>