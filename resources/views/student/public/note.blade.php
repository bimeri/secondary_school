@extends('student.layout')
@section('title') {{ __('student_viewNote') }} @endsection
@section('content')
<div class="row">
    <div class="col s12 m10 w3-border-s offset-m1 radius white">
        <div class="row w3-margin-top">
            <div class="col s11 m10 w3-border-teacher offset-m1 radius white">
                <div class="col s12 m12 w3-padding" style="overflow-x:auto !important;">
                    <div class="green lighten-4 green-text center">
                        Viewing Pdf Document from Subject:<b> {{ $subjectDetail->name }}</b>, code: <b>{{ $subjectDetail->code }}</b>
                    </div>
                    <embed src="{{ URL::asset(''.$fileDetail->file_path.'/'.$fileDetail->file_name.'') }}" type="application/pdf" width="100%" height="700px" />
                </div>
            </div>
        </div>
    </div>
<a href="{{route('student.subjects')}}" class="w3-btn w3-black waves-effect waves-light w3-medium" style="position: fixed; buttom: 20px;left:10px;z-index:9; border-radius:10px"><i class="fa fa-arrow-alt-circle-left"></i> Go Back</a>
</div>
@endsection
