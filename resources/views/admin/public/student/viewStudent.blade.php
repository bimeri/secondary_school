@extends('admin.layout')
@section('title') View Student @endsection
@section('style')
<style>

    td, th, tr{
        border: 1px solid #ccc !important;
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
    <form method="get" action="{{ route('student.get') }}">
        @csrf
        <div class="row">
            <div class="input-field col m3 offset-m3 s12">
                <select name="year" class="validate">
                    <option value="{{ Crypt::encrypt($years->id) }}">{{ $years->name }}</option>
                    @foreach (App\Year::all() as $year)
                        <option value="{{ Crypt::encrypt($years->id) }}">{{ $year->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-field col m3 s12">
                <select name="class" id="class">
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
        @if ($students->count() == 0)
        <div class="red lighten-4 red-text w3-padding w3-border w3-center bold">No record found, please search again</div>
        @endif
        <div class="col s6 m2 right topnav">
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
                    <th>email</th>
                    <th>School ID Number</th>
                    <th>gender</th>
                    <th>date of birth</th>
                    <th colspan="2">Action</th>
                </tr>
                @foreach ($students as $key => $user)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>
                        <?php $enroll = explode('/', trim($user->year->name)); ?>
                        <img src="{{ URL::asset('image/students/'.$enroll[1].'/'.$user->profile.'') }}" width="50" height="50" class="w3-circle w3-border-t">
                    </td>
                    <td>
                        {{ $user->student->full_name }}
                    </td>
                    <td>
                        <b>{{ $user->form->name }} {{ $user->subform_id ? $user->subform->type:'A' }} </b> /{{ $user->form->background->name }}/{{ $user->form->background->sector->name }}
                    </td>
                    <td>
                        {{ $user->student->email }}
                    </td>
                    <td>{{ $user->student_school_id }}</td>
                    <td>
                        {{ $user->gender }}
                    </td>
                    <td>
                        {{ $user->date_of_birth }}
                    </td>
                    <td>
                    <button class="my-orange btn waves-light waves-effect">Edit <i class="fa fa-pencil-alt w3-small"></i></button>
                    </td>
                    <td>
                    <button class="red btn waves-light waves-effect" disabled>Delete <i class="fa fa-trash w3-small"></i></button>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
            {{ $students->onEachSide(5)->links() }}
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
