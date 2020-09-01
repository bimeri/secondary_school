@extends('admin.layout')
@section('title') Class @endsection
@section('content')
<div class="row">
    <div class="col s12 m10 offset-m1 my-orange" style="color: #ff9800 !important; background-color: rgb(243, 213, 158) !important;">
    <span onclick="this.parentElement.style.display='none'" class="w3-close right red-text w3-hover w3-medium w3-padding-16" style="cursor: pointer">&times;</span>
        <h5 class="w3-center w3-medium w3-padding bold">{{ __('messages.create_create_header') }}
        </h5>
    </div>
</div>

<div class="row">
    <div class="col s11 w3-margin-left m10 w3-border-t offset-m1 w3-padding white w3-margin-bottom radius" style="margin-top: 5px">
        <form action="{{ route('class.form.submit') }}" method="post">
            @csrf
            <div class="row">
                <div class="input-field col s12 m6 offset-m3">
                    <input name="name" id="autocomplete-input" type="text" class="autocompletess" value="{{ old('name') }}">
                    <i class="fa fa-pen teal-text w3-xlarge right" style="margin-top: -40px"></i>
                    <label for="autocomplete-input">Class Name</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m3">
                    <input id="max" name="maximum_number" type="number" value="{{ old('maximum_number') }}" class="validate">
                    <label for="max">Maximum Capacity</label>
                </div>
                <div class="input-field col s12 m3">
                    <input id="code" name="ClassCode" type="text" value="{{ old('code') }}" class="validate">
                    <label for="code">Class Code</label>
                </div>
                 <div class="input-field col s12 m3">
                    <input id="type" name="type" type="text" value="A" class="validate" readonly placeholder="example A,B,C,D, etc">
                    <label for="type">Class Type (optional)</label>
                </div>
                <div class="input-field col s12 m3">
                    <select name="background" class="validate" id="backk">
                        @foreach (App\Background::all() as $bg)
                            <option value="{{ $bg->id }}">{{ $bg->name }}/ {{ $bg->sector->name }}</option>
                        @endforeach
                    </select>
                    <label for="backk">Select Class Background</label>
                </div>
            </div>
            <div class="row">
                <button type="submit" class="btn btn-primary waves-effect waves-light col offset-m3 offset-s3" style="width: 40%">Create Class</button>
            </div>
        </form>
    </div>
</div>
@if (App\Form::count() > 0)
<div class="row">
    <div class="col s6 m2 offset-m9 offset-s6 topnav" style="margin-top:-30px !important">
        <input type="text" placeholder="Search Name..." onkeyup="myFunction()"  id="myInput">
        <i class="fa fa-search right w3-large teal-text search"></i>
    </div>
    <div class="col s12 m10 offset-m1" style="overflow-x:scroll !important;">
        <table id="myTable" class="w3-table w3-striped w3-border-t" style="font-size: 13px !important;">
            <tr class="teal">
                <th>S/N</th>
                <th>Name</th>
                <th>background/sector</th>
                <th>Type</th>
                <th>Code</th>
                <th>Maximum Capacity</th>
                @can('edit_delete_class', App\Permission::class) <th colspan="2">Action</th> @endcan
            </tr>
            @foreach (App\Form::all(); as $key => $form)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $form->name }}</td>
                <td>{{ $form->background->name }}/{{ $form->background->sector->name }}</td>
                <td>{{ $form->type }}</td>
                <td>{{ $form->code }}</td>
                <td>{{ $form->max_number }}</td>
                @can('edit_delete_class', App\Permission::class)
                    <td><button class="btn my-orange waves-light waves-effect capitalize modal-trigger"  href="#modal{{ $form->id }}">Edit <i class="fa fa-pencil-alt w3-small"></i></button></td>
                    <td>
                        <form action="{{ route('admin.delete.class') }}" method="post" id="form{{ $form->id }}">
                            @csrf
                            <input type="hidden" name="formid" value="{{ $form->id }}">
                            <?php $check = App\Studentinfo::where('form_id', $form->id)->count(); ?>
                            @if($check > 0)
                            <button class="btn my-red waves-light waves-effect capitalize disabled" style="border: 2px solid #ccc !important">Delete <i class="fa fa-trash w3-small"></i></button>
                            @else
                            <button class="btn my-red waves-light waves-effect capitalize" onclick="save{{ $form->id }}()" id="btn-submit{{ $form->id }}">Delete <i class="fa fa-trash w3-small"></i></button>
                            @endif
                        </form>
                    </td>
                @endcan
            </tr>

            <div id="modal{{ $form->id }}" class="modal modal-fixed-footer" style="width: 70%;">
                <div class="modal-content">
                  <h4 class="w3-center teal-text">Update class Information</h4>
                    <div class="row">
                        <form action="{{ route('admin.edit.class') }}" method="post">
                            @csrf
                             <div class="row">
                                 <input type="hidden" name="id" value="{{ $form->id }}">

                                <div class="input-field col s12 m3 offset-m1">
                                    <input name="name" id="autocomplete-inputt" type="text" class="autocompletess" value="{{ $form->name }}">
                                    <i class="fa fa-pen teal-text w3-xlarge right" style="margin-top: -40px"></i>
                                    <label for="autocomplete-inputt">Update Class Name</label>
                                </div>
                                <div class="input-field col s12 m3 offset-m1">
                                    <input id="maxx" name="maximum_number" type="number" value="{{ $form->max_number }}" class="validate">
                                    <label for="maxx">Update Maximum Capacity</label>
                                </div>
                                <div class="input-field col s12 m3">
                                    <input id="codee" name="ClassCode" type="text" value="{{ $form->code }}" class="validate">
                                    <label for="codee">Update Class Code</label>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12 m3 offset-m1">
                                        <input id="typee" name="type" type="text" value="A" readonly class="validate" placeholder="example A,B,C,D, etc">
                                        <label for="typee">Update Class Type (optional)</label>
                                    </div>

                                    <div class="col s12 m5">
                                        <label for="back">Update Class Background</label>
                                        <select name="background" class="browser-default">
                                            <option value="{{ $form->background_id }}" selected>{{ $form->background->name }}/ {{ $form->background->sector->name }}</option>
                                            @foreach (App\Background::all() as $bg)
                                                <option value="{{ $bg->id }}">{{ $bg->name }}/ {{ $bg->sector->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <button type="submit" class="btn my-orange waves-effect waves-light col offset-m4 offset-s3" style="width: 40%">Update Class</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="modal-close red waves-effect waves-green btn-flat right white-text">Cancel</button>
                </div>
            </div>

            <script>
                function save{{ $form->id }}(){
              $(document).on('click', '#btn-submit{{ $form->id }}', function(e) {
                  e.preventDefault();
                 swal({
                        title: "Are you sure you want to delete?",
                        text: "You are allow to delete class for now but as soon as student registered to this class, you won't be able!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
              }).then(function (willUpdate) {
                if (willUpdate) {
                  swal("Poof! The class {{ $form->name }} has been deleted successfully", {
                    icon: "success",
                  });
                  $('#form{{ $form->id }}').submit();
                } else {
                  swal("the class {{ $form->name }} remain unchanged!");
                }

                  });
              });

              }
              </script>
            @endforeach
        </table>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var h = window.innerHeight;
        $('html, body').animate({scrollTop:$(document).height() - (h + 20)}, 2000);
        return false;
        });
</script>
@else
<div class="row">
    <div class="col s12 m10 offset-m1" style="color: #d19b07 !important; background-color: rgb(248, 221, 171) !important;">
        <h5 class="w3-center w3-medium w3-padding bold">{{ __('messages.create_no_form') }}</h5>
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
