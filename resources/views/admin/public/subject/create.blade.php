@extends('admin.layout')
@section('title') Create Subject @endsection
@section('content')
<p class="w3-center">@lang('messages.create_subject')</p>
<div class="row">
    <div class="col s11 m10 w3-border-t offset-m1 radius white w3-margin-left">
        <form action="{{ route('subject.create.submit') }}" method="post" role="form">
            {{ csrf_field() }}
            <div class="row">
                <div class="input-field col s12 m3">
                    <input name="name" id="name" type="text" class="autocompleteSubject" value="{{ old('name') }}">
                    <label for="name">Subject Name</label>
                </div>
                <div class="input-field col s12 m3">
                    <input id="code" name="code" type="text" value="{{ old('code') }}" class="validate">
                    <label for="code">Subject Code</label>
                </div>
                <div class="input-field col s12 m2">
                    <input id="coff" name="coefficient" type="number" value="{{ old('coff') }}" class="validate">
                    <label for="coff">Subject Coefficient</label>
                </div>
                <div class="input-field col s12 m4">
                    <select name="class_id" id="form">
                        <option selected disabled value="">select the class/background/sector</option>
                        @foreach (App\Form::all() as $form)
                            <option value="{{ $form->id }}">{{ $form->name }} / {{ $form->background->name }} / {{ $form->background->sector->name }}</option>
                        @endforeach
                    </select>
                    <label for="form">select class</label>
                </div>
            </div>
            <center>
                <button type="submit" class="btn teal waves-effect waves-light" style="width: 40%">Add Subject</button>
            </center><br>
        </form>
    </div>
</div>

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
                <th>class</th>
                <th>Name</th>
                <th>code</th>
                <th>Coefficient</th>
                <th colspan="2">Action</th>
            </tr>
            @foreach ($subjects as $key => $subject)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $subject->form->name}} / {{ $subject->form->background->name}} / {{ $subject->form->background->sector->name}}</td>
                <td>{{ $subject->name }}</td>
                <td>{{ $subject->code }}</td>
                <td>{{ $subject->coefficient }}</td>
                <td><button class="btn my-orange waves-light waves-effect capitalize modal-trigger" href="#modal{{ $subject->id }}">Edit <i class="fa fa-pencil-alt"></i></button></td>
                <td><button class="btn red waves-light waves-effect capitalize" disabled>Delete <i class="fa fa-trash"></i></button></td>
            </tr>

            <div id="modal{{ $subject->id }}" class="modal modal-fixed-footer" style="width: 40% !important">
                <div class="modal-content">
                  <h4 class="w3-center teal-text">Edit the Subject Information</h4>
                  <hr style="border-top: 1px solid orange">
                    <div class="row">
                        <form action="{{ route('subject.edit') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $subject->id }}">
                            <div class="input-field col s12 m6">
                                <input name="name" id="name" type="text" class="autocompleteSubject" value="{{ $subject->name }}">
                                <label for="name">Edit Subject Name</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <input id="code" name="code" type="text" value="{{ $subject->code }}" class="validate">
                                <label for="code">Edit Subject Code</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <input id="coff" name="coefficient" type="number" value="{{ $subject->coefficient }}" class="validate">
                                <label for="coff">Edit Subject Coefficient</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <select name="class_id" id="form" class="browser-default">
                                    <option selected value="{{ $subject->form_id }}">{{ $subject->form->name }}</option>
                                    @foreach (App\Form::all() as $form)
                                        <option value="{{ $form->id }}">{{ $form->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        <center>
                            <div class="row">
                                <button type="submit" class="btn orange white-text col s12 m6 waves-effect waves-light" style="width: 40%">Update</button>
                            </div>
                        </center>
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
@else
<div class="row">
    <div class="col s11 m10 offset-m1 orange white-text w3-center w3-margin-left w3-padding">
        You have not yet Created any subjects for the school.
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
