@extends('admin.layout')
@section('title') rank student @endsection
@section('style')
<style>
    table{
        border: 1px solid bloack !important;
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
</style>
@endsection
@section('content')
<div class="row">
    <h5 class="right w3-padding w3-center" style="position: absolute; float: right !important"><b>{{ $current_year->name }}</b> Academic year<br>{{ $current_term->name }}</h5>
    <div class="col s12 m6 offset-m3 teal teal-text lighten-5 waves-effect waves-orange w3-center">
        @lang('messages.rank_student')
    </div>
</div>
{{-- <ul class="tooltip-wrapper">
    <li><a href="#" class="tooltip tooltip-top" data-tooltip="Hey, I'm at the top!">Tooltip top</a></li>
    <li><a href="#" class="tooltip tooltip-bottom" data-tooltip="And I'm at the bottom">Tooltip bottom</a></li>
    <li><a href="#" class="tooltip tooltip-left" data-tooltip="I'm left all alone">Tooltip left</a></li>
    <li><a href="#" class="tooltip tooltip-right" data-tooltip="You're wrong and I'm right">Tooltip right</a></li>
</ul> --}}
<div class="row">
    <div class="col s12 m8 offset-m4">
        <form method="get" action="{{ route('rank.result') }}">
            @csrf
            <div class="row">
                <div class="input-field col m5 s12">
                    <select name="class" id="class">
                        <option value="{{ $form->id }}" selected>{{ $form->name }}  / {{ $form->background->name }} / {{ $form->background->sector->name }}</option>
                      @foreach (App\Form::where('id', '!=', $form->id)->get() as $fm)
                        <option value="{{\Crypt::encrypt($fm->id) }}">{{ $fm->name }}  / {{ $fm->background->name }} / {{ $fm->background->sector->name }}</option>
                      @endforeach
                    </select>
                    <label for="class">Select the class</label>
                </div>
                <div class="col m2 offset-s3 m3 input-field">
                    <button class="w3-btn w3-teal waves-effect waves-light" onclick="load()">Generate {{ $current_term->name }} Result</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col s11 m10 w3-border-t offset-m1 radius white w3-margin-left">
        <div class="row">
            <div class="col s12 m4">
                <table id="myTable" class="w3-table" style="font-size: 13px !important; margin:5px">
                    <tr class="teal">
                        <th>subjects</th>
                        <th>coefficient</th>
                        <th>average points</th>
                        <th>Number of Students</th>
                    </tr>
                    @foreach ($subjects as $key => $subject)
                        <tr>
                            <td>{{ $subjects[$key]['subject_name'] }}</td>
                            <td>{{ $subjects[$key]['subject_coff'] }}</td>
                            <td>{{ $subjects[$key]['point'] }}</td>
                            <td>{{ $subjects[$key]['number_student'] }}</td>
                        </tr>
                    @endforeach
                    <tr class="teal-text center" style="background-color: rgb(169, 238, 238)">
                        <td>Total</td>
                        <td class="bold">{{ $sum_coff }}</td>
                        <td class="bold">{{ $total_point }}</td>
                        <td class="bold"></td>
                    </tr>
                </table>
            </div>
            <div class="col hide-on-med-and-down" style="margin-top: 150px; margin-left:10px; position: relative;"><i class="fa fa-arrow-alt-circle-right w3-xlarge w3-center teal-text"></i></div>
            <div class="col s12 m7">
                <table id="myTable" class="w3-table" style="font-size: 13px !important; margin:5px">
                    <tr class="teal">
                        <th>subjects</th>
                        <th>coefficient</th>
                        <th>average points</th>
                        <th>Number of Students</th>
                    </tr>
                    @foreach ($subjects as $key => $subject)
                        <tr>
                            <td>{{ $subjects[$key]['subject_name'] }}</td>
                            <td>{{ $subjects[$key]['subject_coff'] }}</td>
                            <td>{{ $subjects[$key]['point'] }}</td>
                            <td>{{ $subjects[$key]['number_student'] }}</td>
                        </tr>
                    @endforeach
                    <tr class="teal-text center" style="background-color: rgb(169, 238, 238)">
                        <td>Total</td>
                        <td class="bold">{{ $sum_coff }}</td>
                        <td class="bold">{{ $total_point }}</td>
                        <td class="bold"></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
