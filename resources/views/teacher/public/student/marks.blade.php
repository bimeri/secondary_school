@extends('teacher.layout')
@section('title') {{ __('teacher_student_mark') }} @endsection
@section('style')
<style>
    td, th, tr{
        border-collapse: collapse;
        border: 1px solid black !important;
        font-size: 14px !important
    }

</style>
@endsection
@section('content')
<div class="row w3-margin-top">
    <div class="col s11 m10 w3-border-teacher offset-m1 radius white">
        <form action="{{ route('teacher.record.student.mark') }}" method="get">
            @csrf
            <div class="row">
                <h5 class="center w3-padding black-text">Select the subject from which you want to enter students marks</h5>
                <div class="col s12 m4 offset-m3">
                    <select class="browser-default" name="class">
                        <option value="">select the subjects</option>
                        @foreach ($teacherSubjecs as $sub)
                            <option value="{{ Crypt::encrypt($sub['class_id']) }}">{{ $sub['sub_name'] }}/{{ $sub['class'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col" class="s12 m3">
                    <button type="submit" class="w3-btn w3-teacher waves-effect waves-light" onclick="load()">get Students</button>
                </div>
            </div>
        </form>
        <hr>
    </div>
</div>
@endsection
