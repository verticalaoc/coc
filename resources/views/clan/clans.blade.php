@extends('clan')

@section('content')
<h2>
    部落搜尋結果
</h2>
<hr>
<table id="clans" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
    <tr>
        <!--    <th>日期</th>-->
        <th>旗幟</th>
        <!--    <th>location</th>-->
        <th>名稱</th>
        <th>部落標籤</th>
        <!--    <th>type</th>-->
        <th>等級</th>
        <th>總分數</th>
        <!--    <th>requiredTrophies</th>-->
        <!--    <th>warFrequency</th>-->
        <th>對戰連勝次數</th>
        <!--    <th>warWins</th>-->
        <!--        <th>isWarLogPublic</th>-->
        <th>成員</th>
        <th>總捐兵數</th>
        <th>描述</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($clans as $clan)
    <tr>
        <!--    <td>{{$clan->created_at}}</td>-->
        <td><img src="{{$clan->badgeUrlsSmall}}"></td>
        <!--    <td>{{$clan->locationName}}</td>-->
        <td>
            {{$clan->name}}
        </td>
        <td>
            <a href="{{action('ClanController@clan',[urlencode($clan->tag)])}}">{{$clan->tag}}</a>
        </td>
        <!--    <td>{{$clan->type}}</td>-->
        <td>{{$clan->clanLevel}}</td>
        <td>{{$clan->clanPoints}}</td>
        <!--    <td>{{$clan->requiredTrophies}}</td>-->
        <!--    <td>{{$clan->warFrequency}}</td>-->
        <td>{{$clan->warWinStreak}}</td>
        <!--    <td>{{$clan->warWins}}</td>-->
        <!--        <td>{{$clan->isWarLogPublic}}</td>-->
        <td>{{$clan->members}}</td>
        <td>{{$clan->donations}}</td>
        <td>{{$clan->description}}</td>
    </tr>
    @endforeach
    </tbody>
</table>
@stop


