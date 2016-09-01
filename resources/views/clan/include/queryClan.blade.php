<div class="container">
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
    <form method="POST" action="/clans" accept-charset="UTF-8">
        {{ csrf_field() }}
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
                    <option value="any" selected="selected">Any</option>
                    @foreach($locations as $location)
                    @if($location->isCountry)
                    <option value="{{$location->id}}">{{$location->name}}</option>
                    @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">最少部落成員</label>

            <div class="col-sm-10">
                <input class='form-control' name="minMembers" type="text" value="30">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">最多部落成員</label>

            <div class="col-sm-10">
                <input class='form-control' name="maxMembers" type="text" value="50">
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
            <label class="col-sm-2 col-form-label">筆數</label>

            <div class="col-sm-10">
                <input class='form-control' name="limit" type="text" value="10">
                <small class="form-text text-muted">
                    限制回傳筆數。如不限定，搜尋時間將會依情況延長。
                </small>
            </div>

        </div>
        <input class="btn btn-primary form-control" type="submit" name="submit" value="搜尋">
    </form>
</div>
<hr>
