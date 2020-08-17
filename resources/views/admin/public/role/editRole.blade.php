@extends('admin.layout')

@section('content')
<p class="w3-center">Welcome to Secondary School Management Platform</p>

<div class="row w3-margin-top">
    <div class="col s11 m8 w3-border-t offset-m2 w3-padding white w3-margin-bottom radius w3-margin-left">
        <div class="row">
            <form action="" id="form">
                {{ csrf_field() }}
                <div class="row">
                    <div class="teal-text col offset-m1">Edit the Role and or its permissions</div>
                    <div class="input-field col s6 m4 offset-m2 right">
                        Role Name:
                        <input type="text" class="validat right" name="role" value="{{ $roles->name }}" readonly>
                        {{-- <input type="hidden" class="validat right" name="roleid" value="{{ $roles->id }}"> --}}
                    </div>
                </div>
                <div class="row" style="margin-top: -30px">
                    <div class="col s6 m3 w3-padding w3-margin-bottom">
                        <h5><u>Fees and Expenses</u></h5>
                        @foreach ($permissions->where('parent', 'fees_expenses') as $permission)

                        <p class="w3-small">
                            <label class="w3-small">
                                <input type="checkbox" name="permit{{ $permission->id }}"
                                    value="{{ $permission->id }}"
                                    @foreach ($roles->permissions as $select) @if($permission->id == $select->id) checked @endif @endforeach
                                    class="w3-small filled-in"
                                />
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
                              <input type="checkbox"
                               name="permit{{ $permission->id }}"
                                value="{{ $permission->id }}"
                                @foreach ($roles->permissions as $select) @if($permission->id == $select->id) checked @endif @endforeach
                                class="w3-small filled-in"/>
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
                              <input type="checkbox"
                                    name="permit{{ $permission->id }}"
                                    value="{{ $permission->id }}"
                                    @foreach ($roles->permissions as $select) @if($permission->id == $select->id) checked @endif @endforeach
                                    class="w3-small filled-in"/>
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
                              <input type="checkbox"
                                    name="permit{{ $permission->id }}"
                                    value="{{ $permission->id }}"
                                    @foreach ($roles->permissions as $select) @if($permission->id == $select->id) checked @endif @endforeach
                                    class="w3-small filled-in"/>
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
                              <input type="checkbox"
                                    name="permit{{ $permission->id }}"
                                    value="{{ $permission->id }}"
                                    @foreach ($roles->permissions as $select) @if($permission->id == $select->id) checked @endif @endforeach
                                    class="w3-small filled-in"/>
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
                              <input type="checkbox"
                                    name="permit{{ $permission->id }}"
                                    value="{{ $permission->id }}"
                                    @foreach ($roles->permissions as $select) @if($permission->id == $select->id) checked @endif @endforeach
                                    class="w3-small filled-in"/>
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
                              <input type="checkbox"
                                    name="permit{{ $permission->id }}"
                                    value="{{ $permission->id }}"
                                    @foreach ($roles->permissions as $select) @if($permission->id == $select->id) checked @endif @endforeach
                                    class="w3-small filled-in"/>
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
                              <input type="checkbox"
                                    name="permit{{ $permission->id }}"
                                    value="{{ $permission->id }}"
                                    @foreach ($roles->permissions as $select) @if($permission->id == $select->id) checked @endif @endforeach
                                    class="w3-small filled-in"/>
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
                                  <input type="checkbox"
                                        name="permit{{ $permission->id }}"
                                        value="{{ $permission->id }}"
                                        @foreach ($roles->permissions as $select) @if($permission->id == $select->id) checked @endif @endforeach
                                        class="w3-small filled-in"/>
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
                                  <input type="checkbox"
                                        name="permit{{ $permission->id }}"
                                        value="{{ $permission->id }}"
                                        @foreach ($roles->permissions as $select) @if($permission->id == $select->id) checked @endif @endforeach
                                        class="w3-small filled-in"/>
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
                                  <input type="checkbox"
                                        name="permit{{ $permission->id }}"
                                        value="{{ $permission->id }}"
                                        @foreach ($roles->permissions as $select) @if($permission->id == $select->id) checked @endif @endforeach
                                        class="w3-small filled-in"/>
                                  <span class="w3-small"> {{ $permission->name }}</span>
                                </label>
                              </p>
                            @endforeach
                        </div>
                    </div>
                    <button type="button" onclick="sumit()" class="orange waves-effect waves-green btn-flat white-text col offset-m3 offset-s3" style="width: 50%">Update</button>
                    <script>
                        function sumit(){
                            $(document).ready(function(){
                                    $.ajaxSetup({
                                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                                    });
                                    /* Submit form data using ajax*/
                                $.ajax({
                                    url: "{{ route('role.edit') }}",
                                    method: 'post',
                                    data: $('#form').serialize(),
                                    success: function(response){
                                        console.log('the result', response);
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

                                        //setTimeout(function(){window.location.reload();},7000);
                                    },
                                    error: function(error){
                                        console.log('the error', response);
                                        toastr.info(error);
                                    }
                                });
                            });
                            }
                        </script>
            </form>
          </div>
    </div>
</div>
<a href="{{ route('admin.manage.role') }}" class="btn teal waves-light waves-effect backbtn"><i class="fa fa-reply"></i> Go Back</a>
@endsection
