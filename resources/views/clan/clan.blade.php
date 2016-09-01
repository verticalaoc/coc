@extends('clan')

@section('content')
<h2>
    部落歷史紀錄 - {{$clans[0]->name}}
</h2>
<hr>
@include('clan.include.clanDetail', ['clan' => $clans[0]])
<hr>
<table id="clans" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
    @include('clan.include.clansHistoricalTitle')
    </thead>
    <tbody>
    @foreach ($clans as $clan)
    @include('clan.include.clansHistoricalContent')
    @endforeach
    </tbody>
</table>
@stop
