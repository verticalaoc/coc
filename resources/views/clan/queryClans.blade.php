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
    搜尋部落
</h2>
<hr>
<form method="GET" action="/clans" accept-charset="UTF-8">
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">部落名稱</label>

        <div class="col-sm-10">
            <input class='form-control' name="name" type="text">
            <small class="form-text text-muted">
                輸入部落名稱或部落標籤(#)來搜尋。
            </small>
        </div>

    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">對戰頻率</label>

        <div class="col-sm-10">
            <select id="warFrequency" name="warFrequency" class="form-control">
                <option value="any" selected="selected">任何</option>
                <option value="never">從不</option>
                <option value="always">始終</option>
                <option value="moreThanOncePerWeek">一週兩次</option>
                <option value="oncePerWeek">一週一次</option>
                <option value="lessThanOncePerWeek">稀少</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">部落位置</label>

        <div class="col-sm-10">
            <select id="locationId" name="locationId" class="form-control">
                <option value="any">Any</option>
                @foreach($locations as $location)
                @if($location->isCountry)
                <option value="{{$location->id}}" @if($location->id ==
                    "32000228")selected="selected"@endif>{{$location->name}}
                </option>
                @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">最少部落成員</label>

        <div class="col-sm-10">
            <input class='form-control' name="minMembers" type="text" value="30">
            <small class="form-text text-muted">
                至少 30.
            </small>
        </div>

    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">最多部落成員</label>

        <div class="col-sm-10">
            <input class='form-control' name="maxMembers" type="text" value="50">
            <small class="form-text text-muted">
                至少 30, 最多 50, 且大於'最少部落成員'
            </small>
        </div>

    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">最低部落等級</label>

        <div class="col-sm-10">
            <input class='form-control' name="minClanLevel" type="text" value="5">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">最低部落分數</label>

        <div class="col-sm-10">
            <input class='form-control' name="minClanPoints" type="text">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-4 col-sm-offset-8">
            <input class="btn btn-primary form-control" type="submit" name="submit" value="搜尋">
            <small class="form-text text-muted">
                最多回傳 1000 筆資料
            </small>
        </div>
    </div>
</form>
<hr>

@stop
