@extends('admin.layout')
@section('title') Record Marks @endsection
@section('style')
<style>
    @media only screen and (max-width: 600px) {
    }
    table{
        border: 1px solid black !important;
        border-collapse: collapse;
    }
    .refl{
        /* -webkit-box-reflect: right 10px linear-gradient(transparent, #cc00ff, #0002); */
    }
    td, th, tr{
        border: 1px solid black !important;
        font-size: 11px !important
    }
    th>div#stud{
        margin-top: 10px !important;
        /* transform: rotate(-20deg) !important; */
    }
    th>div#studs{
        margin-top: 10px !important;
    }
    input[type='number'].sp{
        position: absolute ;
        outline: none !important;
        border: 1px solid transparent !important;
        border-bottom: 1px solid white !important;
        width: 60px !important;
        height: 30px !important;
        margin-top: -12px;
        margin-left: -31px;
    }
    input[type='number'].ss{
        position: absolute;
        outline: none !important;
        border: 1px solid transparent !important;
        border-bottom: 1px solid white !important;
        width: 60px !important;
        height: 30px !important;
        margin-top: -12px;
        margin-left: -31px ;
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
<div class="row">
    <div class="col s12 m7 offset-m3 bold teal-text rounded waves-effect waves-orange w3-center">
        @lang('messages.record_marks_header')
    </div>
</div>
<div class="row">
    <div class="row container w3-margin-bottom" style="font-size: 13px">
        <form method="get" action="{{ route('record.student.get') }}">
            @csrf
            <div class="col m3 s12">
                <select name="sector" class="browser-default" id="sector" onchange="getBackground(event)">
                    <option value="" disabled selected>select the Sector</option>
                    @foreach (App\Sector::all() as $sector)
                    <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col s12 m3" id="backgrounds">
                <select class="browser-default" name="background" id="background" required onchange="getclasses(event)">
                    <option value="">select the Background</option>
                </select>
            </div>

            <div class="col s12 m4" id="classes">
                <select class="browser-default" name="class" id="form" required>
                    <option value="">select the Class</option>
                </select>
            </div>
            <div class="col m2 offset-s3 m2" style="margin-top: 2px !important">
                <button class="btn btn-primary waves-effect waves-light" onclick="load()">Get Students</button>
            </div>
        </form>
    </div>
    <div class="col s11 m10 w3-border-t offset-m1 w3-padding white w3-margin-bottom radius w3-margin-left" style="margin-top: -13px">
        <div class="col s12 m12 refl" style="overflow-x:scroll !important;">
            <h5 class="center teal-text">{{ __('messages.record_grading') }}. <b>(/20)</b></h5>
            <table id="myTable" class="w3-table w3-border-t" style="font-size: 13px !important;">
                <tr class="teal">
                        <th rowspan="2" class="w3-xlarge blue">@if(!Empty($students))<div id="stud">Students</div>@else<div id="studs">Students</div>@endif</th>
                        @foreach ($subjects as $sub)
                            <th class="black-text tooltip-wrapper" colspan="2"  id="subjects">
                                <a class="tooltip tooltip-left" data-tooltip="{{ $sub->code }}">{{ $sub->name }}</a>
                            </th>
                        @endforeach
                    <tr>
                        @foreach ($subjects as $sub)
                        @if($first)
                            <td>1<sup>st</sup> Seq</td>
                            <td>2<sup>nd</sup> Seq</td>
                        @endif
                        @if($second)
                            <td>3<sup>rd</sup> Seq</td>
                            <td>4<sup>th</sup> Seq</td>
                        @endif
                        @if($third)
                            <td>5<sup>th</sup> Seq</td>
                            <td>6<sup>th</sup> Seq</td>
                        @endif
                        @endforeach
                    </tr>
                </tr>
                @include('admin.public.includes.class.class_a_students')
                @include('admin.public.includes.class.class_b_students')
                @include('admin.public.includes.class.class_c_students')
            </table>
        </div>
    </div>
</div>
@endsection
