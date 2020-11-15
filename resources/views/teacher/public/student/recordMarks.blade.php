@extends('teacher.layout')
@section('title') {{ __('teacher_student_mark') }} @endsection
@section('style')
<style>
    td, th, tr{
        border-collapse: collapse;
        border: 1px solid black !important;
        font-size: 11px !important
    }
    table{
        border: 1px solid black !important;
        /* box-shadow: 0 0 25px rgb(130, 243, 130), inset 0 0 25px rgb(138, 224, 138); */
    }
    th{
        text-align: center !important;
    }
    .refl{
        /* -webkit-box-reflect: right 10px linear-gradient(transparent, #cc00ff, #0002); */
    }
    th.stud{
        margin-top: 10px !important;
        color: white;
        text-align: center !important;
    }
    input[type='number'].sp{
        position: absolute ;
        outline: none !important;
        border: 1px solid transparent !important;
        border-bottom: 1px solid white !important;
        width: 100px !important;
        height: 30px !important;
        margin-top: -10px;
        margin-left: -55px !important;
    }
    input[type='number'].ss{
        position: absolute;
        outline: none !important;
        border: 1px solid transparent !important;
        border-bottom: 1px solid white !important;
        width: 100px !important;
        height: 30px !important;
        margin-top: -10px;
        margin-left: -55px !important;
    }

    input[type = 'number'].sp{
        color:#2196F3 !important;
        text-align: center;
        font-weight: bold;
        font-size: 11px !important;
        font-family: 'Comic sans MS';
    }
    input[type = 'number'].ss{
        color:#F44336 !important;
        text-align: center;
        font-weight: bold;
        font-size: 12px !important;
        font-family: 'Comic sans MS';
    }
    th#subjects{
        max-width: 5px !important;
        max-height: 5px !important;
        text-rendering: inherit;
    }
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
    }
    input[type=number]{
        -moz-appearance: textfield !important;
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
        <div class="col s12 m12 w3-padding" style="overflow-x:auto !important;">
            <table id="myTable" class="w3-table w3-border-t" style="font-size: 13px !important;">
                <tr class="teal teal-text lighten-4 center">
                    <td colspan="{{ $subjects->count()*2 + 1 }}" style="font-size: 17px !important">
                        {{ __('messages.record_grading') }}. <b>( /20)</b>
                    </td>
                </tr>
                @if (!$recordingMarks)
                <tr class="red red-text lighten-5 center">
                    <td colspan="{{ $subjects->count()*2 + 1 }}">
                        Recording of marks has been stop by the Administrator
                    </td>
                </tr>
                @endif
                <tr class="teacher-dark">
                        <th rowspan="2" class="w3-xlarge teacher" class="stud">Students</th>
                        @foreach ($subjects as $sub)
                            <th class="black-text tooltip-wrapper" colspan="2"  id="subjects">
                                <a class="tooltip tooltip-left" data-tooltip="{{ $sub->code }}">{{ $sub->name }}</a>
                            </th>
                        @endforeach
                    <tr>
                        @foreach ($subjects as $sub)
                        @if($first)
                            <td style="text-align: center">1<sup>st</sup> Sequence</td>
                            <td style="text-align: center">2<sup>nd</sup> Sequence</td>
                        @endif
                        @if($second)
                            <td style="text-align: center">3<sup>rd</sup> Sequence</td>
                            <td style="text-align: center">4<sup>th</sup> Seq</td>
                        @endif
                        @if($third)
                            <td style="text-align: center">5<sup>th</sup> Sequence</td>
                            <td style="text-align: center">6<sup>th</sup> Sequence</td>
                        @endif
                        @endforeach
                    </tr>
                </tr>
            @include('teacher.public.includes.classes.class_a_students')
            @include('teacher.public.includes.classes.class_b_students')
            @include('teacher.public.includes.classes.class_c_students')
            </table>
        </div>
    </div>
</div>
@endsection
