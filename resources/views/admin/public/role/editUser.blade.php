@extends('admin.layout')

@section('content')
    <div class="row w3-margin-top">
        <div class="col s11 m10 w3-border-t offset-m1 w3-padding white w3-margin-bottom radius w3-margin-left" style="margin-top: 30px">
            <h4 class="w3-center teal-text">Fill all the form bellow to Update user inforamtion </h4>

            <div class="row">
                <form action="{{ route('user.information.update') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <input type="hidden" name="admin_id" value="{{ $user->id }}">
                        <div class="input-field col s12 m3">
                            <input name="firstName" id="first_name" type="text" class="validate" value="{{ $user->first_name }}" onchange="getVal()">
                            <label for="first_name">First Name</label>
                        </div>
                        <div class="input-field col s12 m3">
                            <input id="last_name" name="lastName" type="text" value="{{ $user->last_name }}" class="validate">
                            <label for="last_name">Last Name</label>
                        </div>
                        <div class="input-field col s12 m3">
                            <input id="email" name="email" type="text" value="{{ $user->email }}" class="validate">
                            <label for="email">Email</label>
                        </div>
                         <div class="input-field col s12 m3">
                            <input id="uname" name="userName" type="text" value="{{ $user->user_name }}" class="validate">
                            <label for="uname">User Name</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m3">
                            <select name="gender" class="icons">
                              <option value="{{ $user->gender }}" selected>{{ $user->gender }}</option>
                              <option value="Male" data-icon="{{ URL::asset('image/man.png') }}">Male</option>
                              <option value="Female" data-icon="{{ URL::asset('image/female.png') }}">Female</option>
                            </select>
                            <label><b id="inp"></b> Select Gender</label>
                        </div>
                        <div class="input-field col s12 m3">
                            <input type="text" name="date_of_birth" value="{{ $user->date_of_birth }}" class="datepicker" id="date">
                            <label for="date"><b id="inp"></b> enter Date of birth </label>
                        </div>
                        <div class="file-field input-field col s12 m3">
                            <div class="btn">
                              <input type="file" name="profile_image" value="{{ $user->profile }}">
                            </div>
                            <div class="file-path-wrapper">
                              <input class="file-path validate" name="profile_image" type="text" placeholder="select profile">
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
                    <div class="col s6 m4">
                        <h6 class="w3-padding teal-text">Current User profile Image</h6>
                        <img src="{{ URL::asset('image/profile/'.$user->profile.'') }}" width="80" height="80" class="w3-border-t" style="margin-left: 20px !important">
                    </div>
                    <div class="col s6 m4">
                        <h6 class="w3-padding teal-text">Current User Roles</h6><br>
                        <?php
                            $admin = App\Admin::find($user->id);
                            foreach ($admin->roles as $role) {
                                echo  '<i class="fa fa-arrow-right teal-text w3-small"></i> '.$role->name.'<br>';
                            }
                            ?>
                    </div>
                    <div class="col s6 m5 offset-m1 right offset-s1" style="margin-top: 4px !important">
                        <button class="btn teal waves-effect waves-light w3-medium right" type="submit">Update User's Information</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
