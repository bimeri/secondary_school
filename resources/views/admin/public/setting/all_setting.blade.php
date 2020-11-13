@extends('admin.layout')
@section('title') More Setting @endsection
@section('content')
<p class="w3-center">@lang('messages.welcome')</p>
<div class="row">
    <div class="col s11 m10 w3-border-t offset-m1 radius white w3-margin-left">
        <h4 class="w3-center teal-text">All school themes</h4><hr style="border-top: 1px solid teal">
        <div class="row">
            <h5 class="w3-center bold">Examination/Test Session</h5>
            <div class="row">
                @if ($setting->exam_session == 0)
                <div class="col s12 m8 offset-m2 waves-effect waves-orange orange orange-text lighten-4">
                    <span onclick="this.parentElement.style.display='none'" class="w3-close right orange-text w3-hover w3-large w3-padding">&times;</span>
                    <h5 class="w3-center w3-medium">Examination not Going On</h5>
                </div>
                @endif
                @if ($setting->exam_session == 1)
                    <div class="col s12 m8 offset-m2 waves-effect waves-green green green-text lighten-4">
                        <span onclick="this.parentElement.style.display='none'" class="w3-close right green-text w3-hover w3-large w3-padding">&times;</span>
                        <h5 class="w3-center w3-medium">Examination Currently Going On</h5>
                    </div>
                @endif
            </div>
            <div class="row">
                @if ($setting->test_session == 0)
                <div class="col s12 m8 offset-m2 waves-effect waves-orange orange orange-text lighten-4">
                    <span onclick="this.parentElement.style.display='none'" class="w3-close right orange-text w3-hover w3-large w3-padding">&times;</span>
                    <h5 class="w3-medium w3-center">
                        @php $sequence = App\Sequence::where('active', 1)->first(); echo $sequence->name @endphp
                            not Going On
                    </h5>
                </div>
                @endif
                @if ($setting->test_session == 1)
                    <div class="col s12 m8 offset-m2 waves-effect waves-green green green-text lighten-4">
                        <span onclick="this.parentElement.style.display='none'" class="w3-close right green-text w3-hover w3-large w3-padding">&times;</span>
                        <h5 class="w3-medium w3-center">
                            @php $sequence = App\Sequence::where('active', 1)->first(); echo $sequence->name @endphp
                            currently Going On
                        </h5>
                    </div>
                @endif
            </div><hr>

            <h5 class="bold w3-center">Current School Status</h5>
            <div class="row">
                <div class="col offset-m2 s12 m3 waves-effect waves-light">
                    <button class="w3-btn w3-blue waves-input-wrapper">year {{ $current_year->name }} <i class="fa fa-circle w3-medium" style="color: green"></i></button>
                </div>
                <div class="col s12 m3 waves-effect waves-light">
                    <button class="w3-btn w3-green waves-input-wrapper">{{ $current_term->name }} <i class="fa fa-circle w3-medium" style="color: green"></i></button>
                </div>
                <div class="col s12 m3 waves-effect waves-light">
                    <button class="w3-btn w3-purple white-text waves-input-wrapper" style="text-transform: capitalize">@php $seq = App\Sequence::where('active', 1)->first(); echo $seq->name; @endphp  @if ($setting->test_session == 1)<i class="fa fa-circle w3-medium" style="color: green"></i> @else <i class="fa fa-circle w3-medium" style="color: red"></i> @endif</button>
                </div>
            </div><hr>

            <h5 class="bold w3-center">School Time</h5>
            <div class="row">
                <div class="col s12 m2 offset-m2 waves-effect waves-light">
                    <label for="stime">Start time</label><br>
                    <button class="btn green waves-input-wrapper" id="stime">{{ $setting->start_time }}</button>
                </div>
                <div class="col s12 m2 waves-effect waves-light">
                    <label for="break">break time</label><br>
                    <button class="btn orange white-text waves-input-wrapper" id="break">{{ $setting->break_time}}</button>
                </div>
                <div class="col s12 m2 waves-effect waves-light">
                    <label for="stop_time">Stop time</label><br>
                    <button class="btn red white-text waves-input-wrapper" id="stop_time">{{ $setting->stop_time }}</button>
                </div>
                <div class="col s12 m2 waves-effect waves-light">
                    <label for="stop_time">Lecture Hour</label><br>
                    <button class="btn purple white-text waves-input-wrapper lower" id="stop_time">{{ $setting->hours_per_period }}</button>
                </div>
            </div>
        </div>
    </div>
    <a href="{{ route('view.admin.theme') }}" class="btn white-text black waves-effect waves-light" style="position: fixed; bottom:60px; left: 10px"><i class="fa fa-arrow-alt-circle-left"></i> Go back</a>
</div>
@endsection
