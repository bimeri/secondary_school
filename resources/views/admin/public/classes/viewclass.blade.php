@extends('admin.layout')
@section('title') view classes @endsection
@section('style')
<style>
   tr> th{
        color: #009688 !important;
    }
</style>
@endsection
@section('content')
<div class="row">
    <div class="col s11 w3-margin-left m10 offset-m1  orange orange-text lighten-4">
    <span onclick="this.parentElement.style.display='none'" class="w3-close right red-text w3-hover w3-medium w3-padding-16" style="cursor: pointer">&times;</span>
        <h5 class="w3-center w3-medium w3-padding bold">{{ __('messages.create_view_class') }}
        </h5>
    </div>
</div>

<div class="row">
    <div class="col s6 offset-s6 m2 offset-m9 topnav" style="margin-top:3px !important; position: absolute;">
        <input type="text" placeholder="Search Name..." onkeyup="myFunction()"  id="myInput">
        <i class="fa fa-search right w3-large teal-text search"></i>
    </div>
    <div class="col s12 m10 offset-m1" style="overflow-x:scroll !important;">
    <p class="center">All Main Classes</p>
        <table id="myTable" class="w3-table w3-striped w3-border-t" style="font-size: 13px !important;">
            <tr class="teal lighten-4">
                <th>S/N</th>
                <th>Name</th>
                <th>Type</th>
                <th>Code</th>
                <th>Maximum Capacity</th>
                <th>background</th>
            </tr>
            @foreach (App\Form::all(); as $key => $form)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $form->name }}</td>
                <td>{{ $form->type }}</td>
                <td>{{ $form->code }}</td>
                <td>{{ $form->max_number }}</td>
                <td>{{ $form->background->name }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>

<div class="row">
    <div class="col s6 offset-s6 m2 offset-m9 topnav" style="margin-top:3px !important; position: absolute;">
        <input type="text" placeholder="Search Sub-Class Name..." onkeyup="myFunctionn()"  id="myInputt">
        <i class="fa fa-search right w3-large teal-text search"></i>
    </div>
    <div class="col s12 m10 offset-m1" style="overflow-x:scroll !important;">
        <p class="center">Sub Classes</p>
        <table id="myTables" class="w3-table w3-striped w3-border-t" style="font-size: 13px !important;">
            <tr class="teal lighten-4">
                <th>S/N</th>
                <th>Class Name</th>
                <th>Class Type / Maximum capacity</th>
                <th>Sub-class Type</th>
                <th>Maximum Capacity</th>
            </tr>
            @foreach (App\Subclass::all(); as $key => $class)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $class->form->name }}</td>
                <td>{{ $class->form->type }} / {{ $class->form->max_number }}</td>
                <td>{{ $class->type }}</td>
                <td>{{ $class->max_number }}</td>
            </tr>
            @endforeach
        </table>
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
    function myFunctionn() {
      // Declare variables
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInputt");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTables");
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
