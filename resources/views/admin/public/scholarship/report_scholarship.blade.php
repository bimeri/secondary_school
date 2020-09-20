@extends('admin.layout')
@section('style')
<style></style>
@endsection

@section('content')
<div class="row">
    <form action="{{ route('report.scholarship.get') }}" method="get">
        @csrf
        <div class="col m4 offset-m3 s12 input-field">
            <label for="year">Select The Year</label>
            <select name="year" class="validate">
                <option value="{{ Crypt::encrypt($current_year->id) }}">{{ $current_year->name }}</option>
                @foreach($years->where('active', '!=', 1) as $year)
                    <option value="{{ Crypt::encrypt($year->id) }}">{{ $year->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col m2 s6 input-field">
            <button onclick="load()" class="btn btn-primary waves-effect waves-light">get report</button>
        </div>
    </form>
    <div class="col s11 m10 w3-border-t offset-m1 w3-padding white w3-margin-bottom radius w3-margin-left" style="margin-top: 30px">
        <div class="row">
            <div class="col s12 m10 offset-m1 teal teal-text lighten-4 center w3-margin-bottom">
                total Scholarship given for the academic year {{ $academic_year }} :{{ $amount }} XFA
            </div><br><br>
            <div class="col s6 m2 offset-m9 offset-s6 topnav" style="margin-top:-30px !important">
                <input type="text" placeholder="Search Name..." onkeyup="myFunction()"  id="myInput">
                <i class="fa fa-search right w3-large teal-text search"></i>
            </div>
            <div class="col s6 m2 offset-m7 offset-s6 topnav" style="margin-top:-50px !important">
                <input type="text" placeholder="Search School Id..." onkeyup="myFunctionn()"  id="myInputt">
                <i class="fa fa-search right w3-large teal-text search"></i>
            </div>
            <div class="col s12 m10 offset-m1" style="overflow-x:scroll !important;">
                <table id="myTable" class="w3-table w3-striped w3-border-t" style="font-size: 13px !important;">
                    <tr class="teal">
                        <th>S/N</th>
                        <th>Year</th>
                        <th>Term</th>
                        <th>Student Name</th>
                        <th>Student School Id</th>
                        <th>class</th>
                        <th>amount</th>
                        <th>Reason</th>
                        <th>date</th>
                    </tr>
                    @foreach ($records as $key => $record)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $record->year->name }}</td>
                        <td>{{ $record->term->name }}</td>
                        <td>{{ $record->student->full_name }}</td>
                        <td>{{ $record->student->school_id }}</td>
                        <td>{{ $record->form->name }}</td>
                        <td>{{ $record->amount }}</td>
                        <td>{{ $record->reason }}</td>
                        <td>{{ date("D d M Y",strtotime($record->created_at)) }}</td>
                    </tr>
                    @endforeach
                    @if($records->count() == 0)
                    <tr class="red lighten-4 red-text">
                        <td colspan="9">
                            <div class="center">There is not Result for the Academic Year {{ $academic_year }}</div>
                        </td>
                    </tr>
                    @endif
                </table>
            </div>
        </div>
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
        td = tr[i].getElementsByTagName("td")[4];
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
