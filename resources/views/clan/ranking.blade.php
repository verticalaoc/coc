@extends('clan')

@section('content')
<h2>
    部落排名 - {{$clans[0]->locationName}}
</h2>
<hr>
<table id="clans" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>旗幟</th>
        <th>標籤</th>
        <th>名稱</th>
<!--        <th>位置</th>-->
        <th>等級</th>
        <th>成員</th>
        <th>總分數</th>
        <th>排名</th>
        <th>前次排名</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($clans as $clan)
    <tr>
        <td><img src="{{$clan->badgeUrlsSmall}}"></td>
        <td>{{$clan->tag}}</td>
        <td>{{$clan->name}}</td>
<!--        <td>{{$clan->locationName}}</td>-->
        <td>{{$clan->clanLevel}}</td>
        <td>{{$clan->members}}</td>
        <td>{{$clan->clanPoints}}</td>
        <td>{{$clan->rank}}</td>
        <td>{{$clan->previousRank}}</td>
    </tr>
    @endforeach
    </tbody>
</table>
@stop


