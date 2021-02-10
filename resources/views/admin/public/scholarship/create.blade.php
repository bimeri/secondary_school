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
        @if ($studentinfos->count() == 0)
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
                    <th colspan="2">Action</th>
                </tr>
                @foreach ($studentinfos as $key => $user)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td><?php $enroll = explode('/', trim($user->year->name)); ?>
                        <img src="{{ URL::asset('image/students/'.$enroll[0].'/'.$user->profile.'') }}" width="50" height="50" class="w3-circle w3-border-t">
                    </td>
                    <td>{{ $user->student->full_name }}</td>
                    <td>
                        <b class="green-text w3-tiny">{{ $user->form->name }}</b> {{ $user->subform_id ? ''.$user->subform->type.'':'A' }} <br><b class="blue-text w3-tiny">{{ $user->form->background->name }} </b> <br><b class="orange-text w3-tiny">{{ $user->form->background->sector->name }}</b>
                    </td>
                    <td>
                        @foreach(App\Scholarship::where('student_id', $user->student->id)->where('year_id', $current_year->id)->where('term_id', $current_term->id)->where('form_id', $user->form_id)->get() as $scholarship)
                            {{$scholarship->year->name}}
                        @endforeach
                    </td>
                    <td>{{ $user->student->email }}</td>
                    <td>{{ $user->student_school_id }}</td>
                    <td>{{ App\Scholarship::getStudentYearlyScholarship($current_year->id, $user->student->id, $current_term->id, $user->form_id)}}</td>
                    <td>
                        <?php $fees = App\Feetype::where('form_id', $user->form_id)->where('year_id', $current_year->id)->sum('amount');
                            echo $fees;
                        ?>
                        @if (App\Scholarship::where('student_id', $user->student->id)->where('year_id', $current_year->id)->where('term_id', $current_term->id)->where('form_id', $user->form_id)->exists())
                                <?php $am = App\Scholarship::where('student_id', $user->student->id)->where('year_id', $current_year->id)->where('term_id', $current_term->id)->where('form_id', $user->form_id)->first();
                                    echo '<br><b class="teal-text">Balance:</b> CFA '.($fees - $am->amount);
                                ?>
                        @endif
                    </td>
                        @if (App\Scholarship::where('student_id', $user->student->id)->where('year_id', $current_year->id)->where('term_id', $current_term->id)->where('form_id', $user->form_id)->exists())
                        <td>
                            <button class="w3-green w3-btn waves-light waves-effect w3-small">
                                <?php
                                $scholarship = App\Scholarship::where('student_id', $user->student->id)->where('year_id', $current_year->id)->where('term_id', $current_term->id)->where('form_id', $user->form_id)->first();
                                    echo 'Given: CFA '.$scholarship->amount.'';
                                 ?>
                            </button>
                        </td>
                        <td>
                            <form action="{{ route('scholarship.cancel') }}" method="post" id="form{{ $key + 1 }}">
                            @csrf
                            <input type="hidden" name="class" value="{{ $user->form_id }}" />
                            <input type="hidden" name="year" value="{{  $current_year->id }}" />
                            <input type="hidden" name="student_id" value="{{ $user->student->id }}" />
                            <input type="hidden" name="term" value="{{  $current_term->id }}" />
                            <button class="red btn waves-light waves-effect w3-tiny" onclick="dismiss{{ $key + 1 }}()" id="btn-submit{{ $key + 1 }}"> cancil scholarship <i class="fa fa-times w3-small"></i></button>
                         </form>
                         @include('admin.public.includes.alert.cancel_scholarship')
                        </td>
                        @else
                        <td>
                            <button class="blue btn waves-light waves-effect w3-tiny modal-trigger" href="#modal{{ $key + 1 }}"> Scholarship <i class="fa fa-graduation-cap w3-small"></i></button>
                        </td>
                        @endif
                </tr>
                @include('admin.public.includes.modal.scholarship')
                @endforeach
            </table>
        </div>
            {{ $studentinfos->onEachSide(5)->links() }}
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
