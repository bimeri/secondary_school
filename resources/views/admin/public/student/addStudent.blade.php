@extends('admin.layout')
@section('title') enroll student @endsection
@section('content')
<p class="w3-center">@lang('messages.add_student')</p>
<div class="row">
    <div class="col s11 m10 w3-border-t offset-m1 radius white w3-margin-left">
        <form action="{{ route('amin.submit.student.info') }}" method="post" enctype="multipart/form-data" id="form">
            {{ csrf_field() }}
            <div class="row">
                @if(Session::has('notify'))
                    <div class="col s12 m10 offset-m1 waves-effect waves-red red lighten-4 red-text w3-margin-top" style="border-radius: 10px;">
                    <span onclick="this.parentElement.style.display='none'" class="w3-close w3-padding right white-text w3-hover">&times;</span>
                        <h5 class=" w3-center">{{Session::get('notify')}}</h5>
                    </div>
                @endif
                <div class="input-field col s12 m3 offset-m2">
                    <select name="year" id="year" class="validate">
                        <option value="" disabled>select academic year</option>
                        <option value="{{ $current_year->id }}" selected>{{ $current_year->name }}</option>
                        @foreach (App\Year::where('active', '!=', 1)->get() as $year)
                            <option value="{{ $year->id }}">{{ $year->name }}</option>
                        @endforeach
                    </select>
                </div>
                 <div class="input-field col s12 m3">
                    <input name="fullName" id="first_name" type="text" class="validate" value="{{ old('fullName') }}">
                    <label for="first_name">Full Name</label>
                </div>
                <div class="input-field col s12 m2">
                    <input id="email" name="email" type="email" value="{{ old('email') }}" class="validate">
                    <label for="email">Email (optional)</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m3">
                    <input type="number" name="parent_contact"  value="{{ old('parent_contact') }}" class="validate" id="pcontact">
                    <label for="pcontact">Parent contact (optional)</label>
                </div>
                <div class="input-field col s12 m3">
                    <input type="text" name="address"  value="{{ old('address') }}" class="validate" id="address">
                    <label for="address">Parent Address (optional)</label>
                </div>
                <div class="input-field col s12 m3">
                    <input type="email" name="parent_email" value="{{ old('parent_email') }}" class="validate" id="address">
                    <label for="address">Parent email (optional)</label>
                </div>
                <div class="input-field col s12 m3">
                    <select name="gender" class="icons">
                      <option value="" disabled selected>Select Your Gender</option>
                      <option value="Male" data-icon="{{ URL::asset('image/man.png') }}">Male</option>
                      <option value="Female" data-icon="{{ URL::asset('image/female.png') }}">Female</option>
                    </select>
                    <label>Select Gender</label>
                </div>
                <div class="row">
                    <div class="input-field col s12 m2  offset-m3">
                        <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" id="dates" placeholder="dd/mm/yy">
                        <label for="dates">Enter Date of birth</label>
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
                    <div class="input-field col s12 m2">
                        <input type="text" name="school_id" class="validate" value="{{ $matricule }}" id="school_id" readonly>
                        <label for="school_id">Student School Id</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m4">
                        <select name="class" id="select">
                            <option value="" disabled selected> Class / Background / Sector</option>
                          @foreach (App\Form::all() as $form)
                          @php
                          $class_check = App\Form::where('id', $form->id)->first();
                          $student_count = App\Studentinfo::where('form_id', $form->id)->where('year_id', $current_year->id)->first();
                          @endphp
                            <option value="{{ $form->id }}">{{ $form->name }}  / {{ $form->background->name }} / {{ $form->background->sector->name }}</option>
                          @endforeach
                        </select>
                        <label>Select the class</label>
                    </div>
                    <div class="input-field col s12 m4" id="subclass"></div>
                    <div class="col m4 s12" id="type"></div>
                </div>
            </div>
            <center>
                <div class="w3-padding" style="margin-top: -10px !important" style="width: 50%;">
                    <button class="btn teal waves-effect waves-light w3-medium" type="submit" style="width: 40%">Register Student</button>
                </div>
            </center>
        </form>
    </div>
  </div>
  <script>
      $(document).ready(function(){
          createCookie("class", document.getElementById('select').value);
      });
     function createCookie(name, valu){
        document.cookie = escape(name) + "=" + escape(valu);
     }
    $('#select').on('change', function(){
        $("#subclass").empty();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    var data = $('#form').serialize();
    var semesterid = $(this).val();
    if(semesterid){
        $.ajax({
           type:"POST",
           url:"{{route('class.getsize')}}",
           data: $('#form').serialize(),
           success:function(res){
               console.log('the response is: ',res);
            if(res){
                $("#type").empty();
                // console.log('result', res);
                // console.log('data', document.getElementById('select').value);
                // console.log('the size is', res.size);
                // console.log('the student is', res.student);
                if(res.size == res.student || res.student > res.size){
                    document.getElementById('subclass').style.display = 'block';
                    $("#type").append(" <div class='w3-border w3-padding w3-margin-right w3-small' style='background-color:rgb(245, 200, 200)'>"+
                    "<b class='red-text'>"+
                    "The Class is full already, please try creating a sub class to continue registring students. Or You might increase the class Size</b><hr> "+
                    " Class Size: <b class='red-text w3-center'>" + res.size +" Maximum</b><br> Number of Student in the class: <b class='red-text'>"+ res.student +"</div> ");

                    $('#subclass').append("<?php $subs = App\Subclass::all(); ?>"+
                    "<div class='form-control'><label for='sub'>Select a subclass instead</label>"+
                    "<select class='browser-default' name='subclass' id='sub'>"+
                    "<option value=''>select sub class</option>"+
                    "@foreach($subs as $sub)<option value='{{ $sub->id }}'>{{ $sub->form->name }}-{{ $sub->type }} /{{ $sub->form->background->name }}/{{ $sub->form->background->sector->name }}</option>@endforeach"+
                    "</div></select> ");
                }
                if(res.size > res.student){
                    $("#subclass").empty();
                    $("#type").append("<div class='w3-border w3-padding w3-margin-right' style='background-color:rgb(194, 241, 241)'><b class='green-text'>The Class is Not yet Full, it requires <b>"+res.diff+"</b> more student(s)</b><br> "+
                    " Class Size: <b class='green-text'>" + res.size +"</b><br> Number of Student in the class: <b class='green-text'>"+ res.student +"</br> </div> ");

                }

            }else{
               $("#type").empty();
            }
           },
           error: function(error){
               console.log('an error: ', error);
           }
        });
    }else{
        $("#type").empty();
    }

   });
</script>
@endsection
