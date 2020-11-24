@extends('admin.layout')
@section('title') enroll student @endsection
@section('style')
<style>
    td, th, tr{
        border-collapse: collapse;
        border: 1px solid black !important;
        font-size: 11px !important
    }
    td{
        font-size: 3px;
    }
</style>
@endsection
@section('content')
<p class="w3-center">@lang('messages.add_student')</p>
<div class="row">
    <div class="col s11 m10 w3-border-t offset-m1 radius white w3-margin-left">
        <form action="{{ route('admin.submit.student.info') }}" method="post" enctype="multipart/form-data" id="fm">
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
                    <input type="text" name="pob" value="{{ old('pob') }}" class="validate" id="address" required/>
                    <label for="address">Enter place of birth</label>
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
                    <div class="input-field col s12 m2">
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
                    <div class="input-field col s12 m4">
                        {{--  end dynamic  --}}
                        <input type="hidden" name="year" value="{{ $current_year->id }}">
                    </div>
                </div>
                {{--  dynamic selecrt start  --}}
                <div class="row container" style="font-size: 16px !important">
                    <div class="col m4 s12">
                        <select name="sector" class="browser-default" id="sector" onchange="getBackground(event)">
                            <option value="" disabled selected>select the Sector</option>
                          @foreach (App\Sector::all() as $sector)
                            <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                          @endforeach
                        </select>
                    </div>
                    <div class="col s12 m4" id="backgrounds">
                        <select class="browser-default" name="background" id="background" required onchange="getclasses(event)">
                            <option value="">select the Background</option>
                        </select>
                    </div>

                    <div class="col s12 m4" id="classes">
                        <select class="browser-default" name="class" id="form" required>
                            <option value="">select the Class</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m4" id="subclass"></div>
                    <div class="col m4 s12" id="type"></div>
                </div>
            </div>
            <center>
                <div class="w3-padding" style="margin-top: -50px !important" style="width: 50%;">
                    <button class="btn teal waves-effect waves-light w3-medium" type="submit" style="width: 40%">Register Student</button>
                </div>
            </center>
        </form>
    </div>
  </div>
  <div class="row container">
      <h5 class="center green-text">Newly Admitted Students</h5>
    <div class="col s12 m10 offset-m1" style="overflow-x:auto !important;">
        <table id="myTable" class="w3-table w3-striped w3-border-t container" style="font-size: 13px !important;">
            <tr class="teal">
                <th>S/N</th>
                <th>profile</th>
                <th>Full Name</th>
                <th>Class</th>
                <th>School ID Number</th>
                <th>gender</th>
                <th>date of birth</th>
            </tr>
            @foreach($students as $key => $student)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>
                    <?php $enroll = explode('/', trim($student->year->name)); ?>
                    <img src="{{ URL::asset('image/students/'.$enroll[0].'/'.$student->profile.'') }}" width="50" height="50" class="w3-circle w3-border-t">
                </td>
                <td> {{ $student->student->full_name }}</td>
                <td>
                    <b>{{ $student->form->name }} {{ $student->subform_id ? $student->subform->type:'A' }} </b> /{{ $student->form->background->name }}/{{ $student->form->background->sector->name }}
                </td>
                <td>{{ $student->student_school_id }}</td>
                <td>
                    {{ $student->gender }}
                </td>
                <td>
                    {{ $student->date_of_birth }}
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    <div class="right w3-padding">
        <button class="btn teal waves-effect waves-light">show more</button>
    </div>
</div>
  <script>
      $(document).ready(function(){
          createCookie("class", document.getElementById('form').value);
      });
     function createCookie(name, valu){
        document.cookie = escape(name) + "=" + escape(valu);
     }
    $('#form').on('change', function(){
        $("#subclass").empty();
        $("#type").empty();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    var data = $('#fm').serialize();
    var semesterid = $(this).val();
    if(semesterid){
        $.ajax({
           type:"POST",
           url:"{{route('class.getsize')}}",
           data: $('#fm').serialize(),
           success:function(res){
               console.log('the response is: ',res);
            if(res){
                $("#type").empty();
                 console.log('result', res);
                    document.getElementById('subclass').style.display = 'block';
                    $("#type").append("<div class='w3-border w3-padding w3-margin-right green black-text lighten-5'>"+res[2] +"</br> </div> ");
                    $('#subclass').append("<div class='form-control'><label for='sub'>Select the class Type</label>"+
                    "<select class='browser-default' name='subclass' id='sub' required>"+
                    "<option value=''>select sub class</option>"+
                    " "+ res[1]+" "+
                    "</div></select> ");
            }else{
               $("#type").empty();
            }
           },
           error: function(error){
           }
        });
    }else{
        $("#type").empty();
    }

   });
</script>
@endsection
