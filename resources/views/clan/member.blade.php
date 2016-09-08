@extends('clan')

@section('content')
<h2>
    Member - {{$memberList[0]->name}} 詳細資訊
</h2>

<table id="member" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
    <tr>
        <td>date</td>
        <td>聯盟</td>
<!--        <td>名稱</td>-->
        <td>clan name</td>
<!--        <td>tag</td>-->
        <td>職位</td>
        <td>經驗</td>
        <td>獎杯數</td>
        <!--        <td>clanRank</td>-->
        <!--        <td>previousClanRank</td>-->
        <td>捐兵數</td>
        <td>收兵數</td>
        <!--    <td>leagueId</td>-->
        <!--    <td>leagueName</td>-->
    </tr>
    </thead>
    <tbody>
    @foreach($memberList as $member)
    <tr>
        <td>{{$member->created_at}}</td>
        <td><img src="{{$member->leagueIconUrlsSmall}}"></td>
<!--        <td>{{$member->name}}</td>-->
        <td>{{$clanList[$member->clanId]->name}}</td>
<!--        <td><a href="{{ url('/member', [$member->tag])}}">{{$member->tag}}</a></td>-->
        <td>{{$member->role}}</td>
        <td>{{$member->expLevel}}</td>
        <td>{{$member->trophies}}</td>
        <!--        <td>{{$member->clanRank}}</td>-->
        <!--        <td>{{$member->previousClanRank}}</td>-->
        <td>{{$member->donations}}</td>
        <td>{{$member->donationsReceived}}</td>
        <!--    <td>{{$member->leagueId}}</td>-->
        <!--    <td>{{$member->leagueName}}</td>-->
    </tr>
    @endforeach
    </tbody>
</table>
</div>
@stop
