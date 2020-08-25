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
                <h5 class="w3-padding w3-center"> Sequence Session is Currently going On</h5>
            </div>
        </div>
    @endif
    @if ($setting->exam_session == 1)
        <div class="row">
            <div class="col s12 m6 offset-m3 waves-effect waves-light green white-text">
                <h5 class="w3-padding w3-center"> Exam Session is Currently going On</h5>
            </div>
        </div>
    @endif

    <button class="btn teal waves-effect waves-light w3-tiny modal-trigger right addbtn-theme" href="#modal2" type="button">More Setting <i class="fa fa-cogs w3-tiny"></i> </button>
    <div class="col s11 m10 w3-border-t offset-m1 w3-padding white w3-margin-bottom radius w3-margin-left" style="margin-top: 10px">
        <h4 class="w3-center teal-text">If you wish to change the current school theme, fill the form and submit</h4>
        <form action="{{ route('setting.current.information') }}" method="post">
            @csrf
            <div class="row">
                <div class="input-field col s12 m3">
                    <select name="tearmId" id="tearm">
                      <option value="" disabled selected>Academic Term</option>
                      @foreach (App\Term::all() as $term)
                        <option value="{{ $term->id }}">{{ $term->name }}</option>
                      @endforeach
                    </select>
                    <label for="tearm">Select the acedemic Term</label>
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
                <button class="btn teal waves-effect waves-light w3-small lighten-2" type="submit" onclick="load()">save theme</button>
            </div>
        </form>
    </div>
</div>

{{-- modal to add sequences --}}
<div id="modal1" class="modal modal-fixed-footer">
    <div class="modal-content">
      <h4 class="w3-center teal-text">Add More Sequences. Sequences belong to term</h4>
      <hr style="border-top: 1px solid orange">
        <div class="row">
            <form action="{{ route('sequence.create') }}" method="post">
                @csrf
                <div class="row">
                    <input type="text" class="col s6 m4 right" value="{{ $current_term->name }}" readonly>
                    <input type="hidden" class="col s6 m4 right" value="{{ $current_term->id }}" name="termId">
                </div>
                <div class="col s6 m6 offset-m3 input-field">
                    <input type="text" name="sequence" class="validate" placeholder="Enter the sequnces name" id="sequence">
                    <label for="sequence" class="black-text">Sequences Name</label>
                </div>
                <div class="col s6 m3 offset-m4 offset-s3 w3-center" style="margin-top: 4px !important">
                    <button class="btn teal waves-effect waves-light w3-small" type="submit">Saved</button>
                </div>
            </form>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="modal-close red waves-effect waves-green btn-flat right white-text">Cancel</button>
    </div>
</div>

{{-- modal to add sequences --}}
<div id="modall2" class="modal modal-fixed-footer">
    <div class="modal-content">
      <h4 class="w3-center teal-text">Add More Ademic Year.</h4>
      <hr style="border-top: 1px solid orange">
        <div class="row">
            <form action="{{ route('setting.year.create') }}" method="post">
                @csrf
                <div class="row">
                    <input type="text" class="col s6 m4 right" value="{{ $current_year->name }}" readonly><br><br><hr>
                   <div class="col input-field s12 m6 offset-m2">
                       <select class="browser-default" name="year" id="a_year">
                           <option value="" disabled>select year</option>
                           <option value="2015/2016">2015/2016</option>
                           <option value="2016/2017">2016/2017</option>
                           <option value="2017/2018">2017/2018</option>
                           <option value="2018/2019">2018/2019</option>
                           <option value="2019/2020">2019/2020</option>
                           <option value="2020/2021">2020/2021</option>
                           <option value="2021/2022">2021/2022</option>
                           <option value="2022/2023">2022/2023</option>
                           <option value="2023/2024">2023/2024</option>
                           <option value="2024/2025">2024/2025</option>
                           <option value="2025/2026">2025/2026</option>
                           <option value="2026/2027">2026/2027</option>
                           <option value="2027/2028">2027/2028</option>
                           <option value="2028/2029">2028/2029</option>
                           <option value="2029/2030">2029/2030</option>
                           <option value="2030/2031">2030/2031</option>
                           <option value="2031/2032">2031/2032</option>
                       </select>
                   </div>
                </div>
                <div class="col s6 m3 offset-m4 offset-s3 w3-center" style="margin-top: 4px !important">
                    <button class="btn teal waves-effect waves-light w3-small" type="submit">Saved</button>
                </div>
            </form>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="modal-close red waves-effect waves-green btn-flat right white-text">Cancel</button>
    </div>
</div>


{{-- modal for more setting --}}
<div id="modal2" class="modal modal-fixed-footer" style="width: 90% !important">
    <div class="modal-content">
      <h4 class="w3-center teal-text">Additional configuration for school year</h4>
      <hr style="border-top: 1px solid teal">
        <div class="row">
            <div class="row">
                <h6 class="w3-center bold"><u>Start/Stop Session</u></h6>
                <div class="col s6 offset-m2 m4">
                    {{-- test session --}}
                    @if ($setting->test_session == 0)
                    <form action="{{ route('on.test.session') }}" method="post">
                        @csrf
                        <button type="submit" class="teal waves-light waves-effect" style="border-radius: 12px">Start Sequence Session</button>
                    </form>
                    @endif

                    @if ($setting->test_session == 1)
                    <form action="{{ route('off.test.session') }}" method="post">
                        @csrf
                        <button type="submit" class="waves-light waves-effect" style="border-radius: 12px; background-color:#ccc">Stop Sequence Session</button>
                    </form>
                    @endif
                </div>

                {{-- exam session --}}
                <div class="col s6 m4 offset-m2">
                    @if ($setting->exam_session == 0)
                    <form action="{{ route('on.exam.session') }}" method="post">
                        @csrf
                        <button class="orange white-text waves-light waves-effect" style="border-radius: 12px">Start Exam Session</button>
                    </form>
                    @endif
                    @if ($setting->exam_session == 1)
                    <form action="{{ route('off.exam.session') }}" method="post">
                        @csrf
                        <button class="white-text waves-light waves-effect" style="border-radius: 12px; background-color:#ccc">Stop Exam Session</button>
                    </form>
                    @endif
                </div>
            </div><hr>

            <form action="{{ route('setting.school.time') }}" method="POST">
                <div class="row">
                        @csrf
                        <h6 class="w3-center bold"><u>Configure Time</u></h6>
                        <div class="input-field col s12 m3">
                            <input type="text" name="start_time" value="{{ $setting->start_time }}" class="timepicker" id="date">
                            <label for="date">School Start Time</label>
                        </div>
                        <div class="input-field col s12 m3">
                            <input type="text" name="stop_time" value="{{ $setting->stop_time }}" class="timepicker" id="date2">
                            <label for="date2">School Stop Time</label>
                        </div>
                        <div class="input-field col s12 m3">
                            <input type="text" name="break_time" value="{{ $setting->break_time }}" class="timepicker" id="date3">
                            <label for="date3">School Break Time</label>
                        </div>
                        <div class="input-field col s12 m3">
                            <input type="text" name="lecture_time" value="{{ $setting->hours_per_period }}" class="validate" id="period">
                            <label for="period">Teacher time/period</label>
                        </div>
                </div>
                <div class="w3-center" style="margin-top: 4px !important">
                    <button class="btn teal waves-effect waves-light w3-small" type="submit" style="width: 40%">Save Configured Time</button>
                </div>
            </form>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="modal-close red waves-effect waves-green btn-flat right white-text">Cancel</button>
    </div>
</div>

<div class="col w3-center" style="margin-top: 4px;">
    <button class="btn teal waves-effect waves-light w3-small modal-trigger" href="#modal3" style=" width:40%">See all settings <i class="fa fa-eye right"></i></button>
</div>

{{--  modal to see all settings --}}
<div id="modal3" class="modal modal-fixed-footer">
    <div class="modal-content">
      <h4 class="w3-center teal-text">All school themes</h4>
      <hr style="border-top: 1px solid teal">
        <div class="row">
            <h5 class="w3-center bold">Examination/Test Session</h5>
            <div class="row">
                @if ($setting->exam_session == 0)
                <div class="col s12 m12 waves-effect waves-light orange white-text n-h">
                    <span onclick="this.parentElement.style.display='none'" class="w3-close right white-text w3-hover w3-large w3-padding">&times;</span>
                    <h5 class="w3-center w3-medium">Examination not Going On</h5>
                </div>

                @endif
                @if ($setting->exam_session == 1)
                    <div class="col s12 m12 waves-effect waves-light green white-text">
                        <span onclick="this.parentElement.style.display='none'" class="w3-close right white-text w3-hover w3-large w3-padding">&times;</span>
                        <h5 class="w3-center w3-medium">Examination Currently Going On</h5>
                    </div>
                @endif
            </div>
            <div class="row">
                @if ($setting->test_session == 0)
                <div class="col s12 m12 waves-effect waves-light orange white-text">
                    <span onclick="this.parentElement.style.display='none'" class="w3-close right white-text w3-hover w3-large w3-padding">&times;</span>
                    <h5 class="w3-medium w3-center">
                        @php $sequence = App\Sequence::where('active', 1)->first(); echo $sequence->name @endphp
                         not Going On
                    </h5>
                </div>
                @endif
                @if ($setting->test_session == 1)
                    <div class="col s12 m12 waves-effect waves-light green white-text">
                        <span onclick="this.parentElement.style.display='none'" class="w3-close right white-text w3-hover w3-large w3-padding">&times;</span>
                        <h5 class="w3-medium w3-center">
                            @php $sequence = App\Sequence::where('active', 1)->first(); echo $sequence->name @endphp
                            currently Going On
                        </h5>
                    </div>
                @endif
            </div><hr>

            <h5 class="bold w3-center">Current School Status</h5>
            <div class="row">
                <div class="col s12 m4 waves-effect waves-light">
                    <button class="btn blue waves-input-wrapper">year {{ $current_year->name }} <i class="fa fa-circle w3-medium" style="color: green"></i></button>
                </div>
                <div class="col s12 m4 waves-effect waves-light">
                    <button class="btn green waves-input-wrapper">{{ $current_term->name }} <i class="fa fa-circle w3-medium" style="color: green"></i></button>
                </div>
                <div class="col s12 m4 waves-effect waves-light">
                    <button class="btn purple white-text waves-input-wrapper" style="text-transform: capitalize">@php $seq = App\Sequence::where('active', 1)->first(); echo $seq->name; @endphp  @if ($setting->test_session == 1)<i class="fa fa-circle w3-medium" style="color: green"></i> @else <i class="fa fa-circle w3-medium" style="color: red"></i> @endif</button>
                </div>
            </div><hr>

            <h5 class="bold w3-center">School Time</h5>
            <div class="row">
                <div class="col s12 m3 waves-effect waves-light">
                    <label for="stime">Start time</label><br>
                    <button class="btn green waves-input-wrapper" id="stime">{{ $setting->start_time }}</button>
                </div>
                <div class="col s12 m3 waves-effect waves-light">
                    <label for="break">break time</label><br>
                    <button class="btn orange white-text waves-input-wrapper" id="break">{{ $setting->break_time}}</button>
                </div>
                <div class="col s12 m3 waves-effect waves-light">
                    <label for="stop_time">Stop time</label><br>
                    <button class="btn red white-text waves-input-wrapper" id="stop_time">{{ $setting->stop_time }}</button>
                </div>
                <div class="col s12 m3 waves-effect waves-light">
                    <label for="stop_time">Lecture Hour</label><br>
                    <button class="btn purple white-text waves-input-wrapper lower" id="stop_time">{{ $setting->hours_per_period }}</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="modal-close teal waves-effect waves-green btn-flat right white-text">Close</button>
    </div>
</div>
<br>
@endsection
