@extends('admin.layout')
@section('title') Scholarship @endsection
@section('style')
<style>
    .st{
        font-size: 13px !important;
        color: white;
        border: none;
    }
    td, th, tr{
        border: .5px solid #ccc !important;
        font-size: 11px !important
    }
    .under{
        border-bottom: double 3px;
        /* text-decoration: underline double; */
    }
    .tt:hover{
        background-color: rgb(187, 231, 231);
    }
</style>
@stop
@section('content')
<p class="w3-center">@lang('messages.welcome')</p>

<div class="row w3-margin-top">
    <form method="get" action="{{ route('scholarship.students.get') }}">
        @csrf
        <div class="row">
            <div class="input-field col m3 offset-m3 s12">
                <select name="year" class="validate">
                    <option value="{{$current_year->id}}" selected>{{$current_year->name}}</option>
                    @foreach (App\Year::all() as $year)
                        <option value="{{ $year->id }}">{{ $year->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-field col m3 s12">
                <select name="class" id="class">
                    <option value="" disabled selected> Class / Background / Sector</option>
                  @foreach (App\Form::all() as $form)
                    <option value="{{ $form->id }}">{{ $form->name }}  / {{ $form->background->name }} / {{ $form->background->sector->name }}</option>
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
        @if ($students->count() == 0)
        <div class="red lighten-4 red-text w3-padding w3-border w3-center bold">No record found, please search again</div>
        @endif
        <div class="col s6 m2 right topnav">
            <input type="text" placeholder="Search Class..." onkeyup="myFunctions()" id="myInputs">
            <i class="fa fa-search right w3-large teal-text search"></i>
        </div>
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
                <tr class="teal">
                    <th>S/N</th>
                    <th>profile</th>
                    <th>Full Name</th>
                    <th>Class</th>
                    <th>Year</th>
                    <th>email</th>
                    <th>School ID Number</th>
                    <th>Scholarship Amount</th>
                    <th>Total Fees/ XCFA</th>
                    <th>Action</th>
                </tr>
                @foreach ($students as $key => $user)
                <?php $uid = App\Student::where('school_id', $user->student_school_id)->first();?>
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>
                        <?php $enroll = explode('/', trim($user->year->name)); ?>
                        <img src="{{ URL::asset('image/students/'.$enroll[1].'/'.$user->profile.'') }}" width="50" height="50" class="w3-circle w3-border-t">
                    </td>
                    <td>
                        @foreach (App\Student::where('school_id', $user->student_school_id)->get() as $info)
                        {{ $info->full_name }}
                        @endforeach
                    </td>
                    <td>
                        @foreach (App\Form::where('id', $user->form_id)->get() as $form)
                            <b class="green-text w3-tiny">{{ $form->name }}</b> {{ $user->subform_id ? ''.$user->subform->type.'':'A' }} <br><b class="blue-text w3-tiny">{{ $form->background->name }} </b> <br><b class="orange-text w3-tiny">{{ $form->background->sector->name }}</b>
                        @endforeach
                    </td>
                    <td>
                        @foreach(App\Scholarship::where('student_id', $uid->id)->where('year_id', $current_year->id)->where('term_id', $current_term->id)->where('form_id', $user->form_id)->get() as $scholarship)
                            {{$scholarship->year->name}}
                        @endforeach
                    </td>
                    <td>
                        @foreach (App\Student::where('school_id', $user->student_school_id)->get() as $info)
                        {{ $info->email }}
                        @endforeach
                    </td>
                    <td>{{ $user->student_school_id }}</td>
                    <td>
                        <?php $amm = App\Scholarship::where('student_id', $uid->id)->where('year_id', $current_year->id)->where('term_id', $current_term->id)->where('form_id', $user->form_id)->get();?>
                       @foreach ($amm as $amt)
                       {{ $amt->amount }}
                       @endforeach
                    </td>
                    <td>
                        <?php $fees = App\Feetype::where('form_id', $user->form_id)->where('year_id', $current_year->id)->sum('amount');
                            echo $fees;
                        ?>
                        @if (App\Scholarship::where('student_id', $uid->id)->where('year_id', $current_year->id)->where('term_id', $current_term->id)->where('form_id', $user->form_id)->exists())
                                <?php $am = App\Scholarship::where('student_id', $uid->id)->where('year_id', $current_year->id)->where('term_id', $current_term->id)->where('form_id', $user->form_id)->first();
                                    echo '<br><b class="teal-text">Balance:</b> CFA '.($fees - $am->amount);
                                ?>
                        @endif
                    </td>
                    <td>
                        @if (App\Scholarship::where('student_id', $uid->id)->where('year_id', $current_year->id)->where('term_id', $current_term->id)->where('form_id', $user->form_id)->exists())
                            <button class="w3-green w3-btn waves-light waves-effect w3-small">
                                <?php
                                $scholarship = App\Scholarship::where('student_id', $uid->id)->where('year_id', $current_year->id)->where('term_id', $current_term->id)->where('form_id', $user->form_id)->first();
                                    echo 'Given: CFA '.$scholarship->amount.'';
                                 ?>
                            </button>
                        @else
                            <button class="blue btn waves-light waves-effect w3-tiny modal-trigger" href="#modal{{ $key + 1 }}"> Scholarship <i class="fa fa-graduation-cap w3-small"></i></button>
                        @endif
                    </td>
                </tr>

                <div id="modal{{ $key + 1 }}" class="modal modal-fixed-footer" style="width: 80% !important">
                    <div class="modal-content">
                      <h4 class="w3-center teal-text">Fill the form to Give Student Scholarship award.<br>
                        @foreach (App\Student::where('school_id', $user->student_school_id)->get() as $info)
                       <b class="blue-text"> ({{ $info->full_name }} :: {{ $user->student_school_id }})</b>
                        @endforeach

                    </h4>
                      <hr style="border-top: 1px solid orange">
                        <div class="row">
                            <form action="{{ route('scholarship.student.create') }}" method="post">
                                @csrf
                                <div class="row">
                                    <?php $uid = App\Student::where('school_id', $user->student_school_id)->first(); ?>
                                    <input type="hidden" name="student_id" value="{{ $uid->id }}">
                                    <div class="col s12 m2 offset-m1">
                                        <select name="year" class="browser-default">
                                            <option value="{{ $current_year->id }}" selected>{{ $current_year->name }}</option>
                                            @foreach (App\Year::where('active', '!=', 1)->get() as $year)
                                                <option value="{{ $year->id }}">{{ $year->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col s12 m2">
                                        <select name="term" class="browser-default">
                                            <option value="{{ $current_term->id }}" selected>{{ $current_term->name }}</option>
                                            @foreach (App\Term::where('active', '!=', 1)->get() as $term)
                                                <option value="{{ $term->id }}">{{ $term->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                     <div class="col s12 m4">
                                        <select name="class" class="browser-default">
                                            <option value="{{ $user->form_id }}">
                                                @foreach (App\Form::where('id', $user->form_id)->get() as $form)
                                                    <option value="{{ $form->id }}" selected>{{ $form->name }} / {{ $form->background->name }} / {{ $form->background->sector->name }}</option>
                                                @endforeach
                                            </option>
                                                @foreach (App\Form::all() as $form)
                                                    <option value="{{ $form->id }}">{{ $form->name }} / {{ $form->background->name }} / {{ $form->background->sector->name }}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                    <div class="col s12 m2">
                                        <input type="number" name="amount" placeholder="enter amount">
                                    </div>
                                </div>
                                <div class="col s12 m6 offset-m3 input-field">
                                    <textarea id="reason" name="reason" class="materialize-textarea" placeholder="spend money on this because of ..."></textarea>
                                    <label for="reason">Reason</label>
                                </div>
                                <div class="col s6 m3 offset-m4 offset-s3 w3-center" style="margin-top: 4px !important">
                                    <button class="btn teal waves-effect waves-light w3-small" type="submit">Give Scholarship</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="modal-close red waves-effect waves-green btn-flat right white-text">Cancel</button>
                    </div>
                </div>
                @endforeach
            </table>
        </div>
            {{ $students->onEachSide(5)->links() }}
    </div>
</div>

<script>
    function myFunctions() {
      // Declare variables
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInputs");
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
    function myFunction() {
      // Declare variables
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");
      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[2];
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
        td = tr[i].getElementsByTagName("td")[5];
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
