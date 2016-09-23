@extends('clan')

@section('content')
@if (count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if (Session::get('message'))
<div class="alert alert-success">
    <ul>
        <li>{{ Session::get('message') }}</li>
    </ul>
</div>
@endif
<h2>
    新增要追蹤的部落
</h2>
<hr>
<form method="POST" action="/userInputMonitoredClans" accept-charset="UTF-8">
    {{ csrf_field() }}
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">部落標籤(#)</label>
        <div class="col-sm-10">
            <input class='form-control' name="tag" type="text">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-4 col-sm-offset-8">
            <input class="btn btn-primary form-control" type="submit" name="submit" value="搜尋">
        </div>
    </div>
</form>
@stop
