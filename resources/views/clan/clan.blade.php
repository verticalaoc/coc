@extends('clan')

@section('content')
<div class="container">
    <h1>
        部落歷史紀錄 - {{$clans[0]->name}}
    </h1>
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
</div>
@stop
