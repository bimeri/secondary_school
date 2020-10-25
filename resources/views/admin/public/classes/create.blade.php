@extends('admin.layout')
@section('title') Class @endsection
@section('content')
<div class="row">
    <div class="col s12 m10 offset-m1 orange orange-text lighten-5">
    <span onclick="this.parentElement.style.display='none'" class="w3-close right orange-text w3-hover w3-medium w3-padding-16" style="cursor: pointer">&times;</span>
        <h5 class="w3-center w3-medium w3-padding bold">{{ __('messages.create_create_header') }}
        </h5>
    </div>
</div>

<div class="row">
    <div class="col s11 w3-margin-left m10 w3-border-t offset-m1 w3-padding white w3-margin-bottom radius" style="margin-top: 5px">
        <form action="{{ route('class.form.submit') }}" method="post">
            @csrf
            <div class="row">
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
                <div class="input-field col s12 m6">
                    <input name="name" id="autocomplete-input" type="text" class="autocompletess" value="{{ old('name') }}">
                    <i class="fa fa-pen teal-text w3-xlarge right" style="margin-top: -40px"></i>
                    <label for="autocomplete-input">Class Name</label>
                </div>

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

            </div>
            <div class="row">
                <button type="submit" class="btn btn-primary waves-effect waves-light col offset-m3 offset-s3" style="width: 40%">Create Class</button>
            </div>
        </form>
    </div>
</div>
@if (App\Form::count() > 0)
<div class="row">

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
