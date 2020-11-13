@extends('admin.layout')
@section('title') More Setting @endsection
@section('style')
<style>
    .text{
        text-justify: inter-word;
        text-align: justify;
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
    tr>th.th{
        color: #009688 !important;
    }
    h4{
        font-style: italic;
    }
</style>
@endsection
@section('content')
<p class="w3-center">@lang('messages.welcome')</p>
<div class="row">
    <div class="col s11 m10 w3-border-t offset-m1 radius white w3-margin-left">
        {{--  start  --}}
              <h4 class="w3-center teal-text">Additional configuration for school year</h4>
              <hr style="border-top: 1px solid teal">
                <div class="row">
                    {{--  session setting  --}}
                    <div class="row">
                        <h4 class="center">Examination Sessions</h4>
                        <div class="col s6 offset-m2 m4">
                            {{-- test session --}}
                            @if ($setting->test_session == 0)
                            <form action="{{ route('on.test.session') }}" method="post">
                                <h6 class="teal-text">{{ $current_sequence->name }} is close</h6>
                                @csrf
                                <button type="submit" class="btn teal teal-text lighten-4 waves-light waves-effect" onclick="load()">Start Sequence Session</button>
                            </form>
                            @endif

                            @if ($setting->test_session == 1)
                            <form action="{{ route('off.test.session') }}" method="post">
                                <h6 class="red-text"><b>{{ $current_sequence->name }}</b> is curently going on</h6>
                                @csrf
                                <button type="submit" class="btn red red-text lighten-4 waves-light waves-effect" onclick="load()">Stop Sequence Session</button>
                            </form>
                            @endif
                        </div>

                        {{-- exam session --}}
                        <div class="col s6 m4 offset-m2">
                            @if ($setting->exam_session == 0)
                            <form action="{{ route('on.exam.session') }}" method="post">
                                @csrf
                                <h6 class="teal-text"><b>{{ $current_term->name }}</b> Exam session closed, Click to start</h6>
                                <button class="btn teal teal-text lighten-4 waves-light waves-effect" onclick="load()">Start Exam Session</button>
                            </form>
                            @endif
                            @if ($setting->exam_session == 1)
                            <form action="{{ route('off.exam.session') }}" method="post">
                                <h6 class="red-text">Exam session for <b>{{ $current_term->name }}</b> is curently going on</h6>
                                @csrf
                                <button class="btn red red-text lighten-4 waves-light waves-effect" onclick="load()">Stop Exam Session</button>
                            </form>
                            @endif
                        </div>
                    </div><hr>
                    {{--  time setting  --}}
                    <div class="row">
                        <h4 class="center">Time configuration</h4>
                        <form action="{{ route('setting.school.time') }}" method="POST">
                            <div class="col m10 offset-m1">
                                    @csrf
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
                    <hr>
                    {{--  permission for teacher to add marks  --}}
                    <div class="row">
                        <h4 class="center">Recording of marks</h4>
                        <div class="col s12 m10  w3-border offset-m1">
                            <p class="center text w3-padding blue-text blue lighten-5">Teachers can record students marks. If you want to stop inputing of marks by teacher,click to stop.
                                this is also to prevent student report card issues since inputting of marks after report card has been generated will leads to students wrong report card information.
                                Teachers has dead line to input marks and if dead line is stop, the only Administrator can edoi students marks.
                            </p>
                            <div class="row">
                                @if ($recordingMarks)
                                <div class="col s12 m4 offset-m1">
                                    <h5 class="red-text">Stop teachers from recording marks</h5>
                                </div>
                                <div class="col md s12 m4">
                                    <form action="{{ route('teacher.record.marks') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w3-btn w3-red waves-light waves-effect">click to Stop recording of marks</button>
                                    </form>
                                </div>
                                @else
                                <div class="col s12 m6">
                                    <h5 class="green-text">Teacher's can't record mark again. You can give them access again</h5>
                                </div>
                                <div class="col md s12 m4">
                                    <form action="{{ route('teacher.record.marks') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w3-btn w3-green waves-light waves-effect">give teachers access to recording of marks</button>
                                    </form>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr>

                    {{--  result setting  --}}
                    <div class="row">
                        <div class="col s12 m10 offset-m1">
                            <h4 class="center">Publishing result</h4>
                            <div class="row">
                                <form action="" method="post" id="form">
                                    @csrf
                                    <div class="input-field col s12 m3 offset-m1">
                                        <select name="year" id="year" class="browser-default" onchange="hideTable()">
                                            @foreach ($year as $yr)
                                                <option value="{{ $yr->id }}">{{ $yr->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="input-field col s12 m3">
                                        <select name="term" id="term" class="browser-default" onchange="hideTable()">
                                            @foreach ($term as $tm)
                                                <option value="{{ $tm->id }}">{{ $tm->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="input-field col s12 m2">
                                        <button type="button" class="btn teal" onclick="getDetail()">get detail</button>
                                    </div>
                                </form>
                            </div>
                            <div id="rest"></div>
                                <div style="overflow:auto !important" id="hide">
                                </div><br>

                            <div style="overflow-x:auto !important">
                                <table class="w3-table w3-striped w3-border-t" style="font-size: 13px !important;">
                                    <tr class="teal lighten-4">
                                        <th class="th w3-large" rowspan="2">S/N</th>
                                        <th class="th w3-large" rowspan="2">Year</th>
                                        <th class="th w3-large" rowspan="2">Term</th>
                                        <th class="th" colspan="3">Action</th>
                                        <tr>
                                            <td class="w3-medium">Test 1</td>
                                            <td class="w3-medium">Test 2</td>
                                            <td class="w3-medium">Exam</td>
                                        </tr>
                                    </tr>
                                    @foreach ($resultscontrol as $key => $control)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $control->year->name }}</td>
                                        <td>{{ $control->term->name }}</td>
                                        <td>{{ $control->seq1->name }}/@if ($control->seq1_id) <b class="green-text">Published</b>  @else <b class="red-text">Not published</b> @endif</td>
                                        <td>{{ $control->seq2 ? $control->seq2->name.' /'.'' :'' }} @if ($control->seq2_id) <b class="green-text">Published</b>  @else <b class="red-text">Not published</b> @endif</td>
                                        <td>@if ($control->generateresult_id) <b class="green-text">Published</b>  @else <b class="red-text">Not published</b> @endif</td>
                                    </tr>
                                    @endforeach
                               </table>
                            </div>
                        </div>
                    </div>
                </div>
            <a href="{{ route('view.admin.theme') }}" class="btn white-text black waves-effect waves-light" style="position: fixed; bottom:60px; left: 10px" onclick="load()"><i class="fa fa-arrow-alt-circle-left"></i> Go back</a>
        {{--  end  --}}
    </div>
</div>
<script>
    $('#hide').hide();

    function hideTable(){
        $('#hide').empty();
        $('#rest').empty();
    }

     function getDetail(){
        $("#hide").empty();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    var data = $('#form').serialize();
    if(data){
        $.ajax({
           type:"POST",
           url:"{{route('get.result.table')}}",
           data: data,
           success:function(res){
            if(res){
                $("#hide").show(500);
                    $('#hide').append(res);
            }else{
               $("#hide").append("<h5 class='red w3-padding red-text lighten-4'>There is no record for the information entered</h5>");
            }
           },
           error: function(error){
            $("#hide").hide(1000);
               console.log('some error occured');
           }
        });
    }else{
        $("#type").fadeOut(1000);
        $("#type").empty();
    }

   }

//    backend function
function publishfirstResult(){
    $('#menu').show();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    var inputs = $('#publish_first').serialize();
    if(inputs){
        $.ajax({
           type:"POST",
           url:"{{route('publish.first.result')}}",
           data: inputs,
           success:function(res){
            $('#rest').empty();
            if(res){
                $('#rest').append("<div class='w3-green w3-padding center'>"+res+" Result has been published successfully</div>");
                document.getElementById('button1').innerHTML = "<button type='button' class='w3-btn w3-green'>published <i class='fa fa-check white-text'></i></button>";
            }
            $('#menu').hide();
           },
           error: function(error){
            $("#hide").hide();
               console.log('some error occured');
               $('#menu').hide();
           }
        });
    }
   }
   function publishsecondResult(){
    $('#menu').show();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    var inputs = $('#publish_second').serialize();
    if(inputs){
        $.ajax({
           type:"POST",
           url:"{{route('publish.second.result')}}",
           data: inputs,
           success:function(res){
                $('#rest').empty();
            if(res){
                $('#rest').append("<div class='w3-green w3-padding center'>"+res+" Result has been published successfully</div>");
                document.getElementById('button2').innerHTML = "<button type='button' class='w3-btn w3-green w3-text-white'>published <i class='fa fa-check white-text'></i></button>";
            }
            $('#menu').hide();
           },
           error: function(error){
            $("#hide").hide();
               console.log('some error occured');
               $('#menu').hide();
           }
        });
    }
   }
</script>
@endsection
