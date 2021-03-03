@extends('admin.layout')
@section('title') Class @endsection
@section('content')
<div class="row">
    <div class="col s12 m10 offset-m1 blue blue-text lighten-4">
    <span onclick="this.parentElement.style.display='none'" class="w3-close right blue-text w3-hover w3-medium w3-padding" style="cursor: pointer">&times;</span>
        <h5 class="w3-center w3-medium bold">{{ __('messages.create_create_header') }}
        </h5>
    </div>
</div>

<div class="row">
    <div class="col s11 w3-margin-left m10 w3-border-t offset-m1 w3-padding white w3-margin-bottom radius" style="margin-top: 5px">
        <form action="{{ route('class.form.create') }}" method="get">
            @csrf
            <div class="row">
                <div class="input-field col s12 m5">
                    <select name="background" class="browser-default" id="back" required>
                        <option value="">select the background/section</option>
                        @foreach (App\Background::all() as $bg)
                            <option value="{{ Crypt::encrypt($bg->id) }}">{{ $bg->name }}/ {{ $bg->sector->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-field col s12 m3 offset-m2">
                    <button type="submit" class="btn btn-primary waves-effect waves-light" onclick="load()">Create Class</button>
                </div>
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
