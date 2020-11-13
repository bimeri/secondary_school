@extends('admin.layout')
@section('title') {{ __('school theme') }} @endsection
@section('content')
<div class="row">
    <div class="row">
        <div class="col s4 m4">
            <h5 class="teal-text w3-padding left"><b class="black-text">Academic Year:</b> {{ $current_year->name }}</h5>
        </div>
        <div class="col s4 m3 offset-m1">
            <img src="{{ URL::asset('image/logo/'.$setting->logo.' ') }}"  class="image center" alt="logo" style="margin-top:-10px; height:100px; width:100px">
        </div>
        <div class="col s4 m4">
            <h5 class="teal-text w3-padding right"><b class="black-text">Current Sequence:</b> {{ $current_sequence->name }}</h5>
        </div>
    </div>

    @if ($setting->test_session == 1)
        <div class="row">
            <div class="col s12 m6 offset-m3 waves-effect waves-light green white-text">
                <h5 class="w3-center"> Sequence session is currently going on</h5>
            </div>
        </div>
    @endif
    @if ($setting->exam_session == 1)
        <div class="row">
            <div class="col s12 m6 offset-m3 waves-effect waves-light green white-text">
                <h5 class="w3-center"> Exam session is currently going on</h5>
            </div>
        </div>
    @endif

    <a class="btn teal waves-effect waves-light w3-tiny right addbtn-theme" href="{{ route('admin.more_setting') }}">More Setting <i class="fa fa-cogs w3-tiny"></i> </a>
    <div class="col s11 m10 w3-border-t offset-m1 w3-padding white w3-margin-bottom radius w3-margin-left" style="margin-top: 10px">
        <h4 class="w3-center teal-text">If you wish to change the current school theme, fill the form and submit</h4>
        <form action="{{ route('setting.current.information') }}" method="post">
            @csrf
            <div class="row">
                <div class="input-field col s12 m3">
                    <select name="tearmId" id="term">
                      <option value="" disabled selected>Academic Term</option>
                      @foreach (App\Term::all() as $term)
                        <option value="{{ $term->id }}">{{ $term->name }}</option>
                      @endforeach
                    </select>
                    <label for="term">Select the acedemic Term</label>
                </div>

                <div class="input-field col s12 m3">
                    <select name="sequence" id="sq">
                      <option value="" disabled selected>Current Sequence</option>
                      @foreach (App\Sequence::all() as $sequence)
                        <option value="{{ $sequence->id }}">{{ $sequence->name }}</option>
                      @endforeach
                    </select>
                    <label for="sq">Select the Current Sequence</label>
                </div>

                <div class="input-field col s12 m3">
                    <select name="yearId">
                      <option class="w3-small" value="" disabled selected> Academic year</option>
                      @foreach (App\Year::all() as $year)
                        <option value="{{ $year->id }}">{{ $year->name }}</option>
                      @endforeach
                    </select>
                    <label>Select the academic year</label>
                </div>
                <div class="right w3-padding">
                    <button type="button" href="#modal1" class="green btn white-text waves-effect waves-light modal-trigger"  style="border-radius: 10px; width: 100%; margin: 5px">Add Sequences <i class="fa fa-plus-square w3-small"></i></button><br>
                    <button type="button" href="#modall2" class="blue btn white-text waves-effect waves-light modal-trigger"  style="border-radius: 10px; width: 100%; margin: 5px">Add Year <i class="fa fa-plus-square w3-small"></i></button>
                </div>
            </div>
            <div class="col s6 m3 offset-m4 offset-s3 w3-center" style="margin-top: 4px !important">
                <button class="btn teal waves-effect waves-light w3-small lighten-1" type="submit" onclick="load()">save theme</button>
            </div>
        </form>
    </div>
</div>
{{-- modal to add sequences --}}
@include('admin.public.includes.add_sequence')
{{-- modal to add year --}}
@include('admin.public.includes.add_year')

<div class="col w3-center" style="margin-top: 4px;">
    <a class="btn teal waves-effect waves-light w3-small" href="{{ route('admin.all_settintg') }}" style="width:40%" onclick="load()">See all settings <i class="fa fa-eye right"></i></a>
</div>
<br>
@endsection
