@extends('teacher.layout')
@section('title') {{ __('teacher_preview') }} @endsection
@section('content')
<div class="row w3-margin-top">
<a href="{{route('teacher.subjects')}}" class="w3-btn w3-black waves-effect waves-light w3-medium" style="position: fixed; buttom: 0px;left:10px;z-index:999; border-radius:10px"><i class="fa fa-arrow-alt-circle-left"></i> Go Back</a>
    <div class="col s11 m10 w3-border-teacher offset-m1 radius white">
        <div class="col s12 m12 w3-padding" style="overflow-x:auto !important;">
            <div class="green lighten-4 green-text center">
                Viewing Pdf Document from Subject:<b> {{ $subjectDetail->name }}</b>, code: <b>{{ $subjectDetail->code }}</b>
            </div>
            <embed src="{{ URL::asset(''.$fileDetail->file_path.'/'.$fileDetail->file_name.'') }}" type="application/pdf" width="100%" height="700px" />
        </div>
    </div>
</div>
@endsection
