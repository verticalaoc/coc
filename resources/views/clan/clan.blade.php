@extends('clan')

@section('content')
<h2>
    <div>
        部落歷史紀錄 - {{$clans[0]->name}}
    </div>
</h2>
<hr>
@include('clan.include.clanDetail', ['clan' => $clans[0]])
<hr>
<small class="form-text text-muted">
    以往的記錄，每天一份。
</small>
<table id="clans" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>日期</th>
        <!--    <th>badgeUrls</th>-->
        <!--    <th>location</th>-->
        <!--    <th>name</th>-->
        <!--    <th>tag</th>-->
        <!--    <th>type</th>-->
        <!--    <th>clanLevel</th>-->
        <th>總分數</th>
        <!--    <th>requiredTrophies</th>-->
        <!--    <th>warFrequency</th>-->
        <th>對戰連勝次數</th>
        <th>對戰勝利</th>
        <!--        <th>isWarLogPublic</th>-->
        <th>成員</th>
        <th>總捐兵數</th>
        <!--    <th>description</th>-->
    </tr>
    </thead>
    <tbody>
    @foreach ($clans as $clan)
    <tr>
        <td>{{$clan->created_at}}</td>
        <!--    <td><img src="{{$clan->badgeUrlsSmall}}"></td>-->
        <!--    <td>{{$clan->locationName}}</td>-->
        <!--    <td><a href="{{action('ClanController@clan',[urlencode($clan->tag)])}}">{{$clan->name}}</a></td>-->
        <!--    <td>{{$clan->tag}}</td>-->
        <!--    <td>{{$clan->type}}</td>-->
        <!--    <td>{{$clan->clanLevel}}</td>-->
        <td>{{$clan->clanPoints}}</td>
        <!--    <td>{{$clan->requiredTrophies}}</td>-->
        <!--    <td>{{$clan->warFrequency}}</td>-->
        <td>{{$clan->warWinStreak}}</td>
        <td>{{$clan->warWins}}</td>
        <!--        <td>{{$clan->isWarLogPublic}}</td>-->
        <td><a href="{{action('ClanController@members',[urlencode($clan->id)])}}">{{$clan->members}}</a>
        </td>
        <td>{{$clan->donations}}</td>
        <!--    <td>{{$clan->description}}</td>-->
    </tr>
    @endforeach
    </tbody>
    <br><br>
</table>
@stop
