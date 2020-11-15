@extends('admin.layout')
@section('title') rank student @endsection
@section('style')
<style>
    table{
        border: 1px solid black !important;
    }
    td, th, tr{
        border: 1px solid black !important;
        font-size: 11px !important
    }
    th>div#stud{
        margin-top: 10px !important;
        transform: rotate(-23deg) !important;
    }
    input[type='number'].sp{
        position: absolute !important;
        outline: none !important;
        border: 1px solid transparent !important;
        border-bottom: 1px solid white !important;
        width: 60px !important;
        height: 30px !important;
        margin-top: -8px !important;
        margin-left: -31px !important;
    }
    input[type='number'].ss{
        position: absolute !important;
        outline: none !important;
        border: 1px solid transparent !important;
        border-bottom: 1px solid white !important;
        width: 60px !important;
        height: 30px !important;
        margin-top: -8px !important;
        margin-left: -31px !important;
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
    .bn{
    border: none;
    display: inline-block;
    padding: 4px 8px;
    vertical-align: middle;
    overflow: hidden;
    text-decoration: none;
    color: inherit;
    background-color: inherit;
    text-align: center;
    cursor: pointer;
    white-space: nowrap;
}
</style>
@endsection
@section('content')
<div class="row">
    <h5 class="right w3-padding w3-center" style="position: absolute; float: right !important"><b>{{ $current_year->name }}</b> Academic year<br>{{ $current_term->name }}</h5>
    <div class="col s12 m6 offset-m3 teal teal-text lighten-5 waves-effect waves-orange w3-center">
        @lang('messages.rank_student')
    </div>
</div>
<div class="row">
    <div class="col s12 m10 offset-m2" style="font-size: 13px">
        <form method="get" action="{{ route('rank.result') }}">
            @csrf
            <div class="row">
                <div class="col m2 s12">
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

                <div class="col s12 m3" id="classes">
                    <select class="browser-default" name="class" id="form" required>
                        <option value="">select the Class</option>
                    </select>
                </div>
                <div class="col m2 offset-s3 m3 input-field">
                    <button class="w3-btn w3-teal waves-effect waves-light" onclick="load()">Generate {{ $current_term->name }} Result</button>
                </div>
            </div>
        </form>
    </div>

    <div class="col s11 m10 w3-border-t offset-m1 radius white w3-margin-left">
        @if($ranked->count() > 0)
            @if(Session::has('message'))
            <div class="w3-center alert alert-danger w3-margin-top" role="alert">
                {{ Session::get('message') }}
            </div>
            @endif
        @else
        @if(Session::has('message'))
            <div class="w3-center alert alert-danger w3-margin-top" role="alert">
                {{ Session::get('message') }}
            </div>
        @endif
            <div class="alert alert-danger center w3-margin-top" role="alert">there is no class result generated already</div>
        @endif

        {{-- get all students from class and theri results --}}
        <form action="{{ route('student.class.result') }}" method="get">
            @csrf
            <div class="row">
                <div class="input-field col s12 m3 offset-m4">
                    <select name="year" class="validate">
                        <option value="{{ Crypt::encrypt($c_year->id) }}">{{ $c_year->name }}</option>
                        @foreach (App\Year::getAllYear() as $yr)
                            <option value="{{ Crypt::encrypt($yr->id) }}">{{ $yr->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-field col s12 m3 offset-m1">
                    <button type="submit" class="btn teal lighten-3 waves-effect waves-light">get Result</button>
                </div>
            </div>
        </form>
        <hr style="margin-top: -20px">

        <div class="row">
            <h5 class="center blue-text">Result for the Academic year: {{$year_name }} </h5>
            @if($class_results->count() == 0)
                @if($notify != '')
                    <div class="col m12 s12 w3-margin-top">
                        <div class="alert alert-danger center w3-padding w3-small" role="alert">
                            <b>{{ $notify }}</b>
                        <i onclick="this.parentElement.style.display='none'" class="close right hover" style="color: green">&times;</i>
                        </div>
                    </div>
                @endif
            @else
            <table id="myTable" class="w3-table w3-border-t" style="font-size: 13px !important;">
                <tr class="teal">
                    <th>S/N</th>
                    <th>Class Name</th>
                    <th>Term</th>
                    <th>background/Sector</th>
                    <th>Total Student</th>
                    <th>Passed</th>
                    <th>Failed</th>
                    <th>Highest Average</th>
                    <th>Lowest Average</th>
                    <th>Class Average</th>
                    <th colspan="2">Action</th>
                </tr>
                @foreach ($class_results as $key => $result)
                    <td>{{ $key+1 }}</td>
                    <td>{{ $result->form->name }}</td>
                    <td>{{ $result->term->name }}</td>
                    <td>{{ $result->form->background->name }}/{{ $result->form->background->sector->name }}</td>
                    <td>{{ $result->number_of_student }}</td>
                    <td>{{ $result->number_passed }}</td>
                    <td>{{ (int)$result->number_of_student - (int)$result->number_passed }}</td>
                    <td class="{{ (float)$result->highest_avg >= 10 ? 'blue-text':'red-text'}}">{{ (float)$result->highest_avg }}</td>
                    <td class="{{ (float)$result->lowest_avg >= 10 ? 'blue-text':'red-text'}}">{{ $result->lowest_avg }}</td>
                    <td class="{{ (float)$result->class_avg >= 10 ? 'blue-text':'red-text'}}">{{ $result->class_avg }}</td>
                    <td>
                        @if(App\Classresult::where('year_id', $result->year_id)->where('term_id',$result->term_id)->where('form_id', $result->form_id)->exists())
                            <button class="bn orange white-text lighten-2 w3-small waves-green waves-effect">View Result</button>
                        @else
                            <button class="bn white-text lighten-2 w3-small disabled" style="background-color: rgb(187, 175, 175); cursor:not-allowed">Result not generated</button>
                        @endif
                    </td>
                    <td>
                        @if(App\Classresult::where('year_id', $result->year_id)->where('term_id',$result->term_id)->where('form_id', $result->form_id)->exists())
                            <button class="bn blue waves-green white-text lighten-2 w3-small waves-effect">Publish Result</button>
                            @else
                            <button class="bn blue waves-green white-text lighten-3 w3-small" style="cursor: not-allowed">No Result</button>
                        @endif
                        </td>
                @endforeach
            </table>
            @endif
        </div>
        {{-- dissplay classes that have been published already --}}
    </div>
</div>

@endsection
