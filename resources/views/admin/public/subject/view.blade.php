@extends('admin.layout')
@section('title') Create Subject @endsection
@section('content')
<p class="w3-center">@lang('messages.view_subject')</p>

@if (App\Subject::count() > 0)
<div class="row">
    <div class="col s12 m10 offset-m1" style="overflow-x:scroll !important;">
        <div class="col s6 m2 right topnav" style="margin-right: 10px !important">
            <input type="text" placeholder="Search Class..." onkeyup="myFunction()"  id="myInput">
            <i class="fa fa-search right w3-large teal-text search"></i>
        </div>
        <div class="col s6 m2 right topnav" style="margin-right: 10px !important">
            <input type="text" placeholder="Search Name..." onkeyup="myFunctions()"  id="myInputs">
            <i class="fa fa-search right w3-large teal-text search"></i>
        </div>
        <table id="myTable" class="w3-table w3-striped w3-border-t" style="font-size: 13px !important;">
            <tr class="teal">
                <th>S/N</th>
                <th>Name</th>
                <th>code</th>
                <th>Class</th>
                <th>class background</th>
                <th>class sector</th>
                <th>Coefficient</th>
            </tr>
            @foreach ($subjects as $key => $subject)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $subject->name }}</td>
                <td>{{ $subject->code }}</td>
                <td>{{ $subject->form->name }}</td>
                <td>{{ $subject->form->background->name }}</td>
                <td>{{ $subject->form->background->sector->name }}</td>
                <td>{{ $subject->coefficient }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@else
<div class="row">
    <div class="col s11 m10 offset-m1 orange white-text w3-center w3-margin-left w3-padding">
        You have not yet Created any subjects for the School.
    </div>
</div>
@endif
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
    function myFunctions() {
      // Declare variables
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInputs");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");
      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
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
