@extends('admin.layout')
@section('title') Record Marks @endsection
@section('style')
<style>
    table{
        border: 1px solid bloack !important;
        box-shadow: 0 0 25px rgb(130, 243, 130), inset 0 0 25px rgb(138, 224, 138);
    }
    .refl{

        /* -webkit-box-reflect: right 10px linear-gradient(transparent, #cc00ff, #0002); */
    }
    td, th, tr{
        border: 1px solid black !important;
        font-size: 11px !important
    }
    td:nth-child(2){
        border-left: 2px solid black !important;
    }
    th>div#stud{
        margin-top: 10px !important;
        transform: rotate(-23deg) !important;
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
        margin-top: -8px;
        margin-left: -31px;
    }
    input[type='number'].ss{
        position: absolute;
        outline: none !important;
        border: 1px solid transparent !important;
        border-bottom: 1px solid white !important;
        width: 60px !important;
        height: 30px !important;
        margin-top: -8px;
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
<style>
     @media only screen and (max-width: 600px) {

}
</style>
@section('content')
<div class="row">
    <h5 class="right w3-padding w3-center" style="position: absolute; float: right !important"><b>{{ $current_year->name }}</b> Academic year<br>{{ $current_term->name }}</h5>
    <div class="col s12 m6 offset-m3 teal teal-text rounded lighten-4 waves-effect waves-orange w3-center">
        @lang('messages.record_marks_header')
    </div>
</div>
<div class="row">
    <div class="col s12 m8 offset-m4">
        <form method="get" action="{{ route('record.student.get') }}">
            @csrf
            <div class="row">
                <div class="input-field col m5 s12">
                    <select name="class" id="class">
                        @if($class != [])
                        <option value="{{ \Crypt::encrypt($class->id) }}" selected> {{ $class->name }} / {{ $class->background->name }} / {{ $class->background->sector->name }}</option>
                        @else
                        <option value="" selected>form / background / sector</option>
                        @endif
                      @foreach (App\Form::where('id', '!=', $class->id ?? '')->get() as $form)
                        <option value="{{\Crypt::encrypt($form->id) }}">{{ $form->name }}  / {{ $form->background->name }} / {{ $form->background->sector->name }}</option>
                      @endforeach
                    </select>
                    <label for="class">Select the class</label>
                </div>
                <div class="col m2 offset-s3 m3" style="margin-top: 2px !important">
                    <button class="btn btn-primary waves-effect waves-light" onclick="load()">Get Students</button>
                </div>
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
                @foreach ($students as $key => $student)
                <tr>
                    <td><b class="left">{{ $key + 1 }}. {{ $student->student->full_name }}</b> <em class="right">{{ $student->student_school_id }}</em></td>

                    @foreach ($subjects as $s => $sub)
                    {{-- first term --}}
                        @if($first)
                            <td>
                                {{-- first sequence --}}
                                <form action="" method="get" id="fm{{$student->id }}{{$sub->id }}">
                                    @csrf
                                    <input type="hidden" name="year" value="{{ $current_year->id }}">
                                    <input type="hidden" name="student" value="{{ $student->student->id }}">
                                    <input type="hidden" name="subject" value="{{ $sub->id }}">
                                    <input type="hidden" name="form" value="{{ \Crypt::encrypt($sub->form->id) }}">
                                    <?php $fseq = App\Firsttermresult::where('year_id',$current_year->id)
                                    ->where('student_id', $student->student->id)->where('subject_id', $sub->id)->get();
                                     $arr = array();
                                     foreach ($fseq as $val) { array_push($arr, $val->seq1);} $seq1 = current($arr);
                                      ?>
                                    <input type="number" name="seq1" value="{{ $seq1 }}" id="f{{$student->id }}{{$sub->id }}" class="{{ (int)$seq1 < 10 ? 'ss':'sp' }}" onchange="checkf{{ $student->id }}{{ $sub->id }}(event)"></td>
                                </form>
                            <td>
                                {{-- second sequence --}}
                                <form action="" method="get" id="sm{{$student->id }}{{$sub->id }}">
                                    @csrf
                                    <input type="hidden" name="year" value="{{ $current_year->id }}">
                                    <input type="hidden" name="student" value="{{ $student->student->id }}">
                                    <input type="hidden" name="subject" value="{{ $sub->id }}">
                                    <input type="hidden" name="form" value="{{ \Crypt::encrypt($sub->form->id) }}">
                                    <?php $fseq = App\Firsttermresult::where('year_id',$current_year->id)
                                    ->where('student_id', $student->student->id)->where('subject_id', $sub->id)->get();
                                     $arr2 = array();
                                     foreach ($fseq as $valsa) { array_push($arr2, $valsa->seq2);} $seqsa = current($arr2);
                                      ?>
                                    <input type="number" name="seq2" value="{{ $seqsa }}" id="s{{$student->id }}{{$sub->id }}" class="{{ (int)$seqsa < 10 ? 'ss':'sp' }}" onchange="checks{{$student->id }}{{$sub->id }}(event)">
                                </form>
                            </td>
                        @endif
                        {{-- second term --}}
                        @if($second)
                        <td>
                            {{-- third sequence --}}
                            <form action="" method="get" id="tsm{{$student->id }}{{$sub->id }}">
                                @csrf
                                <input type="hidden" name="year" value="{{ $current_year->id }}">
                                <input type="hidden" name="student" value="{{ $student->student->id }}">
                                <input type="hidden" name="subject" value="{{ $sub->id }}">
                                <input type="hidden" name="form" value="{{ \Crypt::encrypt($sub->form->id) }}">
                                <?php $tseq = App\Secondtermresult::where('year_id',$current_year->id)
                                ->where('student_id', $student->student->id)->where('subject_id', $sub->id)->get();
                                 $arr3 = array();
                                 foreach ($tseq as $ts) { array_push($arr3, $ts->seq3);} $ts1 = current($arr3);
                                  ?>
                                <input type="number" name="seq3" value="{{ $ts1 }}" id="ts{{$student->id }}{{$sub->id }}" class="{{ (int)$ts1 < 10 ? 'ss':'sp' }}" onchange="checkts{{ $student->id }}{{ $sub->id }}(event)"></td>
                            </form>
                        <td>
                             {{-- fourth sequence --}}
                            <form action="" method="get" id="fsm{{$student->id }}{{$sub->id }}">
                                @csrf
                                <input type="hidden" name="year" value="{{ $current_year->id }}">
                                <input type="hidden" name="student" value="{{ $student->student->id }}">
                                <input type="hidden" name="subject" value="{{ $sub->id }}">
                                <input type="hidden" name="form" value="{{ \Crypt::encrypt($sub->form->id) }}">
                                <?php $fseq = App\Secondtermresult::where('year_id',$current_year->id)
                                ->where('student_id', $student->student->id)->where('subject_id', $sub->id)->get();
                                 $fsa = array();
                                 foreach ($tseq as $fs) { array_push($fsa, $fs->seq4);} $fseqsa1 = current($fsa);
                                  ?>
                                <input type="number" name="seq4" value="{{ $fseqsa1 }}" id="fs{{$student->id }}{{$sub->id }}" class="{{ (int)$fseqsa1 < 10 ? 'ss':'sp' }}" onchange="checkfs{{ $student->id }}{{ $sub->id }}(event)"></td>
                            </form>
                        </td>
                        @endif
                        {{-- third term --}}
                        @if($third)
                        <td>
                            {{-- firth sequence --}}
                            <form action="" method="get" id="seq5{{$student->id }}{{$sub->id }}">
                                @csrf
                                <input type="hidden" name="year" value="{{ $current_year->id }}">
                                <input type="hidden" name="student" value="{{ $student->student->id }}">
                                <input type="hidden" name="subject" value="{{ $sub->id }}">
                                <input type="hidden" name="form" value="{{ \Crypt::encrypt($sub->form->id) }}">
                                <?php $seq5 = App\Thirdtermresult::where('year_id',$current_year->id)
                                ->where('student_id', $student->student->id)->where('subject_id', $sub->id)->get();
                                 $fseq5 = array();
                                 foreach ($seq5 as $s5) { array_push($fseq5, $s5->seq5);} $fseq5 = current($fseq5);
                                  ?>
                                <input type="number" name="seq5" value="{{ $fseq5 }}" id="sseq5{{$student->id }}{{$sub->id }}" class="{{ (int)$fseq5 < 10 ? 'ss':'sp' }}" onchange="checksseq5{{ $student->id }}{{ $sub->id }}(event)"></td>
                            </form>
                        <td>
                            {{-- sixth sequence --}}
                            <form action="" method="get" id="ffseq6m{{$student->id }}{{$sub->id }}">
                                @csrf
                                <input type="hidden" name="year" value="{{ $current_year->id }}">
                                <input type="hidden" name="student" value="{{ $student->student->id }}">
                                <input type="hidden" name="subject" value="{{ $sub->id }}">
                                <input type="hidden" name="form" value="{{ \Crypt::encrypt($sub->form->id) }}">
                                <?php $noel6 = App\Thirdtermresult::where('year_id',$current_year->id)
                                ->where('student_id', $student->student->id)->where('subject_id', $sub->id)->get();
                                 $noell = array();
                                 foreach ($noel6 as $s6) { array_push($noell, $s6->seq6);} $var6 = current($noell);
                                  ?>
                                <input type="number" name="seq6" value="{{ $var6 }}" id="fseq6{{$student->id }}{{$sub->id }}" class="{{ (int)$var6 < 10 ? 'ss':'sp' }}" onchange="checkffseq6{{ $student->id }}{{ $sub->id }}(event)"></td>
                            </form>
                        </td>
                        @endif
                        <script>
                            // first sequence
                            function checkf{{ $student->id }}{{ $sub->id }}(ev){
                                var val = parseInt(ev.target.value);
                                if(val < 10){
                                    console.log('the value changed');
                                    document.getElementById('f{{ $student->id }}{{ $sub->id }}').setAttribute('class', 'ss');
                                }
                                else {
                                    document.getElementById('f{{ $student->id }}{{ $sub->id }}').setAttribute('class', 'sp');
                                }
                                $(document).ready(function(){
                                    $.ajaxSetup({
                                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                                    });
                                    /* Submit form data using ajax*/
                                $.ajax({
                                    url: "{{ route('first.sequence.save') }}",
                                    method: 'get',
                                    data: $('#fm{{$student->id }}{{$sub->id }}').serialize(),
                                    success: function(response){
                                        console.log('the result', response);
                                        toastr.options = {
                                        "closeButton": false,
                                        "debug": false,
                                        "newestOnTop": true,
                                        "progressBar": false,
                                        "positionClass": "toast-top-right",
                                        "preventDuplicates": false,
                                        "onclick": null,
                                        "showDuration": "300",
                                        "hideDuration": "1000",
                                        "timeOut": "2000",
                                        "extendedTimeOut": "1000",
                                        "showEasing": "swing",
                                        "hideEasing": "linear",
                                        "showMethod": "fadeIn",
                                        "hideMethod": "fadeOut"
                                        }
                                        if(response.type == 'error'){ toastr.error(response.message);}
                                        if(response.type == 'warning'){ toastr.warning(response.message);}
                                        if(response.type == 'update'){ toastr.info(response.message);}
                                        if(response.type == 'success'){ toastr.success(response.message);}
                                        //setTimeout(function(){window.location.reload();},7000);
                                    },
                                    error: function(error){
                                        console.log('the error', response);
                                        toastr.info(error);
                                    }
                                });
                            });
                            }

                            // second sequence
                            function checks{{$student->id }}{{$sub->id }}(ev){
                                console.log('the value', parseInt(ev.target.value));
                                var val = parseInt(ev.target.value);
                                if(val < 10){
                                    document.getElementById('s{{$student->id }}{{$sub->id }}').setAttribute('class', 'ss');
                                } else {
                                    document.getElementById('s{{$student->id }}{{$sub->id }}').setAttribute('class', 'sp');
                                }
                                $(document).ready(function(){
                                    $.ajaxSetup({
                                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                                    });
                                    /* Submit form data using ajax*/
                                $.ajax({
                                    url: "{{ route('second.sequence.save') }}",
                                    method: 'get',
                                    data: $('#sm{{$student->id }}{{$sub->id }}').serialize(),
                                    success: function(response){
                                        toastr.options = {
                                        "closeButton": false,
                                        "debug": false,
                                        "newestOnTop": true,
                                        "progressBar": false,
                                        "positionClass": "toast-top-right",
                                        "preventDuplicates": false,
                                        "onclick": null,
                                        "showDuration": "300",
                                        "hideDuration": "1000",
                                        "timeOut": "2000",
                                        "extendedTimeOut": "1000",
                                        "showEasing": "swing",
                                        "hideEasing": "linear",
                                        "showMethod": "fadeIn",
                                        "hideMethod": "fadeOut"
                                        }
                                        if(response.type == 'error'){ toastr.error(response.message);}
                                        if(response.type == 'warning'){ toastr.warning(response.message);}
                                        if(response.type == 'update'){ toastr.info(response.message);}
                                        if(response.type == 'success'){ toastr.success(response.message);}
                                        //setTimeout(function(){window.location.reload();},7000);
                                    },
                                    error: function(error){
                                        console.log('the error', response);
                                        toastr.info(error);
                                    }
                                });
                            });
                            }

                            // third sequence
                            function checkts{{$student->id }}{{$sub->id }}(ev){
                                console.log('the value', parseInt(ev.target.value));
                                var val = parseInt(ev.target.value);
                                if(val < 10){
                                    document.getElementById('ts{{$student->id }}{{$sub->id }}').setAttribute('class', 'ss');
                                } else {
                                    document.getElementById('ts{{$student->id }}{{$sub->id }}').setAttribute('class', 'sp');
                                }
                                $(document).ready(function(){
                                    $.ajaxSetup({
                                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                                    });
                                    /* Submit form data using ajax*/
                                $.ajax({
                                    url: "{{ route('third.sequence.save') }}",
                                    method: 'get',
                                    data: $('#tsm{{$student->id }}{{$sub->id }}').serialize(),
                                    success: function(response){
                                        toastr.options = {
                                        "closeButton": false,
                                        "debug": false,
                                        "newestOnTop": true,
                                        "progressBar": false,
                                        "positionClass": "toast-top-right",
                                        "preventDuplicates": false,
                                        "onclick": null,
                                        "showDuration": "300",
                                        "hideDuration": "1000",
                                        "timeOut": "2000",
                                        "extendedTimeOut": "1000",
                                        "showEasing": "swing",
                                        "hideEasing": "linear",
                                        "showMethod": "fadeIn",
                                        "hideMethod": "fadeOut"
                                        }
                                        if(response.type == 'error'){ toastr.error(response.message);}
                                        if(response.type == 'warning'){ toastr.warning(response.message);}
                                        if(response.type == 'update'){ toastr.info(response.message);}
                                        if(response.type == 'success'){ toastr.success(response.message);}
                                        //setTimeout(function(){window.location.reload();},7000);
                                    },
                                    error: function(error){
                                        console.log('the error', response);
                                        toastr.info(error);
                                    }
                                });
                            });
                            }

                            // fourth sequence
                            function checkfs{{$student->id }}{{$sub->id }}(ev){
                                console.log('the value', parseInt(ev.target.value));
                                var val = parseInt(ev.target.value);
                                if(val < 10){
                                    document.getElementById('fs{{$student->id }}{{$sub->id }}').setAttribute('class', 'ss');
                                } else {
                                    document.getElementById('fs{{$student->id }}{{$sub->id }}').setAttribute('class', 'sp');
                                }
                                $(document).ready(function(){
                                    $.ajaxSetup({
                                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                                    });
                                    /* Submit form data using ajax*/
                                $.ajax({
                                    url: "{{ route('fourth.sequence.save') }}",
                                    method: 'get',
                                    data: $('#fsm{{$student->id }}{{$sub->id }}').serialize(),
                                    success: function(response){
                                        toastr.options = {
                                        "closeButton": false,
                                        "debug": false,
                                        "newestOnTop": true,
                                        "progressBar": false,
                                        "positionClass": "toast-top-right",
                                        "preventDuplicates": false,
                                        "onclick": null,
                                        "showDuration": "300",
                                        "hideDuration": "1000",
                                        "timeOut": "2000",
                                        "extendedTimeOut": "1000",
                                        "showEasing": "swing",
                                        "hideEasing": "linear",
                                        "showMethod": "fadeIn",
                                        "hideMethod": "fadeOut"
                                        }
                                        if(response.type == 'error'){ toastr.error(response.message);}
                                        if(response.type == 'warning'){ toastr.warning(response.message);}
                                        if(response.type == 'update'){ toastr.info(response.message);}
                                        if(response.type == 'success'){ toastr.success(response.message);}
                                        //setTimeout(function(){window.location.reload();},7000);
                                    },
                                    error: function(error){
                                        console.log('the error', response);
                                        toastr.info(error);
                                    }
                                });
                            });
                            }

                            // firth sequence
                            function checksseq5{{$student->id }}{{$sub->id }}(ev){
                                console.log('the value', parseInt(ev.target.value));
                                var val = parseInt(ev.target.value);
                                if(val < 10){
                                    document.getElementById('sseq5{{$student->id }}{{$sub->id }}').setAttribute('class', 'ss');
                                } else {
                                    document.getElementById('sseq5{{$student->id }}{{$sub->id }}').setAttribute('class', 'sp');
                                }
                                $(document).ready(function(){
                                    $.ajaxSetup({
                                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                                    });
                                    /* Submit form data using ajax*/
                                $.ajax({
                                    url: "{{ route('firth.sequence.save') }}",
                                    method: 'get',
                                    data: $('#seq5{{$student->id }}{{$sub->id }}').serialize(),
                                    success: function(response){
                                        toastr.options = {
                                        "closeButton": false,
                                        "debug": false,
                                        "newestOnTop": true,
                                        "progressBar": false,
                                        "positionClass": "toast-top-right",
                                        "preventDuplicates": false,
                                        "onclick": null,
                                        "showDuration": "300",
                                        "hideDuration": "1000",
                                        "timeOut": "2000",
                                        "extendedTimeOut": "1000",
                                        "showEasing": "swing",
                                        "hideEasing": "linear",
                                        "showMethod": "fadeIn",
                                        "hideMethod": "fadeOut"
                                        }
                                        if(response.type == 'error'){ toastr.error(response.message);}
                                        if(response.type == 'warning'){ toastr.warning(response.message);}
                                        if(response.type == 'update'){ toastr.info(response.message);}
                                        if(response.type == 'success'){ toastr.success(response.message);}
                                        //setTimeout(function(){window.location.reload();},7000);
                                    },
                                    error: function(error){
                                        console.log('the error', response);
                                        toastr.info(error);
                                    }
                                });
                            });
                            }

                            // sith sequence
                            function checkffseq6{{$student->id }}{{$sub->id }}(ev){
                                console.log('the value', parseInt(ev.target.value));
                                var val = parseInt(ev.target.value);
                                if(val < 10){
                                    document.getElementById('fseq6{{$student->id }}{{$sub->id }}').setAttribute('class', 'ss');
                                } else {
                                    document.getElementById('fseq6{{$student->id }}{{$sub->id }}').setAttribute('class', 'sp');
                                }
                                $(document).ready(function(){
                                    $.ajaxSetup({
                                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                                    });
                                    /* Submit form data using ajax*/
                                $.ajax({
                                    url: "{{ route('sith.sequence.save') }}",
                                    method: 'get',
                                    data: $('#ffseq6m{{$student->id }}{{$sub->id }}').serialize(),
                                    success: function(response){
                                        toastr.options = {
                                        "closeButton": false,
                                        "debug": false,
                                        "newestOnTop": true,
                                        "progressBar": false,
                                        "positionClass": "toast-top-right",
                                        "preventDuplicates": false,
                                        "onclick": null,
                                        "showDuration": "300",
                                        "hideDuration": "1000",
                                        "timeOut": "2000",
                                        "extendedTimeOut": "1000",
                                        "showEasing": "swing",
                                        "hideEasing": "linear",
                                        "showMethod": "fadeIn",
                                        "hideMethod": "fadeOut"
                                        }
                                        if(response.type == 'error'){ toastr.error(response.message);}
                                        if(response.type == 'warning'){ toastr.warning(response.message);}
                                        if(response.type == 'update'){ toastr.info(response.message);}
                                        if(response.type == 'success'){ toastr.success(response.message);}
                                        //setTimeout(function(){window.location.reload();},7000);
                                    },
                                    error: function(error){
                                        console.log('the error', response);
                                        toastr.info(error);
                                    }
                                });
                            });
                            }
                        </script>
                    @endforeach
                </tr>

                {{-- students from sub classes --}}
                @endforeach
                <tr class="teal-text center bold" style="background-color: rgb(169, 238, 238)"><td colspan="20">All Student from Sub classes of @if($class != []) {{ $class->name }}-{{ $class->background->name }}-{{ $class->background->sector->name }}@endif</td></tr>
                @foreach ($sub_students as $key => $sub_student)
                <tr>
                    <td><b class="left">{{ $key + 1 }}. {{ $sub_student->student->full_name }} - <?php $cl = App\Subclass::where('id',  $sub_student->subform_id)->first(); echo $cl->type;?></b> <em class="right">{{ $sub_student->student_school_id }}</em></td>

                    @foreach ($subjects as $s => $subs)
                    {{-- first sequence --}}
                        @if($first)
                            <td>
                                {{-- first sequence for sub-students --}}
                                <form action="" method="get" id="fms{{$sub_student->id }}{{$subs->id }}">
                                    @csrf
                                    <input type="hidden" name="year" value="{{ $current_year->id }}">
                                    <input type="hidden" name="student" value="{{ $sub_student->student->id }}">
                                    <input type="hidden" name="subject" value="{{ $subs->id }}">
                                    <input type="hidden" name="form" value="{{ \Crypt::encrypt($subs->form->id) }}">
                                    <?php $sfseq = App\Firsttermresult::where('year_id',$current_year->id)
                                    ->where('student_id', $sub_student->student->id)->where('subject_id', $subs->id)->get();
                                     $sarr1 = array();
                                     foreach ($sfseq as $vall) { array_push($sarr1, $vall->seq1);} $sseq1 = current($sarr1);
                                      ?>
                                    <input type="number" name="seq1" value="{{ $sseq1 }}" id="f{{$sub_student->id }}{{$subs->id }}" class="{{ (int)$sseq1 < 10 ? 'ss':'sp' }}" onchange="checkf{{ $sub_student->id }}{{ $subs->id }}(event)"></td>
                                </form>
                            <td>
                                {{-- second sequence for sub-students --}}
                                <form action="" method="get" id="sms{{$sub_student->id }}{{$subs->id }}">
                                    @csrf
                                    <input type="hidden" name="year" value="{{ $current_year->id }}">
                                    <input type="hidden" name="student" value="{{ $sub_student->student->id }}">
                                    <input type="hidden" name="subject" value="{{ $subs->id }}">
                                    <input type="hidden" name="form" value="{{ \Crypt::encrypt($subs->form->id) }}">
                                    <?php $sfseq2 = App\Firsttermresult::where('year_id',$current_year->id)
                                    ->where('student_id', $sub_student->student->id)->where('subject_id', $subs->id)->get();
                                     $sarr2 = array();
                                     foreach ($sfseq2 as $svall) { array_push($sarr2, $svall->seq2);} $sseq2 = current($sarr2);
                                      ?>
                                    <input type="number" name="seq2" value="{{ $sseq2 }}" id="s{{$sub_student->id }}{{$subs->id }}" class="{{ (int)$sseq2 < 10 ? 'ss':'sp' }}" onchange="checks{{ $sub_student->id }}{{ $subs->id }}(event)"></td>
                                </form>
                            </td>
                        @endif
                        {{-- second term --}}
                        @if($second)
                        <td>
                            {{-- third sequence from sub-student --}}
                            <form action="" method="get" id="tsms{{$sub_student->id }}{{$subs->id }}">
                                @csrf
                                <input type="hidden" name="year" value="{{ $current_year->id }}">
                                <input type="hidden" name="student" value="{{ $sub_student->student->id }}">
                                <input type="hidden" name="subject" value="{{ $subs->id }}">
                                <input type="hidden" name="form" value="{{ \Crypt::encrypt($subs->form->id) }}">
                                <?php $tseqs = App\Secondtermresult::where('year_id',$current_year->id)
                                ->where('student_id', $sub_student->student->id)->where('subject_id', $subs->id)->get();
                                 $tsa1 = array();
                                 foreach ($tseqs as $ts1) { array_push($tsa1, $ts1->seq3);} $tseq1 = current($tsa1);
                                  ?>
                                <input type="number" name="seq3" value="{{ $tseq1 }}" id="tss{{$sub_student->id }}{{$subs->id }}" class="{{ (int)$tseq1 < 10 ? 'ss':'sp' }}" onchange="checktss{{ $sub_student->id }}{{ $subs->id }}(event)"></td>
                            </form>
                        <td>
                            <form action="" method="POST">
                                @csrf
                            <input type="number" name="seq4" id="s{{$sub_student->id }}{{$subs->id }}" class="sp" onchange="checks{{$sub_student->id }}{{$subs->id }}(event)">
                            </form>
                             {{-- four sequence from sub-student --}}
                             <form action="" method="get" id="fsms{{$sub_student->id }}{{$subs->id }}">
                                @csrf
                                <input type="hidden" name="year" value="{{ $current_year->id }}">
                                <input type="hidden" name="student" value="{{ $sub_student->student->id }}">
                                <input type="hidden" name="subject" value="{{ $subs->id }}">
                                <input type="hidden" name="form" value="{{ \Crypt::encrypt($subs->form->id) }}">
                                <?php $fseqs4 = App\Secondtermresult::where('year_id',$current_year->id)
                                ->where('student_id', $sub_student->student->id)->where('subject_id', $subs->id)->get();
                                 $fsa4 = array();
                                 foreach ($fseqs4 as $ts4) { array_push($fsa4, $ts4->seq4);} $fseq4 = current($fsa4);
                                  ?>
                                <input type="number" name="seq4" value="{{ $fseq4 }}" id="fss4{{$sub_student->id }}{{$subs->id }}" class="{{ (int)$fseq4 < 10 ? 'ss':'sp' }}" onchange="checkfss4{{ $sub_student->id }}{{ $subs->id }}(event)"></td>
                            </form>
                        </td>
                        @endif
                        {{-- third term --}}
                        @if($third)
                        <td>
                            {{-- firth sequence for subsequence --}}
                            <form action="" method="get" id="fseqq{{$sub_student->id }}{{$subs->id }}">
                                @csrf
                                <input type="hidden" name="year" value="{{ $current_year->id }}">
                                <input type="hidden" name="student" value="{{ $sub_student->student->id }}">
                                <input type="hidden" name="subject" value="{{ $subs->id }}">
                                <input type="hidden" name="form" value="{{ \Crypt::encrypt($subs->form->id) }}">
                                <?php $fff = App\Thirdtermresult::where('year_id',$current_year->id)
                                ->where('student_id', $sub_student->student->id)->where('subject_id', $subs->id)->get();
                                 $ffseq5 = array();
                                 foreach ($fff as $ff) { array_push($ffseq5, $ff->seq5);} $sq5f = current($ffseq5);
                                  ?>
                                <input type="number" name="seq5" value="{{ $sq5f }}" id="ssseq5{{$sub_student->id }}{{$subs->id }}" class="{{ (int)$sq5f < 10 ? 'ss':'sp' }}" onchange="checkfsseq5{{ $sub_student->id }}{{ $subs->id }}(event)"></td>
                            </form>
                        <td>
                            {{-- sith sequence for sub-students --}}
                            <form action="" method="get" id="sfseq6m{{$sub_student->id }}{{$subs->id }}">
                                @csrf
                                <input type="hidden" name="year" value="{{ $current_year->id }}">
                                <input type="hidden" name="student" value="{{ $sub_student->student->id }}">
                                <input type="hidden" name="subject" value="{{ $subs->id }}">
                                <input type="hidden" name="form" value="{{ \Crypt::encrypt($subs->form->id) }}">
                                <?php $noel6 = App\Thirdtermresult::where('year_id',$current_year->id)
                                ->where('student_id', $sub_student->student->id)->where('subject_id', $subs->id)->get();
                                 $noell = array();
                                 foreach ($noel6 as $s6) { array_push($noell, $s6->seq6);} $svar6 = current($noell);
                                  ?>
                                <input type="number" name="seq6" value="{{ $svar6 }}" id="sffseq6{{$sub_student->id }}{{$subs->id }}" class="{{ (int)$svar6 < 10 ? 'ss':'sp' }}" onchange="checksfseq6{{ $sub_student->id }}{{ $subs->id }}(event)"></td>
                            </form>
                        </td>
                        @endif
                        <script>
                            // first sequence for sub-student
                            function checkf{{ $sub_student->id }}{{ $subs->id }}(ev){
                                console.log('the value', parseInt(ev.target.value));
                                var val = parseInt(ev.target.value);
                                if(val < 10){
                                    document.getElementById('f{{ $sub_student->id }}{{ $subs->id }}').setAttribute('class', 'ss');
                                }
                                else {
                                    document.getElementById('f{{ $sub_student->id }}{{ $subs->id }}').setAttribute('class', 'sp');
                                }
                                $(document).ready(function(){
                                    $.ajaxSetup({
                                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                                    });
                                    /* Submit form data using ajax*/
                                $.ajax({
                                    url: "{{ route('first.sequence.save') }}",
                                    method: 'get',
                                    data: $('#fms{{$sub_student->id }}{{$subs->id }}').serialize(),
                                    success: function(response){
                                        console.log('the result', response);
                                        toastr.options = {
                                        "closeButton": false,
                                        "debug": false,
                                        "newestOnTop": true,
                                        "progressBar": false,
                                        "positionClass": "toast-top-right",
                                        "preventDuplicates": false,
                                        "onclick": null,
                                        "showDuration": "300",
                                        "hideDuration": "1000",
                                        "timeOut": "2000",
                                        "extendedTimeOut": "1000",
                                        "showEasing": "swing",
                                        "hideEasing": "linear",
                                        "showMethod": "fadeIn",
                                        "hideMethod": "fadeOut"
                                        }
                                        if(response.type == 'error'){ toastr.error(response.message);}
                                        if(response.type == 'warning'){ toastr.warning(response.message);}
                                        if(response.type == 'update'){ toastr.info(response.message);}
                                        if(response.type == 'success'){ toastr.success(response.message);}
                                        //setTimeout(function(){window.location.reload();},7000);
                                    },
                                    error: function(error){
                                        console.log('the error', response);
                                        toastr.info(error);
                                    }
                                });
                            });
                            }


                            // second sequence for sub-student
                            function checks{{$sub_student->id }}{{$subs->id }}(ev){
                                console.log('the value', parseInt(ev.target.value));
                                var val = parseInt(ev.target.value);
                                if(val < 10){
                                    document.getElementById('s{{$sub_student->id }}{{$subs->id }}').setAttribute('class', 'ss');
                                } else {
                                    document.getElementById('s{{$sub_student->id }}{{$subs->id }}').setAttribute('class', 'sp');
                                }
                                $(document).ready(function(){
                                    $.ajaxSetup({
                                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                                    });
                                    /* Submit form data using ajax*/
                                $.ajax({
                                    url: "{{ route('second.sequence.save') }}",
                                    method: 'get',
                                    data: $('#sms{{$sub_student->id }}{{$subs->id }}').serialize(),
                                    success: function(response){
                                        console.log('the result', response);
                                        toastr.options = {
                                        "closeButton": false,
                                        "debug": false,
                                        "newestOnTop": true,
                                        "progressBar": false,
                                        "positionClass": "toast-top-right",
                                        "preventDuplicates": false,
                                        "onclick": null,
                                        "showDuration": "300",
                                        "hideDuration": "1000",
                                        "timeOut": "2000",
                                        "extendedTimeOut": "1000",
                                        "showEasing": "swing",
                                        "hideEasing": "linear",
                                        "showMethod": "fadeIn",
                                        "hideMethod": "fadeOut"
                                        }
                                        if(response.type == 'error'){ toastr.error(response.message);}
                                        if(response.type == 'warning'){ toastr.warning(response.message);}
                                        if(response.type == 'update'){ toastr.info(response.message);}
                                        if(response.type == 'success'){ toastr.success(response.message);}
                                        //setTimeout(function(){window.location.reload();},7000);
                                    },
                                    error: function(error){
                                        console.log('the error', response);
                                        toastr.info(error);
                                    }
                                });
                            });
                            }

                            // third sequence for sub-student
                            function checktss{{$sub_student->id }}{{$subs->id }}(ev){
                                console.log('the value', parseInt(ev.target.value));
                                var val = parseInt(ev.target.value);
                                if(val < 10){
                                    document.getElementById('tss{{$sub_student->id }}{{$subs->id }}').setAttribute('class', 'ss');
                                } else {
                                    document.getElementById('tss{{$sub_student->id }}{{$subs->id }}').setAttribute('class', 'sp');
                                }
                                $(document).ready(function(){
                                    $.ajaxSetup({
                                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                                    });
                                    /* Submit form data using ajax*/
                                $.ajax({
                                    url: "{{ route('third.sequence.save') }}",
                                    method: 'get',
                                    data: $('#tsms{{$sub_student->id }}{{$subs->id }}').serialize(),
                                    success: function(response){
                                        console.log('the result', response);
                                        toastr.options = {
                                        "closeButton": false,
                                        "debug": false,
                                        "newestOnTop": true,
                                        "progressBar": false,
                                        "positionClass": "toast-top-right",
                                        "preventDuplicates": false,
                                        "onclick": null,
                                        "showDuration": "300",
                                        "hideDuration": "1000",
                                        "timeOut": "2000",
                                        "extendedTimeOut": "1000",
                                        "showEasing": "swing",
                                        "hideEasing": "linear",
                                        "showMethod": "fadeIn",
                                        "hideMethod": "fadeOut"
                                        }
                                        if(response.type == 'error'){ toastr.error(response.message);}
                                        if(response.type == 'warning'){ toastr.warning(response.message);}
                                        if(response.type == 'update'){ toastr.info(response.message);}
                                        if(response.type == 'success'){ toastr.success(response.message);}
                                        //setTimeout(function(){window.location.reload();},7000);
                                    },
                                    error: function(error){
                                        console.log('the error', response);
                                        toastr.info(error);
                                    }
                                });
                            });
                            }


                            // fourth sequence for sub-student
                            function checkfss4{{$sub_student->id }}{{$subs->id }}(ev){
                                console.log('the value', parseInt(ev.target.value));
                                var val = parseInt(ev.target.value);
                                if(val < 10){
                                    document.getElementById('fss4{{$sub_student->id }}{{$subs->id }}').setAttribute('class', 'ss');
                                } else {
                                    document.getElementById('fss4{{$sub_student->id }}{{$subs->id }}').setAttribute('class', 'sp');
                                }
                                $(document).ready(function(){
                                    $.ajaxSetup({
                                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                                    });
                                    /* Submit form data using ajax*/
                                $.ajax({
                                    url: "{{ route('fourth.sequence.save') }}",
                                    method: 'get',
                                    data: $('#fsms{{$sub_student->id }}{{$subs->id }}').serialize(),
                                    success: function(response){
                                        console.log('the result', response);
                                        toastr.options = {
                                        "closeButton": false,
                                        "debug": false,
                                        "newestOnTop": true,
                                        "progressBar": false,
                                        "positionClass": "toast-top-right",
                                        "preventDuplicates": false,
                                        "onclick": null,
                                        "showDuration": "300",
                                        "hideDuration": "1000",
                                        "timeOut": "2000",
                                        "extendedTimeOut": "1000",
                                        "showEasing": "swing",
                                        "hideEasing": "linear",
                                        "showMethod": "fadeIn",
                                        "hideMethod": "fadeOut"
                                        }
                                        if(response.type == 'error'){ toastr.error(response.message);}
                                        if(response.type == 'warning'){ toastr.warning(response.message);}
                                        if(response.type == 'update'){ toastr.info(response.message);}
                                        if(response.type == 'success'){ toastr.success(response.message);}
                                        //setTimeout(function(){window.location.reload();},7000);
                                    },
                                    error: function(error){
                                        console.log('the error', response);
                                        toastr.info(error);
                                    }
                                });
                            });
                            }

                            // firth sequence for sub-student
                            function checkfsseq5{{$sub_student->id }}{{$subs->id }}(ev){
                                console.log('the value', parseInt(ev.target.value));
                                var val = parseInt(ev.target.value);
                                if(val < 10){
                                    document.getElementById('ssseq5{{$sub_student->id }}{{$subs->id }}').setAttribute('class', 'ss');
                                } else {
                                    document.getElementById('ssseq5{{$sub_student->id }}{{$subs->id }}').setAttribute('class', 'sp');
                                }
                                $(document).ready(function(){
                                    $.ajaxSetup({
                                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                                    });
                                    /* Submit form data using ajax*/
                                $.ajax({
                                    url: "{{ route('firth.sequence.save') }}",
                                    method: 'get',
                                    data: $('#fseqq{{$sub_student->id }}{{$subs->id }}').serialize(),
                                    success: function(response){
                                        console.log('the result', response);
                                        toastr.options = {
                                        "closeButton": false,
                                        "debug": false,
                                        "newestOnTop": true,
                                        "progressBar": false,
                                        "positionClass": "toast-top-right",
                                        "preventDuplicates": false,
                                        "onclick": null,
                                        "showDuration": "300",
                                        "hideDuration": "1000",
                                        "timeOut": "2000",
                                        "extendedTimeOut": "1000",
                                        "showEasing": "swing",
                                        "hideEasing": "linear",
                                        "showMethod": "fadeIn",
                                        "hideMethod": "fadeOut"
                                        }
                                        if(response.type == 'error'){ toastr.error(response.message);}
                                        if(response.type == 'warning'){ toastr.warning(response.message);}
                                        if(response.type == 'update'){ toastr.info(response.message);}
                                        if(response.type == 'success'){ toastr.success(response.message);}
                                        //setTimeout(function(){window.location.reload();},7000);
                                    },
                                    error: function(error){
                                        console.log('the error', response);
                                        toastr.info(error);
                                    }
                                });
                            });
                            }

                            // sith sequence for sub-students
                            function checksfseq6{{$sub_student->id }}{{$subs->id }}(ev){
                                console.log('the value', parseInt(ev.target.value));
                                var val = parseInt(ev.target.value);
                                if(val < 10){
                                    document.getElementById('sffseq6{{$sub_student->id }}{{$subs->id }}').setAttribute('class', 'ss');
                                } else {
                                    document.getElementById('sffseq6{{$sub_student->id }}{{$subs->id }}').setAttribute('class', 'sp');
                                }
                                $(document).ready(function(){
                                    $.ajaxSetup({
                                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                                    });
                                    /* Submit form data using ajax*/
                                $.ajax({
                                    url: "{{ route('sith.sequence.save') }}",
                                    method: 'get',
                                    data: $('#sfseq6m{{$sub_student->id }}{{$subs->id }}').serialize(),
                                    success: function(response){
                                        toastr.options = {
                                        "closeButton": false,
                                        "debug": false,
                                        "newestOnTop": true,
                                        "progressBar": false,
                                        "positionClass": "toast-top-right",
                                        "preventDuplicates": false,
                                        "onclick": null,
                                        "showDuration": "300",
                                        "hideDuration": "1000",
                                        "timeOut": "2000",
                                        "extendedTimeOut": "1000",
                                        "showEasing": "swing",
                                        "hideEasing": "linear",
                                        "showMethod": "fadeIn",
                                        "hideMethod": "fadeOut"
                                        }
                                        if(response.type == 'error'){ toastr.error(response.message);}
                                        if(response.type == 'warning'){ toastr.warning(response.message);}
                                        if(response.type == 'update'){ toastr.info(response.message);}
                                        if(response.type == 'success'){ toastr.success(response.message);}
                                        //setTimeout(function(){window.location.reload();},7000);
                                    },
                                    error: function(error){
                                        console.log('the error', response);
                                        toastr.info(error);
                                    }
                                });
                            });
                            }
                        </script>
                    @endforeach
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection
