@extends('clan')

@section('content')
@if(!empty($clan))
<div>
<h2>
    部落詳細資訊 - {{ $clan->name }}
</h2>
@include('clan.include.clanDetail')
<hr>
<h1>成員資訊</h1>
<table id="members" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
    <tr>
        <td>聯盟</td>
        <td>名稱</td>
        <td>成員標籤</td>
        <td>職位</td>
        <td>經驗</td>
        <td>獎杯數</td>
        <!--        <td>clanRank</td>-->
        <!--        <td>previousClanRank</td>-->
        <td>捐兵數</td>
        <td>收兵數</td>
        <td>捐收比</td>
        <!--    <td>leagueId</td>-->
        <!--    <td>leagueName</td>-->
    </tr>
    </thead>
    <tbody>
    @foreach($memberList as $member)
    <tr>
        <td><img src="{{$member->leagueIconUrlsSmall}}"></td>
        <td>{{$member->name}}</td>
        <td><a href="{{ url('/member', [$member->tag])}}">{{$member->tag}}</a></td>
        <td>{{$member->role}}</td>
        <td>{{$member->expLevel}}</td>
        <td>{{$member->trophies}}</td>
        <!--        <td>{{$member->clanRank}}</td>-->
        <!--        <td>{{$member->previousClanRank}}</td>-->
        <td>{{$member->donations}}</td>
        <td>{{$member->donationsReceived}}</td>
        <td>{{$member->donationRatio}}</td>
        <!--    <td>{{$member->leagueId}}</td>-->
        <!--    <td>{{$member->leagueName}}</td>-->
    </tr>
    @endforeach
    </tbody>
</table>
</div>
@else
<h2>
    部落不存在
</h2>
@endif
@stop
