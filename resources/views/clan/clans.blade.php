@extends('clan')

@section('content')
<div class="container">
    <h1>
        部落搜尋結果
    </h1>
    <hr>
    <table id="clans" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
        @include('clan.include.clansOverviewTitle')
        </thead>
        <tbody>
        @foreach ($clans as $clan)
        @include('clan.include.clansOverviewContent')
        @endforeach
        </tbody>
    </table>
</div>
@stop


