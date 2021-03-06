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
    查詢部落排名
</h2>
<hr>
<form method="GET" action="/clanRankings" accept-charset="UTF-8">
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">部落位置</label>

        <div class="col-sm-10">
            <select id="locationId" name="locationId" class="form-control">
                <option value=""></option>
                <option value="32000006">International</option>
                @foreach($locations as $location)
                @if($location->isCountry)
                <option value="{{$location->id}}"
                        @if($location->id == "32000228")
                    selected
                    @endif
                    >{{$location->name}}
                </option>
                @endif
                @endforeach
            </select>
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
