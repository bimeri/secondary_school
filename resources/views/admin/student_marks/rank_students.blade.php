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
    <div class="col s12 m8 offset-m4">
        <form method="get" action="{{ route('rank.result') }}">
            @csrf
            <div class="row">
                <div class="input-field col m5 s12">
                    <select name="class" id="class">
                        <option value="" selected>form / background / sector</option>
                      @foreach (App\Form::all() as $form)
                        <option value="{{\Crypt::encrypt($form->id) }}">{{ $form->name }}  / {{ $form->background->name }} / {{ $form->background->sector->name }}</option>
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
        @if($ranked->count() > 0)
            @if(Session::has('message'))
            <div class="w3-center alert alert-danger w3-margin-top" role="alert">
                {{ Session::get('message') }}
            </div>
            @endif

            {{-- get all students from class and theri results --}}
            {{-- dissplay classes that have been published already --}}

        @else
        @if(Session::has('message'))
            <div class="w3-center alert alert-danger w3-margin-top" role="alert">
                {{ Session::get('message') }}
            </div>
        @endif
            <div class="alert alert-info center w3-margin-top" role="alert">there is no class result generated already</div>
        @endif
    </div>
</div>

@endsection
