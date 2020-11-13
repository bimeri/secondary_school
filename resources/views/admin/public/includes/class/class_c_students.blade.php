                 {{-- students from sub class C --}}
                 @if($c_students->count() > 0)
                 <tr class="teal-text center bold" style="background-color: rgb(169, 238, 238)"><td colspan="20">All Student from Sub class <b class="text-black">C</b> of @if($class != []) {{ $class->name }}-{{ $class->background->name }}-{{ $class->background->sector->name }} <em class="right w3-medium">{{ $class->name }} C</em>@endif</td></tr>
                 @endif
                 @foreach ($c_students as $key => $c_student)
                 <tr>
                     <td><b class="left">{{ $key + 1 }}. {{ $c_student->student->full_name }} - <?php $c_s = App\Subclass::where('id',  $c_student->subform_id)->first(); echo $c_s->type;?></b> <em class="right">{{ $c_student->student->school_id }}</em></td>

                     @foreach ($subjects as $s => $c_subject)
                     {{-- first term --}}
                         @if($first)
                             <td>
                                 {{-- first sequence for sub-c-student --}}
                                 <form action="" method="get" id="c_stud_form{{$c_student->id }}{{$c_subject->id }}">
                                     @csrf
                                     <input type="hidden" name="year" value="{{ $current_year->id }}">
                                     <input type="hidden" name="student" value="{{ $c_student->student->id }}">
                                     <input type="hidden" name="subject" value="{{ $c_subject->id }}">
                                     <input type="hidden" name="form" value="{{ $c_subject->form->id }}">
                                     <?php $c_stud1 = App\Firsttermresult::where('year_id',$current_year->id)
                                     ->where('student_id', $c_student->student->id)->where('subject_id', $c_subject->id)->get();
                                      $c_stud1_arr = array();
                                      foreach ($c_stud1 as $c1_val) { array_push($c_stud1_arr, $c1_val->seq1);} $c_seq1 = current($c_stud1_arr);
                                       ?>
                                     <input type="number" name="seq1" value="{{ $c_seq1 }}" id="c1{{$c_student->id }}{{$c_subject->id }}" class="{{ (int)$c_seq1 < 10 ? 'ss':'sp' }}" onchange="bClass1{{ $c_student->id }}{{ $c_subject->id }}(event)"></td>
                                 </form>
                             <td>
                                 {{-- second sequence for sub-students --}}
                                 <form action="" method="get" id="c_stud_form2{{$c_student->id }}{{$c_subject->id }}">
                                     @csrf
                                     <input type="hidden" name="year" value="{{ $current_year->id }}">
                                     <input type="hidden" name="student" value="{{ $c_student->student->id }}">
                                     <input type="hidden" name="subject" value="{{ $c_subject->id }}">
                                     <input type="hidden" name="form" value="{{ $c_subject->form->id }}">
                                     <?php $cc2 = App\Firsttermresult::where('year_id',$current_year->id)
                                     ->where('student_id', $c_student->student->id)->where('subject_id', $c_subject->id)->get();
                                      $n1 = array();
                                      foreach ($cc2 as $v1) { array_push($n1, $v1->seq2);} $cval2 = current($n1);
                                       ?>
                                     <input type="number" name="seq2" value="{{ $cval2 }}" id="c2{{$c_student->id }}{{$c_subject->id }}" class="{{ (int)$cval2 < 10 ? 'ss':'sp' }}" onchange="c_stud_two{{ $c_student->id }}{{ $c_subject->id }}(event)"></td>
                                 </form>
                             </td>
                         @endif
                         {{-- second term --}}
                         @if($second)
                         <td>
                             {{-- third sequence from sub-student C class --}}
                             <form action="" method="get" id="c_third{{$c_student->id }}{{$c_subject->id }}">
                                 @csrf
                                 <input type="hidden" name="year" value="{{ $current_year->id }}">
                                 <input type="hidden" name="student" value="{{ $c_student->student->id }}">
                                 <input type="hidden" name="subject" value="{{ $c_subject->id }}">
                                 <input type="hidden" name="form" value="{{ $c_subject->form->id }}">
                                 <?php $cc3 = App\Secondtermresult::where('year_id',$current_year->id)
                                 ->where('student_id', $c_student->student->id)->where('subject_id', $c_subject->id)->get();
                                  $c3_arr = array();
                                  foreach ($cc3 as $c3_val) { array_push($c3_arr, $c3_val->seq3);} $c_three = current($c3_arr);
                                   ?>
                                 <input type="number" name="seq3" value="{{ $c_three }}" id="c3{{$c_student->id }}{{$c_subject->id }}" class="{{ (int)$c_three < 10 ? 'ss':'sp' }}" onchange="c_third{{ $c_student->id }}{{ $c_subject->id }}(event)"></td>
                             </form>
                         <td>

                              {{-- four sequence from sub-student --}}
                              <form action="" method="get" id="c4_form{{$c_student->id }}{{$c_subject->id }}">
                                 @csrf
                                 <input type="hidden" name="year" value="{{ $current_year->id }}">
                                 <input type="hidden" name="student" value="{{ $c_student->student->id }}">
                                 <input type="hidden" name="subject" value="{{ $c_subject->id }}">
                                 <input type="hidden" name="form" value="{{ $c_subject->form->id }}">
                                 <?php $cc4 = App\Secondtermresult::where('year_id',$current_year->id)
                                 ->where('student_id', $c_student->student->id)->where('subject_id', $c_subject->id)->get();
                                  $c4_arr = array();
                                  foreach ($cc4 as $c_four) { array_push($c4_arr, $c_four->seq4);} $c4_val = current($c4_arr);
                                   ?>
                                 <input type="number" name="seq4" value="{{ $c4_val }}" id="c4{{$c_student->id }}{{$c_subject->id }}" class="{{ (int)$c4_val < 10 ? 'ss':'sp' }}" onchange="c4_four{{ $c_student->id }}{{ $c_subject->id }}(event)"></td>
                             </form>
                         </td>
                         @endif
                         {{-- third term --}}
                         @if($third)
                         <td>
                             {{-- firth sequence for c_subjectequence --}}
                             <form action="" method="get" id="c4_form{{$c_student->id }}{{$c_subject->id }}">
                                 @csrf
                                 <input type="hidden" name="year" value="{{ $current_year->id }}">
                                 <input type="hidden" name="student" value="{{ $c_student->student->id }}">
                                 <input type="hidden" name="subject" value="{{ $c_subject->id }}">
                                 <input type="hidden" name="form" value="{{ $c_subject->form->id }}">
                                 <?php $c5_func = App\Thirdtermresult::where('year_id',$current_year->id)
                                 ->where('student_id', $c_student->student->id)->where('subject_id', $c_subject->id)->get();
                                  $c5_arr = array();
                                  foreach ($c5_func as $c5_Var) { array_push($c5_arr, $c5_Var->seq5);} $c5_val = current($c5_arr);
                                   ?>
                                 <input type="number" name="seq5" value="{{ $c5_val }}" id="c5{{$c_student->id }}{{$c_subject->id }}" class="{{ (int)$c5_val < 10 ? 'ss':'sp' }}" onchange="c5_five{{ $c_student->id }}{{ $c_subject->id }}(event)"></td>
                             </form>
                         <td>
                             {{-- sith sequence for sub-students --}}
                             <form action="" method="get" id="c6_form{{$c_student->id }}{{$c_subject->id }}">
                                 @csrf
                                 <input type="hidden" name="year" value="{{ $current_year->id }}">
                                 <input type="hidden" name="student" value="{{ $c_student->student->id }}">
                                 <input type="hidden" name="subject" value="{{ $c_subject->id }}">
                                 <input type="hidden" name="form" value="{{ $c_subject->form->id }}">
                                 <?php $c6_var = App\Thirdtermresult::where('year_id',$current_year->id)
                                 ->where('student_id', $c_student->student->id)->where('subject_id', $c_subject->id)->get();
                                  $c6_arr = array();
                                  foreach ($c6_var as $c6_va) { array_push($c6_arr, $c6_va->seq6);} $c6_val = current($c6_arr);
                                   ?>
                                 <input type="number" name="seq6" value="{{ $c6_val }}" id="c6{{$c_student->id }}{{$c_subject->id }}" class="{{ (int)$c6_val < 10 ? 'ss':'sp' }}" onchange="c6_six{{ $c_student->id }}{{ $c_subject->id }}(event)"></td>
                             </form>
                         </td>
                         @endif
                         <script>
                             // first sequence for sub-student
                             function bClass1{{ $c_student->id }}{{ $c_subject->id }}(ev){
                                 console.log('the value', parseInt(ev.target.value));
                                 var val = parseInt(ev.target.value);
                                 if(val < 10){
                                     document.getElementById('c1{{ $c_student->id }}{{ $c_subject->id }}').setAttribute('class', 'ss');
                                 }
                                 else {
                                     document.getElementById('c1{{ $c_student->id }}{{ $c_subject->id }}').setAttribute('class', 'sp');
                                 }
                                 $(document).ready(function(){
                                     $.ajaxSetup({
                                         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                                     });
                                     /* Submit form data using ajax*/
                                 $.ajax({
                                     url: "{{ route('first.sequence.save') }}",
                                     method: 'get',
                                     data: $('#c_stud_form{{$c_student->id }}{{$c_subject->id }}').serialize(),
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
                             function c_stud_two{{$c_student->id }}{{$c_subject->id }}(ev){
                                 console.log('the value', parseInt(ev.target.value));
                                 var val = parseInt(ev.target.value);
                                 if(val < 10){
                                     document.getElementById('c2{{$c_student->id }}{{$c_subject->id }}').setAttribute('class', 'ss');
                                 } else {
                                     document.getElementById('c2{{$c_student->id }}{{$c_subject->id }}').setAttribute('class', 'sp');
                                 }
                                 $(document).ready(function(){
                                     $.ajaxSetup({
                                         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                                     });
                                     /* Submit form data using ajax*/
                                 $.ajax({
                                     url: "{{ route('second.sequence.save') }}",
                                     method: 'get',
                                     data: $('#c_stud_form2{{$c_student->id }}{{$c_subject->id }}').serialize(),
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
                             function c_third{{$c_student->id }}{{$c_subject->id }}(ev){
                                 console.log('the value', parseInt(ev.target.value));
                                 var val = parseInt(ev.target.value);
                                 if(val < 10){
                                     document.getElementById('c3{{$c_student->id }}{{$c_subject->id }}').setAttribute('class', 'ss');
                                 } else {
                                     document.getElementById('c3{{$c_student->id }}{{$c_subject->id }}').setAttribute('class', 'sp');
                                 }
                                 $(document).ready(function(){
                                     $.ajaxSetup({
                                         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                                     });
                                     /* Submit form data using ajax*/
                                 $.ajax({
                                     url: "{{ route('third.sequence.save') }}",
                                     method: 'get',
                                     data: $('#c_third{{$c_student->id }}{{$c_subject->id }}').serialize(),
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
                             function c4_four{{$c_student->id }}{{$c_subject->id }}(ev){
                                 console.log('the value', parseInt(ev.target.value));
                                 var val = parseInt(ev.target.value);
                                 if(val < 10){
                                     document.getElementById('c4{{$c_student->id }}{{$c_subject->id }}').setAttribute('class', 'ss');
                                 } else {
                                     document.getElementById('c4{{$c_student->id }}{{$c_subject->id }}').setAttribute('class', 'sp');
                                 }
                                 $(document).ready(function(){
                                     $.ajaxSetup({
                                         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                                     });
                                     /* Submit form data using ajax*/
                                 $.ajax({
                                     url: "{{ route('fourth.sequence.save') }}",
                                     method: 'get',
                                     data: $('#c4_form{{$c_student->id }}{{$c_subject->id }}').serialize(),
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
                             function c5_five{{$c_student->id }}{{$c_subject->id }}(ev){
                                 console.log('the value', parseInt(ev.target.value));
                                 var val = parseInt(ev.target.value);
                                 if(val < 10){
                                     document.getElementById('c5{{$c_student->id }}{{$c_subject->id }}').setAttribute('class', 'ss');
                                 } else {
                                     document.getElementById('c5{{$c_student->id }}{{$c_subject->id }}').setAttribute('class', 'sp');
                                 }
                                 $(document).ready(function(){
                                     $.ajaxSetup({
                                         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                                     });
                                     /* Submit form data using ajax*/
                                 $.ajax({
                                     url: "{{ route('firth.sequence.save') }}",
                                     method: 'get',
                                     data: $('#c4_form{{$c_student->id }}{{$c_subject->id }}').serialize(),
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
                             function c6_six{{$c_student->id }}{{$c_subject->id }}(ev){
                                 console.log('the value', parseInt(ev.target.value));
                                 var val = parseInt(ev.target.value);
                                 if(val < 10){
                                     document.getElementById('c6{{$c_student->id }}{{$c_subject->id }}').setAttribute('class', 'ss');
                                 } else {
                                     document.getElementById('c6{{$c_student->id }}{{$c_subject->id }}').setAttribute('class', 'sp');
                                 }
                                 $(document).ready(function(){
                                     $.ajaxSetup({
                                         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                                     });
                                     /* Submit form data using ajax*/
                                 $.ajax({
                                     url: "{{ route('sith.sequence.save') }}",
                                     method: 'get',
                                     data: $('#c6_form{{$c_student->id }}{{$c_subject->id }}').serialize(),
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
                  {{-- end students from sub class C --}}
