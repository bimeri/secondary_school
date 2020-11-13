@extends('teacher.layout')
@section('title') {{ __('teacher_preview') }} @endsection
@section('content')
<div class="row w3-margin-top">
<a class="w3-btn white-text waves-effect waves-light orange w3-padding" style="position: fixed; right:10px; top:70px">Edit <i class="fa fa-plus"></i></a>

<a href="{{route('teacher.subjects')}}" class="w3-btn w3-black waves-effect waves-light w3-medium" style="position: fixed; buttom: 0px;left:10px;z-index:999; border-radius:10px"><i class="fa fa-arrow-alt-circle-left"></i> Go Back</a>
    <div class="col s11 m10 w3-border-teacher offset-m1 radius white">
        <div class="col s12 m12 w3-padding" style="overflow-x:auto !important;">
            <div class="w3-teacher lighten-4 blue-text center" style="border-radius: 10px">
                Title:<b> {{ $assignments->name }}</b>, subject: <b>{{ $assignments->subject->name }}/{{ $assignments->subject->code }}</b>. Academic year: <b>{{ $assignments->year->name }}</b>
            </div>
            <div class="row">
                <div class="col s12 m10 offset-m1 w3-padding w3-border w3-margin-top">
                    {!! $assignments->text !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
