@extends('admin.layout')
@section('title') Collect fees @endsection
@section('style')
<style>
    td, th, tr{
        border-collapse: collapse;
        border: 1px solid #ccc !important;
        font-size: 11px !important
    }
</style>
@stop
@section('content')
<p class="w3-center">@lang('messages.welcome')</p>
<div class="row col">
<h5 class="left w3-padding">Collect Fees for Acdemic Year <b>{{ $current_year->name }}</b></h5>
</div>
<div class="row" style="margin-top: -20px">
    <form method="get" action="{{ route('student.get.all') }}">
        @csrf
        <div class="row">
            <div class="input-field col m3 offset-m3 s12">
                <select name="year" class="validate">
                    <option value="{{ Crypt::encrypt($year->id) }}" selected>{{ $year->name }}</option>
                    @foreach ($all_year as $y)
                        <option value="{{ Crypt::encrypt($y->id) }}">{{ $y->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-field col m3 s12">
                <select name="class" id="class" required>
                    <option value="" disabled selected> Class / Background / Sector</option>
                  @foreach (App\Form::all() as $form)
                    <option value="{{ Crypt::encrypt($form->id) }}">{{ $form->name }}  / {{ $form->background->name }} / {{ $form->background->sector->name }}</option>
                  @endforeach
                </select>
                <label for="class">Select the class</label>
            </div>
            <div class="col m2 offset-s3 m3" style="margin-top: 20px !important">
                <button class="btn btn-primary waves-effect waves-light">Get Students</button>
            </div>
        </div>
    </form>

    <div class="col s11 m10 w3-border-t offset-m1 w3-padding white w3-margin-bottom radius w3-margin-left" style="margin-top: -13px">
        <div class="col s6 m2 right topnav" style="margin-right: 10px !important">
            <input type="text" placeholder="Search school ID..." onkeyup="myFunctionn()" id="myInputt">
            <i class="fa fa-search right w3-large teal-text search"></i>
        </div>
        <div class="col s6 m2 right topnav" style="margin-right: 10px !important">
            <input type="text" placeholder="Search Name..." onkeyup="myFunction()"  id="myInput">
            <i class="fa fa-search right w3-large teal-text search"></i>
        </div>
        <div class="col s12 m12" style="overflow-x:scroll !important;">
            <table id="myTable" class="w3-table w3-striped w3-border-t" style="font-size: 13px !important;">
                @if(Session::has('notify'))
                <tr>
                    <td colspan="13" class="w3-medium">
                        <div class="alert alert-danger" role="alert">
                            {!! session::get('notify') !!}
                            {{ session::forget('notify') }}
                        </div>
                    </td>
                </tr>
                @endif
                <tr>
                    @if($students->count() != 0 && $form_name)
                        <td colspan="13" class="center yellow lighten-4 w3-medium">
                            Form Code: <b>{{ $form_name->code ?? '' }}</b> | form Name: <b>{{ $form_name->name ?? '' }}</b> | Form Background Name: <b>{{ $form_name->background->name ?? ''}}</b> | Sector Name: <b>{{ $form_name->background->sector->name ?? ''}}</b>
                        </td>
                    @endif
                </tr>
                <tr class="teal">
                    <th>S/N</th>
                    <th>profile</th>
                    <th>year</th>
                    <th>Full Name</th>
                    <th>Class</th>
                    <th>sector/background</th>
                    <th>School ID Number</th>
                    <th>Total Fees/ XCFA</th>
                    <th>Scholarship given</th>
                    <th>Amount Paid</th>
                    <th colspan="2">Action</th>
                </tr>
                @foreach ($students as $key => $user)
                <?php $uid = App\Student::where('school_id', $user->student_school_id)->first(); ?>
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>
                        <?php $enroll = explode('/', trim($user->year->name)); ?>
                        <img src="{{ URL::asset('image/students/'.$enroll[1].'/'.$user->profile.'') }}" width="50" height="50" class="w3-circle w3-border-t">
                    </td>
                    <td>
                        {{ $user->year->name }}
                    </td>
                    <td>
                        {{ $user->student->full_name }}
                    </td>
                    <td>
                        <b class="green-text w3-tiny">{{ $user->form->name }}</b> {{ $user->subform_id ? ''.$user->subform->type.'':'A' }}
                    </td>
                    <td>
                       <b class="blue-text w3-tiny">{{ $user->form->background->sector->name }}</b>/<b class="orange-text w3-tiny">{{ $user->form->background->name }}</b>
                    </td>
                    <td>{{ $user->student_school_id }}</td>
                    <td>
                        <?php $fees = App\Feetype::where('form_id', $user->form_id)->where('year_id', $current_year->id)->sum('amount');
                            echo $fees;
                        ?>
                    </td>
                    <td>
                        @if (App\Scholarship::where('student_id', $user->student_id)->where('year_id', $current_year->id)->where('term_id', $current_term->id)->where('form_id', $user->form_id)->exists())
                        <?php $am = App\Scholarship::where('student_id', $user->student_id)->where('year_id', $current_year->id)->where('term_id', $current_term->id)->where('form_id', $user->form_id)->first();
                            echo 'CFA '.( $am->amount);
                        ?>
                        @endif
                    </td>
                    <td>
                        <?php
                        $amount = App\Fee::where('year_id', $current_year->id)->where('student_school_id', $user->student_school_id)->sum('amount');
                        $scholarship = App\Fee::where('year_id', $current_year->id)->where('student_school_id', $user->student_school_id)->sum('scholarship');

                        echo $amount + $scholarship;
                         ?>
                    </td>

                    <td>
                        <button class="w3-blue w3-btn waves-light waves-effect w3-small modal-trigger" href="#modal{{ $key + 1 }}"> Collect Fees <i class="fa fa-dollar-sign w3-small"></i></button>
                    </td>
                    <td>
                        <form action="{{ route('student_fee_statistics') }}" method="get">
                            @csrf
                            <input type="hidden" name="student_school_id" value="{{ $user->student_school_id }}">
                            <input type="hidden" name="year_id" value="{{ $current_year->id }}">
                            <input type="hidden" name="form_id" value="{{ $user->form_id }}">
                        <button class="w3-orange w3-text-white w3-btn waves-light waves-effect w3-small"> Fees Statistics </button>
                        </form>
                    </td>
                </tr>

                <div id="modal{{ $key + 1 }}" class="modal modal-fixed-footer" style="width: 80% !important">
                    <div class="modal-content">
                      <h4 class="w3-center teal-text">Fill the form to collect fees from student<br>
                        @foreach (App\Student::where('school_id', $user->student_school_id)->get() as $info)
                       <b class="blue-text upper"> {{ $info->full_name }}({{ $user->student_school_id }})</b>
                        @endforeach
                    </h4>
                    <?php
                        $f = App\Feetype::SumClassFeePerYear($user->form_id, $current_year->id);
                            echo "<div class='col left' id='fee_change".($key+1)."'><b>Total Fee: ".$f."</b> CFA</div>";
                    ?>
                    @if (App\Scholarship::getStudentAcademicScholarship($user->student_id, $current_year->id, $current_term->id, $user->form_id))
                    <?php
                    $am = App\Scholarship::getStudentAcademicScholarship($user->student_id, $current_year->id, $current_term->id, $user->form_id);
                        echo "<div class='right'><b class='blue-text w3-small capitalize'>Student have scholarship of: </b>".( $am->amount)." CFA</div>";
                    ?>
                    @endif
                    <br><br>
                      <hr style="border-top: 1px solid orange">
                        <div class="row">
                            <form action="{{ route('student.fee.collect') }}" method="post" id="form{{$key+1}}">
                                @csrf
                                <div class="row">
                                    <?php $sc = App\Scholarship::getStudentAcademicScholarship($user->student_id, $current_year->id, $current_term->id, $user->form_id); ?>
                                    <input type="hidden" name="scholarship" value="{{ $sc->amount ?? '' }}">
                                    <input type="hidden" name="student_id" value="{{ $user->student_id }}">
                                    <input type="hidden" name="student_schoold_id" value="{{ $user->student_school_id }}">
                                    <input type="hidden" name="form_id" value="{{ $user->form_id }}">
                                    <div class="col s12 m3">
                                        <label for="year">select year</label>
                                        <select name="year" class="browser-default chosen-select form-control dynamic" id="year{{$key+1}}" data-dependent="type{{$key+1}}" required>
                                            {{-- <option value="" selected>select the year</option> --}}
                                            <option value="{{ $current_year->id }}">{{ $current_year->name }}</option>
                                            @foreach (App\Year::where('active', '!=', 1)->get() as $year)
                                                <option value="{{ $year->id }}">{{ $year->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col s12 m4">
                                        <?php $currentFeeData = App\Feetype::getCurrentYearformFee($current_year->id, $user->form_id);
                                         ?>
                                        <label for="type">select fees type</label>
                                        <select name="feetype" class="browser-default form-control" id="type{{$key+1}}" required>
                                        @foreach ($currentFeeData as $cc)
                                            {!! $cc !!}
                                        @endforeach
                                        </select>
                                    </div>
                                    <div class="col s12 m2 input-field">
                                        <input type="number" name="amount" placeholder="enter amount" required>
                                    </div>
                                    <div class="col s12 m3 input-field">
                                        <input id="autocompleteChannel" name="method" class="autocompleteChannel" placeholder="Enter the method of Payment ..."/>
                                    </div>
                                </div>

                                <div class="col s6 m3 offset-m4 offset-s3 w3-center" style="margin-top: 4px !important">
                                    <button class="btn teal waves-effect waves-light w3-small" type="submit">Save Record</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="modal-close red waves-effect waves-green btn-flat right white-text">Cancel</button>
                    </div>
                </div>
                <script>
    $('#year{{$key+1}}').on('change', function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    var data = $('#form{{$key+1}}').serialize();
    var semesterid = $(this).val();
    if(semesterid){
        $.ajax({
           type:"POST",
           url:"{{route('year.getfeetype')}}",
           data: $('#form{{$key+1}}').serialize(),
           success:function(res){
            $("#fee_change{{$key+1}}").empty();
               console.log('the response is: ',res);
               $("#fee_change{{$key+1}}").append("<b>Total Fee: "+res.sum+"</b> CFA ");
            if(res){
                $("#type{{$key+1}}").empty();
                // $.each(res,function(key, value){
                    // console.log('the id is: ', value.id);
                    // console.log('the name is: ', value.feetype);
                    // console.log('the amount is: ', value.amount);
                   $("#type{{$key+1}}").append(res.option);
                // });
            }else{
               $("#type{{$key+1}}").empty();
            }
           },
           error: function(error){
               console.log('an error: ', error);
           }
        });
    }else{
        $("#type{{$key+1}}").empty();
    }

   });
</script>
                @endforeach
                <tr>
                    @if($students->count() == 0)
                        <td colspan="13" class="center red lighten-4 w3-medium red-text">
                            <b>There is No Enrolled student in the class you just entered</b>
                        </td>
                    @endif
                </tr>
            </table>
        </div>
            {{-- {{ $students->onEachSide(5)->links() }} --}}
    </div>
</div>

<script>
    function myFunction() {
      // Declare variables
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");
      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[3];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }
    function myFunctionn() {
      // Declare variables
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInputt");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");
      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[6];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }
</script>
@endsection
