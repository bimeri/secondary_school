
                 {{-- students from sub class B --}}
                 @if($b_students->count() > 0)
                    <tr class="teal-text center bold" style="background-color: rgb(169, 238, 238)"><td colspan="20">All Student from Sub class <b class="text-black">B</b> of @if($class != []) {{ $class->name }}-{{ $class->background->name }}-{{ $class->background->sector->name }} <em class="right w3-medium">{{ $class->name }} B</em>@endif</td></tr>
                @endif
                @foreach ($b_students as $key => $sub_student)
                <tr>
                    <td><b class="left">{{ $key + 1 }}. {{ $sub_student->student->full_name }} - <?php $cl = App\Subclass::where('id',  $sub_student->subform_id)->first(); echo $cl->type;?></b> <em class="right">{{ $sub_student->student->school_id }}</em></td>
                    @foreach ($subjects as $s => $subs)
                    {{-- first sequence --}}
                        @if($first)
                            <td>
                                {{-- first sequence for sub-students --}}
                                <form action="" method="get" id="fms{{$sub_student->id }}{{$subs->subject_id }}">
                                    @csrf
                                    <input type="hidden" name="year" value="{{ $current_year->id }}">
                                    <input type="hidden" name="student" value="{{ $sub_student->student->id }}">
                                    <input type="hidden" name="subject" value="{{ $subs->subject_id }}">
                                    <input type="hidden" name="form" value="{{ $subs->form_id }}">
                                    <?php $sfseq = App\Firsttermresult::where('year_id',$current_year->id)
                                    ->where('student_id', $sub_student->student->id)->where('subject_id', $subs->subject_id)->get();
                                     $sarr1 = array();
                                     foreach ($sfseq as $vall) { array_push($sarr1, $vall->seq1);} $sseq1 = current($sarr1);
                                      ?>
                                    <input type="number" name="seq1" @if($subs->status == 1) readonly @endif value="{{ $sseq1 }}" id="f{{$sub_student->id }}{{$subs->subject_id }}" class="{{ (int)$sseq1 < 10 ? 'ss':'sp' }}" onchange="checkf{{ $sub_student->id }}{{ $subs->subject_id }}(event)"></td>
                                </form>
                            <td>
                                {{-- second sequence for sub-students --}}
                                <form action="" method="get" id="sms{{$sub_student->id }}{{$subs->subject_id }}">
                                    @csrf
                                    <input type="hidden" name="year" value="{{ $current_year->id }}">
                                    <input type="hidden" name="student" value="{{ $sub_student->student->id }}">
                                    <input type="hidden" name="subject" value="{{ $subs->subject_id }}">
                                    <input type="hidden" name="form" value="{{ $subs->form_id }}">
                                    <?php $sfseq2 = App\Firsttermresult::where('year_id',$current_year->id)
                                    ->where('student_id', $sub_student->student->id)->where('subject_id', $subs->subject_id)->get();
                                     $sarr2 = array();
                                     foreach ($sfseq2 as $svall) { array_push($sarr2, $svall->seq2);} $sseq2 = current($sarr2);
                                      ?>
                                    <input type="number" name="seq2"  @if($subs->status == 1) readonly @endif value="{{ $sseq2 }}" id="s{{$sub_student->id }}{{$subs->subject_id }}" class="{{ (int)$sseq2 < 10 ? 'ss':'sp' }}" onchange="checks{{ $sub_student->id }}{{ $subs->subject_id }}(event)"></td>
                                </form>
                            </td>
                        @endif
                        {{-- second term --}}
                        @if($second)
                        <td>
                            {{-- third sequence from sub-student --}}
                            <form action="" method="get" id="tsms{{$sub_student->id }}{{$subs->subject_id }}">
                                @csrf
                                <input type="hidden" name="year" value="{{ $current_year->id }}">
                                <input type="hidden" name="student" value="{{ $sub_student->student->id }}">
                                <input type="hidden" name="subject" value="{{ $subs->subject_id }}">
                                <input type="hidden" name="form" value="{{ $subs->form_id }}">
                                <?php $tseqs = App\Secondtermresult::where('year_id',$current_year->id)
                                ->where('student_id', $sub_student->student->id)->where('subject_id', $subs->subject_id)->get();
                                 $tsa1 = array();
                                 foreach ($tseqs as $ts1) { array_push($tsa1, $ts1->seq3);} $tseq1 = current($tsa1);
                                  ?>
                                <input type="number" name="seq3"  @if($subs->status == 1) readonly @endif value="{{ $tseq1 }}" id="tss{{$sub_student->id }}{{$subs->subject_id }}" class="{{ (int)$tseq1 < 10 ? 'ss':'sp' }}" onchange="checktss{{ $sub_student->id }}{{ $subs->subject_id }}(event)"></td>
                            </form>
                        <td>

                             {{-- four sequence from sub-student --}}
                             <form action="" method="get" id="fsms{{$sub_student->id }}{{$subs->subject_id }}">
                                @csrf
                                <input type="hidden" name="year" value="{{ $current_year->id }}">
                                <input type="hidden" name="student" value="{{ $sub_student->student->id }}">
                                <input type="hidden" name="subject" value="{{ $subs->subject_id }}">
                                <input type="hidden" name="form" value="{{ $subs->form_id }}">
                                <?php $fseqs4 = App\Secondtermresult::where('year_id',$current_year->id)
                                ->where('student_id', $sub_student->student->id)->where('subject_id', $subs->subject_id)->get();
                                 $fsa4 = array();
                                 foreach ($fseqs4 as $ts4) { array_push($fsa4, $ts4->seq4);} $fseq4 = current($fsa4);
                                  ?>
                                <input type="number" name="seq4"  @if($subs->status == 1) readonly @endif value="{{ $fseq4 }}" id="fss4{{$sub_student->id }}{{$subs->subject_id }}" class="{{ (int)$fseq4 < 10 ? 'ss':'sp' }}" onchange="checkfss4{{ $sub_student->id }}{{ $subs->subject_id }}(event)"></td>
                            </form>
                        </td>
                        @endif
                        {{-- third term --}}
                        @if($third)
                        <td>
                            {{-- firth sequence for subsequence --}}
                            <form action="" method="get" id="fseqq{{$sub_student->id }}{{$subs->subject_id }}">
                                @csrf
                                <input type="hidden" name="year" value="{{ $current_year->id }}">
                                <input type="hidden" name="student" value="{{ $sub_student->student->id }}">
                                <input type="hidden" name="subject" value="{{ $subs->subject_id }}">
                                <input type="hidden" name="form" value="{{ $subs->form_id }}">
                                <?php $fff = App\Thirdtermresult::where('year_id',$current_year->id)
                                ->where('student_id', $sub_student->student->id)->where('subject_id', $subs->subject_id)->get();
                                 $ffseq5 = array();
                                 foreach ($fff as $ff) { array_push($ffseq5, $ff->seq5);} $sq5f = current($ffseq5);
                                  ?>
                                <input type="number" name="seq5"  @if($subs->status == 1) readonly @endif value="{{ $sq5f }}" id="ssseq5{{$sub_student->id }}{{$subs->subject_id }}" class="{{ (int)$sq5f < 10 ? 'ss':'sp' }}" onchange="checkfsseq5{{ $sub_student->id }}{{ $subs->subject_id }}(event)"></td>
                            </form>
                        <td>
                            {{-- sith sequence for sub-students --}}
                            <form action="" method="get" id="sfseq6m{{$sub_student->id }}{{$subs->subject_id }}">
                                @csrf
                                <input type="hidden" name="year" value="{{ $current_year->id }}">
                                <input type="hidden" name="student" value="{{ $sub_student->student->id }}">
                                <input type="hidden" name="subject" value="{{ $subs->subject_id }}">
                                <input type="hidden" name="form" value="{{ $subs->form_id }}">
                                <?php $noel6 = App\Thirdtermresult::where('year_id',$current_year->id)
                                ->where('student_id', $sub_student->student->id)->where('subject_id', $subs->subject_id)->get();
                                 $noell = array();
                                 foreach ($noel6 as $s6) { array_push($noell, $s6->seq6);} $svar6 = current($noell);
                                  ?>
                                <input type="number" name="seq6"  @if($subs->status == 1) readonly @endif value="{{ $svar6 }}" id="sffseq6{{$sub_student->id }}{{$subs->subject_id }}" class="{{ (int)$svar6 < 10 ? 'ss':'sp' }}" onchange="checksfseq6{{ $sub_student->id }}{{ $subs->subject_id }}(event)"></td>
                            </form>
                        </td>
                        @endif
                        <script>
                            // first sequence for sub-student
                            function checkf{{ $sub_student->id }}{{ $subs->subject_id }}(ev){
                                console.log('the value', parseInt(ev.target.value));
                                var val = parseInt(ev.target.value);
                                if(val < 10){
                                    document.getElementById('f{{ $sub_student->id }}{{ $subs->subject_id }}').setAttribute('class', 'ss');
                                }
                                else {
                                    document.getElementById('f{{ $sub_student->id }}{{ $subs->subject_id }}').setAttribute('class', 'sp');
                                }
                                $(document).ready(function(){
                                    $.ajaxSetup({
                                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                                    });
                                    /* Submit form data using ajax*/
                                $.ajax({
                                    url: "{{ route('first.sequence.saves') }}",
                                    method: 'get',
                                    data: $('#fms{{$sub_student->id }}{{$subs->subject_id }}').serialize(),
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
                            function checks{{$sub_student->id }}{{$subs->subject_id }}(ev){
                                console.log('the value', parseInt(ev.target.value));
                                var val = parseInt(ev.target.value);
                                if(val < 10){
                                    document.getElementById('s{{$sub_student->id }}{{$subs->subject_id }}').setAttribute('class', 'ss');
                                } else {
                                    document.getElementById('s{{$sub_student->id }}{{$subs->subject_id }}').setAttribute('class', 'sp');
                                }
                                $(document).ready(function(){
                                    $.ajaxSetup({
                                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                                    });
                                    /* Submit form data using ajax*/
                                $.ajax({
                                    url: "{{ route('second.sequence.saves') }}",
                                    method: 'get',
                                    data: $('#sms{{$sub_student->id }}{{$subs->subject_id }}').serialize(),
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
                            function checktss{{$sub_student->id }}{{$subs->subject_id }}(ev){
                                console.log('the value', parseInt(ev.target.value));
                                var val = parseInt(ev.target.value);
                                if(val < 10){
                                    document.getElementById('tss{{$sub_student->id }}{{$subs->subject_id }}').setAttribute('class', 'ss');
                                } else {
                                    document.getElementById('tss{{$sub_student->id }}{{$subs->subject_id }}').setAttribute('class', 'sp');
                                }
                                $(document).ready(function(){
                                    $.ajaxSetup({
                                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                                    });
                                    /* Submit form data using ajax*/
                                $.ajax({
                                    url: "{{ route('third.sequence.saves') }}",
                                    method: 'get',
                                    data: $('#tsms{{$sub_student->id }}{{$subs->subject_id }}').serialize(),
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
                            function checkfss4{{$sub_student->id }}{{$subs->subject_id }}(ev){
                                console.log('the value', parseInt(ev.target.value));
                                var val = parseInt(ev.target.value);
                                if(val < 10){
                                    document.getElementById('fss4{{$sub_student->id }}{{$subs->subject_id }}').setAttribute('class', 'ss');
                                } else {
                                    document.getElementById('fss4{{$sub_student->id }}{{$subs->subject_id }}').setAttribute('class', 'sp');
                                }
                                $(document).ready(function(){
                                    $.ajaxSetup({
                                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                                    });
                                    /* Submit form data using ajax*/
                                $.ajax({
                                    url: "{{ route('fourth.sequence.saves') }}",
                                    method: 'get',
                                    data: $('#fsms{{$sub_student->id }}{{$subs->subject_id }}').serialize(),
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
                            function checkfsseq5{{$sub_student->id }}{{$subs->subject_id }}(ev){
                                console.log('the value', parseInt(ev.target.value));
                                var val = parseInt(ev.target.value);
                                if(val < 10){
                                    document.getElementById('ssseq5{{$sub_student->id }}{{$subs->subject_id }}').setAttribute('class', 'ss');
                                } else {
                                    document.getElementById('ssseq5{{$sub_student->id }}{{$subs->subject_id }}').setAttribute('class', 'sp');
                                }
                                $(document).ready(function(){
                                    $.ajaxSetup({
                                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                                    });
                                    /* Submit form data using ajax*/
                                $.ajax({
                                    url: "{{ route('firth.sequence.saves') }}",
                                    method: 'get',
                                    data: $('#fseqq{{$sub_student->id }}{{$subs->subject_id }}').serialize(),
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
                            function checksfseq6{{$sub_student->id }}{{$subs->subject_id }}(ev){
                                console.log('the value', parseInt(ev.target.value));
                                var val = parseInt(ev.target.value);
                                if(val < 10){
                                    document.getElementById('sffseq6{{$sub_student->id }}{{$subs->subject_id }}').setAttribute('class', 'ss');
                                } else {
                                    document.getElementById('sffseq6{{$sub_student->id }}{{$subs->subject_id }}').setAttribute('class', 'sp');
                                }
                                $(document).ready(function(){
                                    $.ajaxSetup({
                                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                                    });
                                    /* Submit form data using ajax*/
                                $.ajax({
                                    url: "{{ route('sixth.sequence.save') }}",
                                    method: 'get',
                                    data: $('#sfseq6m{{$sub_student->id }}{{$subs->subject_id }}').serialize(),
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
                 {{-- end students from sub class B --}}
