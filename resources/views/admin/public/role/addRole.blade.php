@extends('admin.layout')
@section('title'){{ __('add_role') }}@endsection

@section('content')
    <div class="row w3-margin-top">
        <div class="col s11 m8 w3-border-t offset-m2 w3-padding white w3-margin-bottom radius w3-margin-left">
            <form>
                <div class="row">
                    <div class="input-field col s12 m4 offset-m3">
                        <input name="role" type="text" id="autocomplete-input" class="autocomplete">
                        <i class="fa fa-user teal-text w3-xlarge right" style="margin-top: -40px"></i>
                        <label for="autocomplete-input" class="teal-text">Enter the Role</label>
                    </div>
                    <div class="col s12 m3 offset-m1 w3-margin-top" style="margin-top: 30px !important">
                        <button class="btn teal waves-effect waves-light w3-medium modal-trigger" href="#modal1" type="button" onclick="getVal()">Saved</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- modal --}}

  <!-- Modal Structure -->
  <div id="modal1" class="modal modal-fixed-footer" style="width: 90% !important">
    <div class="modal-content">
      <h4 class="w3-left teal-text">Select all the Privileges for the Role <b id="inp"></b></h4>
      <hr>
      <div class="row">
        <form action="" id="form">
            {{ csrf_field() }}
            <div class="input-field col s6 m4 offset-m2 right" style="margin-top: -65px !important">
                <input type="text" class="validate" name="role" value="" id="tex" readonly>
            </div>
            <div class="row">
                <div class="col s6 m3 w3-padding">
                    <h5><u>Fees and Expenses</u></h5>
                    @foreach ($permissions->where('parent', 'fees_expenses') as $permission)
                    <p class="w3-small">
                        <label class="w3-small">
                          <input type="checkbox" name="permit{{ $permission->id }}"
                                value="{{ $permission->id }}" class="w3-small filled-in"/>
                          <span class="w3-small"> {{ $permission->name }}</span>
                        </label>
                      </p>
                    @endforeach
                </div>
                <div class="col s6 m3 w3-padding">
                    <h5><u>Manage classes</u></h5>
                    @foreach ($permissions->where('parent', 'classes') as $permission)
                    <p class="w3-small">
                        <label class="w3-small">
                          <input type="checkbox" name="permit{{ $permission->id }}" value="{{ $permission->id }}" class="w3-small filled-in"/>
                          <span class="w3-small"> {{ $permission->name }}</span>
                        </label>
                      </p>
                    @endforeach
                </div>
                <div class="col s6 m3 w3-padding">
                    <h5><u>Sector and Background</u></h5>
                    @foreach ($permissions->where('parent', 'sector_background') as $permission)
                    <p class="w3-small">
                        <label class="w3-small">
                          <input type="checkbox" name="permit{{ $permission->id }}" value="{{ $permission->id }}" class="w3-small filled-in"/>
                          <span class="w3-small"> {{ $permission->name }}</span>
                        </label>
                    </p>
                    @endforeach
                </div>
                <div class="col s6 m3 w3-padding">
                    <h5><u>Manage Role</u></h5>
                    @foreach ($permissions->where('parent', 'roles') as $permission)
                    <p class="w3-small">
                        <label class="w3-small">
                          <input type="checkbox" name="permit{{ $permission->id }}" value="{{ $permission->id }}" class="w3-small filled-in"/>
                          <span class="w3-small"> {{ $permission->name }}</span>
                        </label>
                      </p>
                    @endforeach
                </div>
            </div>

            <div class="row">
                <div class="col s6 m3 w3-padding">
                    <h5><u>Manage Students</u></h5>
                    @foreach ($permissions->where('parent', 'students') as $permission)
                    <p class="w3-small">
                        <label class="w3-small">
                          <input type="checkbox" name="permit{{ $permission->id }}" value="{{ $permission->id }}" class="w3-small filled-in"/>
                          <span class="w3-small"> {{ $permission->name }}</span>
                        </label>
                      </p>
                    @endforeach
                </div>
                <div class="col s6 m3 w3-padding">
                    <h5><u>Manage Teacher</u></h5>
                    @foreach ($permissions->where('parent', 'teachers') as $permission)
                    <p class="w3-small">
                        <label class="w3-small">
                          <input type="checkbox" name="permit{{ $permission->id }}" value="{{ $permission->id }}" class="w3-small filled-in"/>
                          <span class="w3-small"> {{ $permission->name }}</span>
                        </label>
                      </p>
                    @endforeach
                </div>
                <div class="col s6 m3 w3-padding">
                    <h5><u>Manage Subject</u></h5>
                    @foreach ($permissions->where('parent', 'subjects') as $permission)
                    <p class="w3-small">
                        <label class="w3-small">
                          <input type="checkbox" name="permit{{ $permission->id }}" value="{{ $permission->id }}" class="w3-small filled-in"/>
                          <span class="w3-small"> {{ $permission->name }}</span>
                        </label>
                      </p>
                    @endforeach
                </div>
                <div class="col s6 m3 w3-padding">
                    <h5><u>Manage Discipline</u></h5>
                    @foreach ($permissions->where('parent', 'discipline') as $permission)
                    <p class="w3-small">
                        <label class="w3-small">
                          <input type="checkbox"name="permit{{ $permission->id }}" value="{{ $permission->id }}" class="w3-small filled-in"/>
                          <span class="w3-small"> {{ $permission->name }}</span>
                        </label>
                      </p>
                    @endforeach
                </div>
            </div>
                <div class="row">
                    <div class="col s6 m3 w3-padding">
                        <h5><u>Manage Results</u></h5>
                        @foreach ($permissions->where('parent', 'result') as $permission)
                        <p class="w3-small">
                            <label class="w3-small">
                              <input type="checkbox" name="permit{{ $permission->id }}" value="{{ $permission->id }}" class="w3-small filled-in"/>
                              <span class="w3-small"> {{ $permission->name }}</span>
                            </label>
                          </p>
                        @endforeach
                    </div>
                    <div class="col s6 m3 w3-padding">
                        <h5><u>Manage settings</u></h5>
                        @foreach ($permissions->where('parent', 'setting') as $permission)
                        <p class="w3-small">
                            <label class="w3-small">
                              <input type="checkbox" name="permit{{ $permission->id }}" value="{{ $permission->id }}" class="w3-small filled-in"/>
                              <span class="w3-small"> {{ $permission->name }}</span>
                            </label>
                          </p>
                        @endforeach
                    </div>
                    <div class="col s6 m3 w3-padding">
                        <h5><u>Transfer Result Online</u></h5>
                        @foreach ($permissions->where('parent', 'tranfer_result') as $permission)
                        <p class="w3-small">
                            <label class="w3-small">
                              <input type="checkbox" name="permit{{ $permission->id }}" value="{{ $permission->id }}" class="w3-small filled-in"/>
                              <span class="w3-small"> {{ $permission->name }}</span>
                            </label>
                          </p>
                        @endforeach
                    </div>
                </div>
                <button type="button" onclick="sumit()" class="modal-close teal waves-effect waves-green btn-flat right white-text">Submit</button>
                <script>
                    function sumit(){
                        $(document).ready(function(){
                                $.ajaxSetup({
                                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                                });
                                /* Submit form data using ajax*/
                            $.ajax({
                                url: "{{ route('role.add') }}",
                                method: 'post',
                                data: $('#form').serialize(),
                                success: function(response){
                                    toastr.options = {
                                    "closeButton": false,
                                    "debug": false,
                                    "newestOnTop": true,
                                    "progressBar": false,
                                    "positionClass": "toast-top-right",
                                    "preventDuplicates": false,
                                    "onclick": null,
                                    "showDuration": "300",
                                    "hideDuration": "1000",
                                    "timeOut": "7000",
                                    "extendedTimeOut": "1000",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut"
                                    }
                                    if(response.type == 'error'){ toastr.info(response.message);}
                                    if(response.type == 'success'){ toastr.success(response.message);}

                                    setTimeout(function(){window.location.reload();},4000);
                                },
                                error: function(error){
                                    toastr.info(error);
                                }
                            });
                        });
                        }
                    </script>
        </form>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="modal-close red waves-effect waves-green btn-flat right white-text">Cancel</button>
    </div>
  </div>

    @if(App\Role::count() == 0)
    <div class="row">
        <div class="btn warning col s12 m6 offset-m3">there is no role created yet</div>
    </div>
    @else
        <div class="row">
            <div class="col s12 m10 offset-m1" style="margin-top: -30px !important">
                <div class="col s6 m3 right topnav" style="margin-right: 1px !important">
                    <input type="text" placeholder="Search name..." onkeyup="myFunction()"  id="myInput">
                    <i class="fa fa-search right w3-large teal-text search"></i>
                    {{-- <input type="text"   class="right w3-small" placeholder="Search a names...."> --}}
                </div>
                <div class="col s12 m12" style="overflow-x:scroll !important;">
                    <table id="myTable" class="w3-table w3-striped w3-border-t" style="font-size: 13px !important;">
                        <tr class="teal">
                            <th>S/N</th>
                            <th>Role Name</th>
                            <th>Permissions</th>
                            <th>Users</th>
                            <th colspan="3">Action</th>
                        </tr>
                        @foreach (App\Role::all(); as $key => $role)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                @php
                                // $role = App\Role::find($role->id);
                                // $count = count($role->permission);
                                // echo $count;
                                $count = DB::table('permission_role')->where('role_id', $role->id)->count();
                                echo $count;
                                @endphp
                            </td>
                            <td>
                                @php
                                $count = DB::table('admin_role')->where('role_id', $role->id)->count();
                                echo $count;
                                @endphp
                            </td>
                            <td><a class="wave waves-orange waves-effect btn teal lighten-3 teal-text w3-tiny" href="{{ route('user.role.view',  ['id' => $role->id]) }}"> View detail <i class="fa fa-eye w3-tiny"></i></a></td>
                            <td><a class="wave waves-teal waves-effect btn orange lighten-3 orange-text w3-tiny" href="{{ route('user.role.edit', ['id' => $role->id]) }}"> Edit <i class="fa fa-pen w3-tiny"></i></a></td>
                            <td><button class="wave waves-effect waves-light btn red lighten-3 red-text" disabled> Delete <i class="fa fa-trash-alt w3-small"></i></button></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
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
        function getVal(){
            var t = document.getElementById('autocomplete-input').value;
            document.getElementById('inp').innerHTML = document.getElementById('autocomplete-input').value;
            document.getElementById("tex").setAttribute('value', t);
        }


        </script>
@endsection
