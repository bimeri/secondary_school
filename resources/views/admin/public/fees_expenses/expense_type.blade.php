@extends('admin.layout')
@section('title') Expense type @endsection
@section('content')
<p class="w3-center">@lang('messages.welcome')</p>
<div class="row">
    <div class="col s11 w3-margin-left m10 w3-border-t offset-m1 w3-padding white w3-margin-bottom radius" style="margin-top: 5px">
        <form action="{{ route('expense.type.submit') }}" method="post">
            @csrf
            <div class="row">
                <div class="input-field col s12 m2 offset-m1">
                    <select name="year" class="validate" id="year">
                        <option value=" " selected disabled>2019/2020</option>
                        @foreach (App\Year::all() as $year)
                            <option value="{{ $year->id }}">{{ $year->name }}</option>
                        @endforeach
                    </select>
                    <label for="autocomplete-input">select the Academic year</label>
                </div>
                <div class="input-field col s12 m3">
                    <select name="term" class="validate" id="class">
                        <option value="" selected disabled>Select Term</option>
                        @foreach (App\Term::all() as $term)
                            <option value="{{ $term->id }}">{{ $term->name }}</option>
                        @endforeach
                    </select>
                    <label for="class">Select the Academic Term</label>
                </div>
                <div class="input-field col s12 m3">
                    <input id="expense_type" name="expense_type" type="text" value="{{ old('expense_type') }}" class="autocompleteExpense">
                    <label for="expense_type">Expense Type</label>
                </div>
                 <div class="input-field col s12 m3">
                    <textarea id="reason" name="reason" class="materialize-textarea" placeholder="spend money on this because of ..."></textarea>
                    <label for="reason">Reason</label>
                </div>
            </div>
            <div class="row">
                <button type="submit" class="btn btn-primary waves-effect waves-light col offset-m3 offset-s3" style="width: 40%">Create Expense Type</button>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col s6 offset-s6 m2 offset-m9 topnav" style="margin-top:-20px !important">
        <input type="text" placeholder="Search Type..." onkeyup="myFunction()"  id="myInput">
        <i class="fa fa-search right w3-large teal-text search"></i>
    </div>
    <div class="col s12 m10 offset-m1" style="overflow-x:scroll !important;">
        <table id="myTable" class="w3-table w3-striped w3-border-t" style="font-size: 13px !important;">
            <tr class="teal">
                <th>S/N</th>
                <th>Year</th>
                <th>Term</th>
                <th>Expense type</th>
                <th>Reason</th>
            </tr>
            @foreach (App\Expensetype::all(); as $key => $type)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $type->year->name }}</td>
                <td>{{ $type->term->name}}</td>
                <td>{{ $type->expense_type }}</td>
                <td>{{ $type->reason }}</td>
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
</script>
@endsection
