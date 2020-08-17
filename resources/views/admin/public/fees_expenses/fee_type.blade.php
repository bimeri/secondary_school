@extends('admin.layout')
@section('title') fees type @endsection
@section('content')
<p class="w3-center">@lang('messages.welcome')</p>
<div class="row">
    <div class="col s11 w3-margin-left m10 w3-border-t offset-m1 w3-padding white w3-margin-bottom radius" style="margin-top: 5px">
        <form action="{{ route('fee.type.submit') }}" method="post">
            @csrf
            <div class="row">
                <div class="input-field col s12 m2 offset-m1">
                    <select name="year" class="validate" id="year">
                        <option value="{{ $current_year->id }}" selected>{{ $current_year->name }}</option>
                        @foreach (App\Year::all() as $year)
                            <option value="{{ $year->id }}">{{ $year->name }}</option>
                        @endforeach
                    </select>
                    <label for="autocomplete-input">select the year</label>
                </div>
                <div class="input-field col s12 m3">
                    <select name="class" class="validate" id="class">
                        <option value="" selected disabled>Select Class</option>
                        @foreach (App\Form::all() as $class)
                            <option value="{{ $class->id }}">{{ $class->name }}/ {{ $class->background->name }}/ {{ $class->background->sector->name }}</option>
                        @endforeach
                    </select>
                    <label for="class">Select the class</label>
                </div>
                <div class="input-field col s12 m3">
                    <input id="fee_type" name="fee_type" type="text" value="{{ old('fee_type') }}" class="autocompleteType">
                    <label for="fee_type">fee Type</label>
                </div>
                 <div class="input-field col s12 m3">
                    <input id="amount" name="amount" type="number" value="{{ old('amount') }}" class="validate" placeholder="example 20 000">
                    <label for="amount">Amount</label>
                </div>
            </div>
            <div class="row">
                <button type="submit" class="btn btn-primary waves-effect waves-light col offset-m3 offset-s3" style="width: 40%">Create Fee Type</button>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col s6 offset-s6 m2 offset-m9 topnav" style="margin-top:-20px !important">
        <input type="text" placeholder="Search Class..." onkeyup="myFunction()"  id="myInput">
        <i class="fa fa-search right w3-large teal-text search"></i>
    </div>
    <div class="col s12 m10 offset-m1" style="overflow-x:scroll !important;">
        <table id="myTable" class="w3-table w3-striped w3-border-t" style="font-size: 13px !important;">
            <tr class="teal">
                <th>S/N</th>
                <th>Year</th>
                <th>Class</th>
                <th>Background</th>
                <th>Sector</th>
                <th>type</th>
                <th>amount</th>
                <th colspan="2">Action</th>
            </tr>
            @foreach (App\Feetype::all(); as $key => $fee)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $fee->year->name }}</td>
                <td>{{ $fee->form->name}}</td>
                <td>{{ $fee->form->background->name }}</td>
                <td>{{ $fee->form->background->sector->name }}</td>
                <td>{{ $fee->fee_type }}</td>
                <td>{{ $fee->amount }}</td>

                <td><button class="btn my-orange waves-effect waves-light w3-small modal-trigger" href="#modal{{ $key+1 }}">Edit</button></td>
                <td>
                    <form action="{{ route('fee_type.delete') }}" method="POST" id="form{{ $key + 1 }}">@csrf
                        <input type="hidden" name="id" value="{{ $fee->id }}"/>
                    <button type="submit" class="btn waves-light waves-effect my-red w3-small" id="btn_submit{{ $key + 1 }}" onclick="save{{ $key + 1 }}()">Delete</button>
                    </form>
                </td>
            </tr>
            {{-- modal to edit fee type --}}
            <div id="modal{{ $key+1 }}" class="modal modal-fixed-footer">
                <div class="modal-content">
                <h4 class="w3-center teal-text">Update the School Fees control Form</h4>
                <hr style="border-top: 1px solid orange">
                    <div class="row">
                        <form action="{{ route('fee_type.update.submit') }}" method="post">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="id" value="{{ $fee->id }}">
                                <div class="input-field col s12 m3 offset-m4">
                                    <select name="year" class="browser-default" id="year">
                                        <option value="{{ $fee->year_id }}" selected>{{ $fee->year->name }}</option>
                                        @foreach (App\Year::all() as $year)
                                            <option value="{{ $year->id }}">{{ $year->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m5">
                                    <select name="class" class="browser-default" id="class">
                                        <option value="{{ $fee->form_id }}" selected>{{ $fee->form->name }}/ {{ $fee->form->background->name }}/ {{ $fee->form->background->sector->name }}</option>
                                        @foreach (App\Form::all() as $class)
                                            <option value="{{ $class->id }}">{{ $class->name }}/ {{ $class->background->name }}/ {{ $class->background->sector->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-field col s12 m3">
                                    <input id="fee_type" name="fee_type" type="text" value="{{ $fee->fee_type }}" class="autocompleteType">
                                    <label for="fee_type">Update fee Type</label>
                                </div>
                                 <div class="input-field col s12 m3">
                                    <input id="amount" name="amount" type="number" value="{{ $fee->amount }}" class="validate">
                                    <label for="amount">Update Amount</label>
                                </div>
                            </div>
                            <div class="row">
                                <button type="submit" class="btn orange white-text waves-effect waves-light col offset-m3 offset-s3" style="width: 40%">Update Fee Type</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="modal-close red waves-effect waves-green btn-flat right white-text">Cancel</button>
                </div>
            </div>

            <script>
                function save{{ $key + 1 }}(){
              $(document).on('click', '#btn_submit{{ $key + 1 }}', function(e) {
                  e.preventDefault();
                 swal({
                        title: "Are you sure you want to delete?",
                        text: "it is not recommended to delete since school type are just specific to a particular academic year!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
              }).then(function (willUpdate) {
                if (willUpdate) {
                  swal("Poof! The fees type has been deleted successfully", {
                    icon: "success",
                  });
                  $('#form{{ $key + 1 }}').submit();
                } else {
                  swal("the feess type remain unchanged!");
                }
                  });
              });

              }
              </script>
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
</script>
@endsection
