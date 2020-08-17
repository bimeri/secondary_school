@extends('admin.layout')
@section('title') record discipline @endsection
@section('content')
<p class="w3-center">@lang('messages.welcome')</p>
<div class="row">
    <div class="col s11 w3-margin-left m10 w3-border-t offset-m1 w3-padding white w3-margin-bottom radius" style="margin-top: 5px">
        <form action="" method="post">
            @csrf
            <div class="row">
                <div class="input-field col s12 m3 offset-m1">
                    <input name="discipline_type" id="au" type="text" class="validate" value="{{ old('discipline_type') }}">
                    <label for="au">Add discipline Type</label>
                </div>
                <div class="input-field col s12 m3">
                    <select>
                        <option>select year</option>
                        <option>2019</option>
                        <option>2020</option>
                    </select>
                    <label for="code">Description of Type</label>
                </div>
            </div>
            <div class="row">
                <button type="submit" class="btn btn-primary waves-effect waves-light col offset-m3 offset-s3" style="width: 40%">Add Type</button>
            </div>
        </form>
    </div>
</div>
@endsection
