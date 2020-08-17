@extends('admin.layout')

@section('content')
    <div class="row w3-margin-top">
        <center>
            <button class="btn teal waves-effect waves-light w3-tiny modal-trigger hide-on-med-and-up" href="#modal1" type="button" style="margin-top: -10px; margin-left:20px !important; position: absolute; width:42%">Add User <i class="fa fa-user-plus w3-tiny"></i> </button>
        </center>
        <div class="col s11 m10 w3-border-t offset-m1 w3-padding white w3-margin-bottom radius w3-margin-left" style="margin-top: 30px">
            <div class="col s6 m2 right topnav">
                <input type="text" placeholder="Search name..." onkeyup="myFunction()"  id="myInput">
                <i class="fa fa-search right w3-large teal-text search"></i>
            </div>
            <div class="col s6 m2 right topnav" style="margin-right: 10px !important">
                <input type="text" placeholder="Search email..." onkeyup="myFunctionn()" id="myInputt">
                <i class="fa fa-search right w3-large teal-text search"></i>
            </div>
            <div class="col s12 m12" style="overflow-x:scroll !important;">
                <center>
                    <button class="btn teal waves-effect waves-light w3-tiny modal-trigger hide-on-med-and-down" href="#modal1" type="button" style="margin-top: -40px; margin-left:-50px !important; position: absolute; z-index:1000">Add User <i class="fa fa-user-plus w3-tiny"></i> </button>
                </center>
                <table id="myTable" class="w3-table w3-striped w3-border-t" style="font-size: 13px !important;">
                    <tr class="teal">
                        <th>S/N</th>
                        <th>profile</th>
                        <th>User Full Name</th>
                        <th>email</th>
                        <th>User Name</th>
                        <th>date of birth</th>
                        <th>roles</th>
                        <th colspan="2">Action</th>
                    </tr>
                    @foreach (App\Admin::where('is_super', 0)->get() as $key => $user)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td><img src="{{ URL::asset('image/profile/'.$user->profile.'') }}" width="50" height="50" class="w3-circle w3-border-t"></td>
                        <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->gender }}</td>
                        <td>{{ date("jS F, Y", strtotime( $user->date_of_birth))}}</td>
                        <td>
                            @php
                                $users = App\Admin::find($user->id);
                                foreach ($users->roles as $role) {
                                    echo $role->name.' ';
                                }
                            @endphp
                        </td>
                        <td><a href="{{ route('user.admin.edit', ['id' => $user->id]) }}" class="wave waves-teal waves-effect btn orange lighten-3 orange-text w3-small"> Update <i class="fa fa-pen w3-small"></i></a></td>
                        <td><button class="wave waves-effect waves-light btn red lighten-3 red-text w3-small" disabled> Delete <i class="fa fa-trash-alt w3-small"></i></button></td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>


      <!-- Modal Structure -->
  <div id="modal1" class="modal modal-fixed-footer" style="width: 90% !important">
    <div class="modal-content">
      <h4 class="w3-center teal-text">Fill all the form bellow to Add One new user </h4>
      <hr>
      <div class="row">
        <form action="{{ route('user.save') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="input-field col s12 m3">
                    <input name="firstName" id="first_name" type="text" class="validate" value="{{ old('firstName') }}" onchange="getVal()">
                    <label for="first_name">First Name</label>
                </div>
                <div class="input-field col s12 m3">
                    <input id="last_name" name="lastName" type="text" value="{{ old('lastName') }}" class="validate">
                    <label for="last_name">Last Name</label>
                </div>
                <div class="input-field col s12 m3">
                    <input id="email" name="email" type="text" value="{{ old('email') }}" class="validate">
                    <label for="email">Email</label>
                </div>
                 <div class="input-field col s12 m3">
                    <input id="uname" name="userName" type="text" value="{{ old('userName') }}" class="validate">
                    <label for="uname">User Name</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m3">
                    <select name="gender" class="icons">
                      <option value="" disabled selected>Select Your Gender</option>
                      <option value="Male" data-icon="{{ URL::asset('image/man.png') }}">Male</option>
                      <option value="Female" data-icon="{{ URL::asset('image/female.png') }}">Female</option>
                    </select>
                    <label><b id="inp"></b> Select Gender</label>
                </div>
                <div class="input-field col s12 m3">
                    <input type="text" name="date_of_birth" class="datepicker" id="date">
                    <label for="date"><b id="inp"></b> enter Date of birth</label>
                </div>
                <div class="file-field input-field col s12 m3">
                    <div class="btn">
                      <input type="file" name="profile_image" id="imgInp">
                    </div>
                    <div class="file-path-wrapper">
                        <img id="blah" src="#" alt="Upload profile" height="60" width="70"/>
                      <input class="file-path validate" name="profile_image" type="text" placeholder="upload profile">
                    </div>
                </div>
                <div class="input-field col s12 m3">
                    <select multiple name="roles[]">
                      @foreach (App\Role::all() as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                      @endforeach
                    </select>
                    <label>Select roles for User <b id="inp"></b></label>
                  </div>
            </div>
            <div class="col s6 m3 offset-m4 offset-s3 w3-center" style="margin-top: 4px !important">
                <button class="btn teal waves-effect waves-light w3-medium" type="submit">Saved</button>
            </div>
        </form>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="modal-close red waves-effect waves-green btn-flat right white-text">Cancel</button>
    </div>
  </div>

    <script>
        function getVal(){
            var t = document.getElementById('first_name').value;
            document.getElementById('inp').innerHTML = t;
        }

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
