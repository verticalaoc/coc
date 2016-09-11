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

<h2>
    查詢部落成員
</h2>
<hr>
<form method="GET" action="/queryMemberWithTag" accept-charset="UTF-8">
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">部落成員標籤</label>
        <div class="col-sm-10">
            <input class='form-control' name="memberTag" type="text">
            <small class="form-text text-muted">
                輸入部落成員標籤(#)來搜尋。
            </small>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-4 col-sm-offset-8">
            <input class="btn btn-primary form-control" type="submit" name="submit" value="搜尋">
        </div>
    </div>
</form>
<hr>
@stop
