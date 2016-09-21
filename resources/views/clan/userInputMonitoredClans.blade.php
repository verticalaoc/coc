@extends('clan')

@section('content')
<h2>
    正在追蹤中的部落
</h2>
<hr>
<table id="clans" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>名稱</th>
        <th>tag</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($monitoredClans as $clan)
    <tr>
        <td>
            {{$clan->name}}
        </td>
        <td>
            {{$clan->tag}}
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
@stop


