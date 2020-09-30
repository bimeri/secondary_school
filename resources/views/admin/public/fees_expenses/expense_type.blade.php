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
                        <option value="{{ $current_year->id }}" selected>{{ $current_year->name }}</option>
                        @foreach (App\Year::where('active', '!=', 1)->get() as $year)
                            <option value="{{ $year->id }}">{{ $year->name }}</option>
                        @endforeach
                    </select>
                    <label for="autocomplete-input">select the Academic year</label>
                </div>
                <div class="input-field col s12 m3">
                    <select name="term" class="validate" id="class">
                        <option value="{{ $current_term->id }}" selected>{{ $current_term->name }}</option>
                        @foreach (App\Term::where('active', '!=', 1)->get() as $term)
                            <option value="{{ $term->id }}">{{ $term->name }}</option>
                        @endforeach
                    </select>
                    <label for="class">Select the Academic Term</label>
                </div>
                <div class="input-field col s12 m3">
                    <select id="expense_type" name="expense_type">
                        <option value="" selected>select The expense Type</option>
                        @foreach ($expenses as $expense)
                            <option value="{{ $expense->id }}">{{ $expense->name }}</option>
                        @endforeach
                    </select>
                </div>
                 <div class="input-field col s12 m3">
                    <textarea id="reason" name="reason" class="materialize-textarea" placeholder="spend money on this because of ..."></textarea>
                    <label for="reason">Reason</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m4 offset-m3">
                    <label for="amount">Enter the amount</label>
                    <input type="number" name="amount" placeholder="1000 XCFA" id="amount">
                </div>
            </div>
            <div class="row">
                <button type="submit" class="btn btn-primary waves-effect waves-light col offset-m3 offset-s3" style="width: 40%">Create Expense Type</button>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <form method="get" action="{{ route('expense.type.get') }}">
        @csrf
        <div class="row">
            <div class="input-field col m3 offset-m4 s12">
                <select name="year" id="year">
                    <option value="" selected>select year</option>
                    @foreach (App\Year::all() as $year)
                    <option value="{{\Crypt::encrypt($year->id) }}">{{ $year->name }}</option>
                    @endforeach
                </select>
                <label for="class">Select the Year</label>
            </div>
            <div class="col m2 offset-s3 m3 input-field">
                <button class="w3-btn w3-teal waves-effect waves-light w3-small" onclick="load()">Get Result</button>
            </div>
        </div>
    </form>
</div>

@if($current->count() > 0)
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
                <th>Amount/XCFA</th>
                <th>Reason</th>
            </tr>
            @foreach ($current as $key => $type)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $type->year->name }}</td>
                <td>{{ $type->term->name}}</td>
                <td>{{ $type->expense->name }}</td>
                <td>{{ $type->amount }}</td>
                <td>{{ $type->reason }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@else
<center>
<div class="col s12 m8 offset-m2 alert alert-danger center" role="alert" style="width: 50%;">there is no Expense recorded for the current academic year: {{ $yr }}</div>
</center>
@endif



<button type="button" href="#modall2" class="orange btn white-text waves-effect waves-light modal-trigger right w3-small"  style="border-radius: 10px; width: 15%; margin: 5px; position:fixed; top:80px; right:20px">Add Expense Type <i class="fa fa-plus-square w3-small"></i></button>
{{-- modal to add sequences --}}
<div id="modall2" class="modal modal-fixed-footer">
    <div class="modal-content">
      <h4 class="w3-center teal-text">Add More Expense Type.</h4>
      <hr style="border-top: 1px solid orange">
        <div class="row">
            <h4>All Recorded Expenses</h4>
            <div class="input-field col s12 m6 lighten-4 teal teal-text w3-border" style="overflow-y: scroll; max-height:220px">
                @foreach (App\Expense::getAllType() as $exp)
                    <h5><i class="fa fa-arrow-right w3-small"></i> {{ $exp->name }}</h5>
                @endforeach
            </div>
            <div class="input-field col s12 m6">
                <form action="{{ route('addExpense.type') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="input-field col s12 m8">
                            <input id="expense_type" name="expense_type" type="text" value="{{ old('expense_type') }}" class="autocompleteExpense">
                            <label for="expense_type">Expense Type</label>
                        </div>
                        <div class="col s6 m2 offset-s3 input-field">
                            <button class="btn teal waves-effect waves-light w3-small" type="submit">Saved</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="modal-close red waves-effect waves-green btn-flat right white-text">Cancel</button>
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
