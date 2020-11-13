{{--  student from A class  --}}
@foreach ($students as $key => $student)
<tr>
    <td><b class="left">{{ $key + 1 }}. {{ $student->student->full_name }}</b> <em class="right">{{ $student->student_school_id }}</em></td>

    @foreach ($subjects as $s => $sub)
    {{-- first term --}}
        @if($first)
            <td>
                {{-- first sequence --}}
                <form action="" method="get" id="fm{{$student->id }}{{$sub->subject_id }}">
                    @csrf
                    <input type="hidden" name="year" value="{{ $current_year->id }}">
                    <input type="hidden" name="student" value="{{ $student->student->id }}">
                    <input type="hidden" name="subject" value="{{ $sub->subject_id }}">
                    <input type="hidden" name="form" value="{{ $sub->form_id }}">
                    <?php $fseq = App\Firsttermresult::where('year_id',$current_year->id)
                    ->where('student_id', $student->student->id)->where('subject_id', $sub->subject_id)->get();
                     $arr = array();
                     foreach ($fseq as $val) { array_push($arr, $val->seq1);} $seq1 = current($arr);
                      ?>
                    <input type="number" name="seq1" @if($sub->status == 1) readonly @endif value="{{ $seq1 }}" id="f{{$student->id }}{{$sub->subject_id }}" class="{{ (int)$seq1 < 10 ? 'ss':'sp' }}" onchange="checkf{{ $student->id }}{{ $sub->subject_id }}(event)"></td>
                </form>
            <td>
                {{-- second sequence --}}
                <form action="" method="get" id="sm{{$student->id }}{{$sub->subject_id }}">
                    @csrf
                    <input type="hidden" name="year" value="{{ $current_year->id }}">
                    <input type="hidden" name="student" value="{{ $student->student->id }}">
                    <input type="hidden" name="subject" value="{{ $sub->subject_id }}">
                    <input type="hidden" name="form" value="{{ $sub->form_id }}">
                    <?php $fseq = App\Firsttermresult::where('year_id',$current_year->id)
                    ->where('student_id', $student->student->id)->where('subject_id', $sub->subject_id)->get();
                     $arr2 = array();
                     foreach ($fseq as $valsa) { array_push($arr2, $valsa->seq2);} $seqsa = current($arr2);
                      ?>
                    <input type="number" name="seq2" @if($sub->status == 1) readonly @endif value="{{ $seqsa }}" id="s{{$student->id }}{{$sub->subject_id }}" class="{{ (int)$seqsa < 10 ? 'ss':'sp' }}" onchange="checks{{$student->id }}{{$sub->subject_id }}(event)">
                </form>
            </td>
        @endif
        {{-- second term --}}
        @if($second)
        <td>
            {{-- third sequence --}}
            <form action="" method="get" id="tsm{{$student->id }}{{$sub->subject_id }}">
                @csrf
                <input type="hidden" name="year" value="{{ $current_year->id }}">
                <input type="hidden" name="student" value="{{ $student->student->id }}">
                <input type="hidden" name="subject" value="{{ $sub->subject_id }}">
                <input type="hidden" name="form" value="{{ $sub->form_id }}">
                <?php $tseq = App\Secondtermresult::where('year_id',$current_year->id)
                ->where('student_id', $student->student->id)->where('subject_id', $sub->subject_id)->get();
                 $arr3 = array();
                 foreach ($tseq as $ts) { array_push($arr3, $ts->seq3);} $ts1 = current($arr3);
                  ?>
                <input type="number" name="seq3" @if($sub->status == 1) readonly @endif value="{{ $ts1 }}" id="ts{{$student->id }}{{$sub->subject_id }}" class="{{ (int)$ts1 < 10 ? 'ss':'sp' }}" onchange="checkts{{ $student->id }}{{ $sub->subject_id }}(event)"></td>
            </form>
        <td>
             {{-- fourth sequence --}}
            <form action="" method="get" id="fsm{{$student->id }}{{$sub->subject_id }}">
                @csrf
                <input type="hidden" name="year" value="{{ $current_year->id }}">
                <input type="hidden" name="student" value="{{ $student->student->id }}">
                <input type="hidden" name="subject" value="{{ $sub->subject_id }}">
                <input type="hidden" name="form" value="{{ $sub->form_id }}">
                <?php $fseq = App\Secondtermresult::where('year_id',$current_year->id)
                ->where('student_id', $student->student->id)->where('subject_id', $sub->subject_id)->get();
                 $fsa = array();
                 foreach ($tseq as $fs) { array_push($fsa, $fs->seq4);} $fseqsa1 = current($fsa);
                  ?>
                <input type="number" name="seq4" @if($sub->status == 1) readonly @endif value="{{ $fseqsa1 }}" id="fs{{$student->id }}{{$sub->subject_id }}" class="{{ (int)$fseqsa1 < 10 ? 'ss':'sp' }}" onchange="checkfs{{ $student->id }}{{ $sub->subject_id }}(event)"></td>
            </form>
        </td>
        @endif
        {{-- third term --}}
        @if($third)
        <td>
            {{-- firth sequence --}}
            <form action="" method="get" id="seq5{{$student->id }}{{$sub->subject_id }}">
                @csrf
                <input type="hidden" name="year" value="{{ $current_year->id }}">
                <input type="hidden" name="student" value="{{ $student->student->id }}">
                <input type="hidden" name="subject" value="{{ $sub->subject_id }}">
                <input type="hidden" name="form" value="{{ $sub->form_id }}">
                <?php $seq5 = App\Thirdtermresult::where('year_id',$current_year->id)
                ->where('student_id', $student->student->id)->where('subject_id', $sub->subject_id)->get();
                 $fseq5 = array();
                 foreach ($seq5 as $s5) { array_push($fseq5, $s5->seq5);} $fseq5 = current($fseq5);
                  ?>
                <input type="number" name="seq5" @if($sub->status == 1) readonly @endif value="{{ $fseq5 }}" id="sseq5{{$student->id }}{{$sub->subject_id }}" class="{{ (int)$fseq5 < 10 ? 'ss':'sp' }}" onchange="checksseq5{{ $student->id }}{{ $sub->subject_id }}(event)"></td>
            </form>
        <td>
            {{-- sixth sequence --}}
            <form action="" method="get" id="ffseq6m{{$student->id }}{{$sub->subject_id }}">
                @csrf
                <input type="hidden" name="year" value="{{ $current_year->id }}">
                <input type="hidden" name="student" value="{{ $student->student->id }}">
                <input type="hidden" name="subject" value="{{ $sub->subject_id }}">
                <input type="hidden" name="form" value="{{ $sub->form_id }}">
                <?php $noel6 = App\Thirdtermresult::where('year_id',$current_year->id)
                ->where('student_id', $student->student->id)->where('subject_id', $sub->subject_id)->get();
                 $noell = array();
                 foreach ($noel6 as $s6) { array_push($noell, $s6->seq6);} $var6 = current($noell);
                  ?>
                <input type="number" name="seq6" @if($sub->status == 1) readonly @endif value="{{ $var6 }}" id="fseq6{{$student->id }}{{$sub->subject_id }}" class="{{ (int)$var6 < 10 ? 'ss':'sp' }}" onchange="checkffseq6{{ $student->id }}{{ $sub->subject_id }}(event)"></td>
            </form>
        </td>
        @endif
        <script>
            // first sequence
            function checkf{{ $student->id }}{{ $sub->subject_id }}(ev){
                var val = parseInt(ev.target.value);
                if(val < 10){
                    console.log('the value changed');
                    document.getElementById('f{{ $student->id }}{{ $sub->subject_id }}').setAttribute('class', 'ss');
                }
                else {
                    document.getElementById('f{{ $student->id }}{{ $sub->subject_id }}').setAttribute('class', 'sp');
                }
                $(document).ready(function(){
                    $.ajaxSetup({
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                    });
                    /* Submit form data using ajax*/
                $.ajax({
                    url: "{{ route('first.sequence.saves') }}",
                    method: 'get',
                    data: $('#fm{{$student->id }}{{$sub->subject_id }}').serialize(),
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
            function checks{{$student->id }}{{$sub->subject_id }}(ev){
                console.log('the value', parseInt(ev.target.value));
                var val = parseInt(ev.target.value);
                if(val < 10){
                    document.getElementById('s{{$student->id }}{{$sub->subject_id }}').setAttribute('class', 'ss');
                } else {
                    document.getElementById('s{{$student->id }}{{$sub->subject_id }}').setAttribute('class', 'sp');
                }
                $(document).ready(function(){
                    $.ajaxSetup({
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                    });
                    /* Submit form data using ajax*/
                $.ajax({
                    url: "{{ route('second.sequence.saves') }}",
                    method: 'get',
                    data: $('#sm{{$student->id }}{{$sub->subject_id }}').serialize(),
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
            function checkts{{$student->id }}{{$sub->subject_id }}(ev){
                console.log('the value', parseInt(ev.target.value));
                var val = parseInt(ev.target.value);
                if(val < 10){
                    document.getElementById('ts{{$student->id }}{{$sub->subject_id }}').setAttribute('class', 'ss');
                } else {
                    document.getElementById('ts{{$student->id }}{{$sub->subject_id }}').setAttribute('class', 'sp');
                }
                $(document).ready(function(){
                    $.ajaxSetup({
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                    });
                    /* Submit form data using ajax*/
                $.ajax({
                    url: "{{ route('third.sequence.saves') }}",
                    method: 'get',
                    data: $('#tsm{{$student->id }}{{$sub->subject_id }}').serialize(),
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
            function checkfs{{$student->id }}{{$sub->subject_id }}(ev){
                console.log('the value', parseInt(ev.target.value));
                var val = parseInt(ev.target.value);
                if(val < 10){
                    document.getElementById('fs{{$student->id }}{{$sub->subject_id }}').setAttribute('class', 'ss');
                } else {
                    document.getElementById('fs{{$student->id }}{{$sub->subject_id }}').setAttribute('class', 'sp');
                }
                $(document).ready(function(){
                    $.ajaxSetup({
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                    });
                    /* Submit form data using ajax*/
                $.ajax({
                    url: "{{ route('fourth.sequence.saves') }}",
                    method: 'get',
                    data: $('#fsm{{$student->id }}{{$sub->subject_id }}').serialize(),
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
            function checksseq5{{$student->id }}{{$sub->subject_id }}(ev){
                console.log('the value', parseInt(ev.target.value));
                var val = parseInt(ev.target.value);
                if(val < 10){
                    document.getElementById('sseq5{{$student->id }}{{$sub->subject_id }}').setAttribute('class', 'ss');
                } else {
                    document.getElementById('sseq5{{$student->id }}{{$sub->subject_id }}').setAttribute('class', 'sp');
                }
                $(document).ready(function(){
                    $.ajaxSetup({
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                    });
                    /* Submit form data using ajax*/
                $.ajax({
                    url: "{{ route('firth.sequence.saves') }}",
                    method: 'get',
                    data: $('#seq5{{$student->id }}{{$sub->subject_id }}').serialize(),
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

            // sixth sequence
            function checkffseq6{{$student->id }}{{$sub->subject_id }}(ev){
                console.log('the value', parseInt(ev.target.value));
                var val = parseInt(ev.target.value);
                if(val < 10){
                    document.getElementById('fseq6{{$student->id }}{{$sub->subject_id }}').setAttribute('class', 'ss');
                } else {
                    document.getElementById('fseq6{{$student->id }}{{$sub->subject_id }}').setAttribute('class', 'sp');
                }
                $(document).ready(function(){
                    $.ajaxSetup({
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                    });
                    /* Submit form data using ajax*/
                $.ajax({
                    url: "{{ route('sixth.sequence.save') }}",
                    method: 'get',
                    data: $('#ffseq6m{{$student->id }}{{$sub->subject_id }}').serialize(),
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
