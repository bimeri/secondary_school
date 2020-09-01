@extends('admin.layout')
@section('title') record discipline @endsection
@section('content')
<p class="w3-center">@lang('messages.welcome')</p>
<div class="row">
    <div class="col s11 w3-margin-left m10 w3-border-t offset-m1 w3-padding white w3-margin-bottom radius" style="margin-top: 5px">
        <form action="" method="post">
            @csrf
            <div class="row">
                <div class="input field col s12 m3">
                    <select name="year_id">
                        <option value="{{$current_year->id}}">{{ $current_year->name}}</option>
                        @foreach($years as $year)
                        <option value="{{$year->id}}">{{ $year->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <button type="submit" class="btn btn-primary waves-effect waves-light col offset-m3 offset-s3" style="width: 40%">Add Type</button>
            </div>
        </form>
    </div>
</div>
@endsection
