@extends('admin.layout')
@section('title') Add Teacher @endsection
@section('content')
<p class="w3-center">@lang('messages.welcome')</p>

<div class="row">
    <div class="col s11 m10 w3-border-t offset-m1 radius white w3-margin-left">
        <form action="{{ route('teacher.create.submit') }}" method="post" role="form" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="input-field col s12 m3 offset-m2">
                    <input name="fname" id="name" type="text" class="validate" value="{{ old('fname') }}">
                    <label for="name">Full Name</label>
                </div>
                <div class="input-field col s12 m3">
                    <input id="email" name="email" type="email" value="{{ old('email') }}" class="validate">
                    <label for="email">email</label>
                </div>
                <div class="input-field col s12 m3">
                    <input id="coff" name="uname" type="text" value="{{ old('uname') }}" class="validate">
                    <label for="coff">User Name</label>
                </div>
                <div class="row">
                    <div class="input-field col s12 m3 offset-m2">
                        <select name="gender" class="icons">
                          <option value="" disabled selected>Select Your Gender</option>
                          <option value="Male" data-icon="{{ URL::asset('image/man.png') }}">Male</option>
                          <option value="Female" data-icon="{{ URL::asset('image/female.png') }}">Female</option>
                        </select>
                        <label>Select Gender</label>
                    </div>
                    <div class="input-field col s12 m2">
                        <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" class="validate" id="dates">
                        <label for="dates"> enter Date of birth</label>
                    </div>
                    <div class="file-field input-field col s12 m2">
                        <div class="btn">
                          <input type="file" name="profile_image" id="imgInp">
                        </div>
                        <div class="file-path-wrapper">
                            <img id="blah" src="#" alt="Upload profile" height="60" width="70"/>
                          <input class="file-path validate" name="profile_image" type="text" placeholder="upload profile">
                        </div>
                    </div>
                </div>
                {{--  <div class="input-field col s12 m3">
                    <select multiple name="subject" id="sub">
                        <option selected disabled value="">select the class</option>
                        @foreach (App\Subject::all() as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->name }} / {{ $subject->form->name }}</option>
                        @endforeach
                    </select>
                    <label for="sub">Assign Subject</label>
                </div>  --}}
            </div>
            <center>
                <button type="submit" class="btn teal waves-effect waves-light" style="width: 40%">Register Teacher</button>
            </center><br>
        </form>
    </div>
</div>
@endsection
