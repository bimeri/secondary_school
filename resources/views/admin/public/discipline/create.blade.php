@extends('admin.layout')
@section('title') create discipline @endsection
@section('content')
<div class="row">
    <div class="col s12 m10 offset-m1 orange orange-text lighten-4">
    <span onclick="this.parentElement.style.display='none'" class="w3-close right blue-text w3-hover w3-medium w3-padding" style="cursor: pointer">&times;</span>
        <h5 class="w3-center w3-medium bold">{{ __('messages.discipline_type') }}
        </h5>
    </div>
</div>

<div class="row">
    <div class="col s11 w3-margin-left m10 w3-border-t offset-m1 w3-padding white w3-margin-bottom radius" style="margin-top: 5px">
        <form action="{{ route('discipline.form.submit') }}" method="post">
            @csrf
            <div class="row">
                <div class="input-field col s12 m5 offset-m1">
                    <input name="discipline_type" id="autocomplete-input" type="text" class="autocompletetyle" value="{{ old('discipline_type') }}">
                    <i class="fa fa-plus teal-text w3-xlarge right" style="margin-top: -40px"></i>
                    <label for="autocomplete-input">Add discipline Type</label>
                </div>
                <div class="input-field col s12 m6">
                    <textarea id="code" name="description" value="{{ old('code') }}" class="validate"></textarea>
                    <label for="code">Describtion of Type</label>
                </div>
            </div>
            <div class="row">
                <button type="submit" class="btn btn-primary waves-effect waves-light col offset-m3 offset-s3" style="width: 40%">Add Type</button>
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
                <th>Discipline Type</th>
                <th>Description</th>
                <th colspan="2">Action</th>
            </tr>
            @foreach (App\Discipline::all(); as $key => $des)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $des->type }}</td>
                <td>{{ $des->description }}</td>

                <td><button class="btn waves-effect waves-green orange lighten-4 orange-text modal-trigger" href="#modall{{ $key + 1 }}">Edit</button></td>
                <td>
                    <form action="{{ route('admin.delete.discipline') }}" method="post" id="form{{ $des->id }}">@csrf
                        <input type="hidden" name="id" value="{{ $des->id }}">
                        <button type="submit" class="btn waves-effect waves-light red red-text lighten-4" id="btn-submit{{ $des->id }}" onclick="save{{ $des->id }}()">Delete <i class="fa fa-trash w3-small"></i></button>
                    </form>
                </td>
            </tr>
            {{--  edit modal  --}}
            <div id="modall{{ $key + 1 }}" class="modal modal-fixed-footer" >
                <div class="modal-content">
                <h4 class="w3-center orange-text">Edit the Discipline Type </h4>
                <hr style="border-top: 1px solid teal">
                    <div class="row">
                        <form action="{{ route('discipline.form.update') }}" method="post">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="id" value="{{ $des->id }}"/>
                                <div class="input-field col s12 m5 offset-m1">
                                    <input name="discipline_type" id="autocomplete-input" type="text" value="{{ $des->type }}" class="autocompletetyle" value="{{ old('discipline_type') }}">
                                    <i class="fa fa-plus teal-text w3-xlarge right" style="margin-top: -40px"></i>
                                    <label for="autocomplete-input">Add discipline Type</label>
                                </div>
                                <div class="input-field col s12 m6">
                                    <textarea id="code" name="description" value="{{ old('code') }}" class="validate">{{ $des->description }}</textarea>
                                    <label for="code">Description of Type</label>
                                </div>
                            </div>
                            <div class="row">
                                <button type="submit" class="btn orange white-text waves-effect waves-light col offset-m3 offset-s3" style="width: 40%">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="modal-close red lighten-2 waves-effect waves-green btn-flat right white-text">Cancel</button>
                </div>
            </div>
            {{-- end edit modal  --}}

            <script>
                function save{{ $des->id }}(){
              $(document).on('click', '#btn-submit{{ $des->id }}', function(e) {
                  e.preventDefault();
                 swal({
                        title: "Are you sure you want to delete?",
                        text: "You wont be able to delete if at all you have registetred some student with this type!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
              }).then(function (willUpdate) {
                if (willUpdate) {
                  swal("Poof! The discipline has been deleted successfully", {
                    icon: "success",
                  });
                  $('#form{{ $des->id }}').submit();
                } else {
                  swal("the discipline type remain unchanged!");
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
