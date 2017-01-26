@extends('clan')
@section('content')
<h3>
    <div>
        部落資訊 - {{$clan->name}}
    </div>
</h3>
<hr>
@include('clan.include.clanDetail', ['clan' => $clan])
<hr>
<h4>成員資訊</h4>
<table id="members" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
    <tr>
        <td>聯盟</td>
        <td>名稱</td>
        <td>成員標籤</td>
        <td>職位</td>
        <td>經驗</td>
        <td>獎杯數</td>
        <td>捐兵數</td>
        <td>收兵數</td>
        <td>捐收比</td>
    </tr>
    </thead>
    <tbody>
    @foreach($memberList as $member)
    <tr>
        <td><img src="{{$member->leagueIconUrlsSmall}}"></td>
        <td>{{$member->name}}</td>
        <td><a href="{{ url('/players', [$member->tag])}}">{{$member->tag}}</a></td>
        <td>{{$member->role}}</td>
        <td>{{$member->expLevel}}</td>
        <td>{{$member->trophies}}</td>
        <td>{{$member->donations}}</td>
        <td>{{$member->donationsReceived}}</td>
        <td>{{$member->donationRatio}}</td>
    </tr>
    @endforeach
    </tbody>
</table>
<hr>
<h4>最近30天記錄</h4>
<table id="clans" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>日期</th>
        <th>總分數</th>
        <th>對戰連勝次數</th>
        <th>對戰勝利</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($clanHistory as $c)
    <tr>
        <td>{{$c->created_at}}</td>
        <td>{{$c->clanPoints}}</td>
        <td>{{$c->warWinStreak}}</td>
        <td>{{$c->warWins}}</td>
    </tr>
    @endforeach
    </tbody>
    <br><br>
</table>
@stop
