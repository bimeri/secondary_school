@extends('admin.layout')
@section('title') view sector @endsection

@section('content')
<div class="row">
    <div class="col s12 m10 offset-m1 blue blue-text lighten-4">
    <span onclick="this.parentElement.style.display='none'" class="w3-close right blue-text w3-hover w3-medium w3-padding-16" style="cursor: pointer">&times;</span>
        <h5 class="w3-center w3-medium"><b>{{ __('messages.create_sector_header') }}</b><br>{{ __('messages.create_sector_header_two') }}</h5>
    </div>
</div>

<div class="row">
    <div class="col s6 m2 right topnavv">
        <input type="text" placeholder="Search name..." onkeyup="myFunction()" id="myInput">
        <i class="fa fa-search right w3-large teal-text search"></i>
    </div>
    <div class="col s11 w3-margin-left m10 w3-border-t offset-m1 w3-padding white w3-margin-bottom radius" style="margin-top: 5px">
        @if(App\Sector::count() > 0)
            <div class="col s12 m12" style="overflow-x:scroll !important; margin-top: -5px !important">
                <table id="myTable" class="w3-table w3-striped w3-border-t w3-padding" style="font-size: 13px !important;">
                    <tr class="teal">
                        <th>S/N</th>
                        <th>sector Name</th>
                        <th>Sector description</th>
                    </tr>
                    @foreach (App\Sector::all() as $key => $sector)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $sector->name }}</td>
                            <td><div class="teal-text">{{ $sector->description }}</div></td>
                        </tr>
                    @endforeach
                </table>
            </div>
        @else
        <div class="col s12 m6 offset-m3 orange w3-center white-text w3-padding">No Sector has Created yet</div>
        @endif
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
