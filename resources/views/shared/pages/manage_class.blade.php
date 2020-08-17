@extends('admin.layout')
@section('title'){{ __('manage_user') }}@endsection

@section('content')
<div class="row w3-margin-top">
    <div class="col s12 m8 offset-m2" style="height: 65px;">
        <form action="" method="">
            <div class="row" style="margin-top: -10px">
                <div class="input-field col s12 m3">
                    <input type="text" name="className" class="validate" id="className">
                    <label for="className">Class Name</label>
                </div>
                <div class="input-field col s12 m3">
                    <select class="" name="series" id="series">
                        <option value="" disabled>select series</option>
                        <option value="A">Series A</option>
                        <option value="B">Series B</option>
                        <option value="C">Series C</option>
                        <option value="Science">Sience</option>
                        <option value="Art">Art</option>
                    </select>
                    <label for="series">Select Series</label>
                </div>
            </div>
        </form>
    </div><hr>
</div>
@endsection
