@extends('admin.layout')
@section('content')
    <div class="row w3-margin-top">
        <div class="col s11 m10 w3-border-t offset-m1 w3-padding white w3-margin-bottom radius w3-margin-left" style="margin-top: 30px">
            <div class="col s6 m2 right topnav">
                <input type="text" placeholder="Search email..." onkeyup="myFunctionn()" id="myInputt">
                <i class="fa fa-search right w3-large teal-text search"></i>
            </div>
            <div class="col s6 m2 right topnav" style="margin-right: 10px !important">
                <input type="text" placeholder="Search name..." onkeyup="myFunction()"  id="myInput">
                <i class="fa fa-search right w3-large teal-text search"></i>
            </div>
            <div class="col s12 m12" style="overflow-x:scroll !important;">
                <table id="myTable" class="w3-table w3-striped w3-border-t" style="font-size: 13px !important;">
                    <tr class="teal">
                        <th>S/N</th>
                        <th>profile</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>email</th>
                        <th>User Name</th>
                        <th>gender</th>
                        <th>date of birth</th>
                        <th colspan="2">roles</th>
                    </tr>
                    @foreach (App\Admin::where('is_super', 0)->get(); as $key => $user)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td><img src="{{ URL::asset('image/profile/'.$user->profile.'') }}" width="50" height="50" class="w3-circle w3-border-t"></td>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->user_name }}</td>
                        <td>{{ $user->gender }}</td>
                        <td>{{ date("jS F, Y", strtotime( $user->date_of_birth))}}</td>
                        <td>
                            @php
                                $users = App\Admin::find($user->id);
                                foreach ($users->roles as $role) {
                                    echo $role->name.' &nbsp;';
                                }
                            @endphp
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <a href="{{ route('admin.home') }}" class="btn teal waves-light waves-effect backbtn-viewrole"><i class="fa fa-reply"></i> Go Back</a>

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
        function myFunctionn() {
          // Declare variables
          var input, filter, table, tr, td, i, txtValue;
          input = document.getElementById("myInputt");
          filter = input.value.toUpperCase();
          table = document.getElementById("myTable");
          tr = table.getElementsByTagName("tr");
          // Loop through all table rows, and hide those who don't match the search query
          for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[4];
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
