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
    以往搜尋過的記錄，每天一份。
</small>
<table id="clans" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
    @include('clan.include.clansHistoricalTitle')
    </thead>
    <tbody>
    @foreach ($clans as $clan)
    @include('clan.include.clansHistoricalContent')
    @endforeach
    </tbody>
    <br><br>
</table>
@stop
