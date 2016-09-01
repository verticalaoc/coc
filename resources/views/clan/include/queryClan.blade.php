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

    <h1>
        搜尋部落
    </h1>
    <hr>
    {!! Form::open(['url' => 'clans']) !!}
    <div class="form-group row">
        {!! Form::label('name', '部落名稱', ['class'=>'col-sm-2 col-form-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
            <small class="form-text text-muted">
                輸入部落名稱或部落標籤(#)來搜尋。
            </small>
        </div>

    </div>
    <div class="form-group row">
        {!! Form::label('warFrequency', '對戰頻率', ['class'=>'col-sm-2 col-form-label']) !!}
        <div class="col-sm-10">
            {!!
            Form::select('warFrequency', array(
            'any' => '任何',
            'never' => '從不',
            'always' => '始終',
            'moreThanOncePerWeek' => '一週兩次',
            'oncePerWeek' => '一週一次',
            'lessThanOncePerWeek' => '稀少'
            ), null, ['class'=>'form-control'])
            !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('location', '部落位置', ['class'=>'col-sm-2 col-form-label']) !!}
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
        {!! Form::label('minMembers', '最少部落成員', ['class'=>'col-sm-2 col-form-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('minMembers', 30, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('maxMembers', '最多部落成員', ['class'=>'col-sm-2 col-form-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('maxMembers', 50, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('minClanLevel', '最低部落等級', ['class'=>'col-sm-2 col-form-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('minClanLevel', 5, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('minClanPoints', '最低部落分數', ['class'=>'col-sm-2 col-form-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('minClanPoints', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('limit', '筆數', ['class'=>'col-sm-2 col-form-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('limit', 10, ['class' => 'form-control']) !!}
            <small class="form-text text-muted">
                限制回傳筆數。如不限定，搜尋時間將會依情況延長。
            </small>
        </div>

    </div>
    <!--    <div class="form-group row">-->
    <!--        {!! Form::label('after', 'after:', ['class'=>'col-sm-2 col-form-label']) !!}-->
    <!--        <div class="col-sm-10">-->
    <!--            {!! Form::text('after', null, ['class' => 'form-control']) !!}-->
    <!--            <small class="form-text text-muted">-->
    <!--                Return only items that occur after this marker.-->
    <!--                After marker can be found from the response, inside the 'paging' property.-->
    <!--                Note that only after or before can be specified for a request, not both.-->
    <!--            </small>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--    <div class="form-group row">-->
    <!--        {!! Form::label('before', 'before:', ['class'=>'col-sm-2 col-form-label']) !!}-->
    <!--        <div class="col-sm-10">-->
    <!--            {!! Form::text('before', null, ['class' => 'form-control']) !!}-->
    <!--            <small class="form-text text-muted">-->
    <!--                Return only items that occur before this marker.-->
    <!--                Before marker can be found from the response, inside the 'paging' property.-->
    <!--                Note that only after or before can be specified for a request, not both.-->
    <!--            </small>-->
    <!--        </div>-->
    <!--    </div>-->
    {!! Form::submit('搜尋', ['class'=>'btn btn-primary form-control']) !!}
    {!! Form::close() !!}
</div>
<hr>
