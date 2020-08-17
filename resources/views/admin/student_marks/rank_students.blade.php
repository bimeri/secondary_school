@extends('admin.layout')
@section('title') rank student @endsection
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
        <form method="get" action="{{ route('record.student.get') }}">
            @csrf
            <div class="row">
                <div class="input-field col m5 s12">
                    <select name="class" id="class">
                        <option value="" selected>form / background / sector</option>
                      @foreach (App\Form::all() as $form)
                        <option value="{{ $form->id }}">{{ $form->name }}  / {{ $form->background->name }} / {{ $form->background->sector->name }}</option>
                      @endforeach
                    </select>
                    <label for="class">Select the class</label>
                </div>
                <div class="col m2 offset-s3 m3 input-field">
                    <button class="btn btn-primary waves-effect waves-light" onclick="load()">Generate Semester Result</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col s11 m10 w3-border-t offset-m1 radius white w3-margin-left">
        <div class="alert alert-warning center w3-margin-top">there is no class result generated already</div>
    </div>
</div>

@endsection
