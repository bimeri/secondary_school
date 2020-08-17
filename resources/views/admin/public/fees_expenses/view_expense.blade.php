@extends('admin.layout')
@section('title') Expense type @endsection
@section('content')
<p class="w3-center">@lang('messages.welcome')</p>
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
                <th colspan="2">Action</th>
            </tr>
            @foreach (App\Expensetype::all(); as $key => $type)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $type->year->name }}</td>
                <td>{{ $type->term->name}}</td>
                <td>{{ $type->expense_type }}</td>
                <td>{{ $type->reason }}</td>

                <td><button class="btn my-orange waves-effect waves-light w3-small modal-trigger" href="#modal{{ $key+1 }}">Edit</button></td>
                <td><button class="btn waves-light waves-effect my-red w3-small">Delete</button></td>
            </tr>
            {{-- modal to edit fee type --}}
            <div id="modal{{ $key+1 }}" class="modal modal-fixed-footer">
                <div class="modal-content">
                <h4 class="w3-center teal-text">Update the Expense Type</h4>
                <hr style="border-top: 1px solid orange">
                    <div class="row">
                        <form action="{{ route('expense_type.update.submit') }}" method="post">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="id" value="{{ $type->id }}">
                                <div class="input-field col s12 m3 offset-m3">
                                    <select name="year" class="browser-default" id="year">
                                        <option value="{{ $type->year_id }}" selected>{{ $type->year->name }}</option>
                                        @foreach (App\Year::all() as $year)
                                            <option value="{{ $year->id }}">{{ $year->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-field col s12 m3">
                                    <select name="term" class="browser-default" id="class">
                                        <option value="{{ $type->term_id }}" selected>{{ $type->term->name }}</option>
                                        @foreach (App\Term::all() as $term)
                                            <option value="{{ $term->id }}">{{ $term->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m3 offset-m2">
                                    <input id="fee_type" name="expense_type" type="text" value="{{ $type->expense_type }}" class="autocompleteExpense">
                                    <label for="fee_type">Update Expense Type</label>
                                </div>
                                 <div class="input-field col s12 m6">
                                    <textarea id="textarea{{ $key + 1 }}" name="reason" class="materialize-textarea"></textarea>
                                    <label for="textarea{{ $key + 1 }}">Update the reason</label>
                                </div>
                            </div>
                            <div class="row">
                                <button type="submit" class="btn orange white-text waves-effect waves-light col offset-m3 offset-s3" style="width: 40%">Update Expense Type</button>
                            </div>
                            <script>
                                $('#textarea{{ $key + 1 }}').val('{{ $type->reason }}');
                                M.textareaAutoResize($('#textarea{{ $key + 1 }}'));
                            </script>
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
