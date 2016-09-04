@extends('clan')

@section('content')
<h2>
    TOP Clans in {{$clans[0]->locationName}}
</h2>
<hr>
<table id="clans" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>旗幟</th>
        <th>tag</th>
        <th>名稱</th>
        <th>location</th>
        <th>等級</th>
        <th>成員</th>
        <th>clanPoints</th>
        <th>ranking</th>
        <th>previousRank</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($clans as $clan)
    <tr>
        <td><img src="{{$clan->badgeUrlsSmall}}"></td>
        <td>{{$clan->tag}}</td>
        <td>{{$clan->name}}</td>
        <td>{{$clan->locationName}}</td>
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


